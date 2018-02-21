/*global angular, console, $, alert, jQuery*/
/*jslint vars: true*/
/*jslint plusplus: true*/

var app = angular.module("pigeon-chart", []);

app.directive("pigeonChart", function ($parse, $http) {
	"use strict";
	var direc = {};
	direc.restrict = "E";
	direc.scope = {
		//accept as string
		query: "@",
		title: "@",
		subtitle: "@",
		type: "@",
		axisyTitle: "@",
		axisxTitle: "@",
		dataLabel: "=dataLabel"
	};

	direc.compile = function () {
		var linkFunction = function (scope, element, attributes) {
			if (scope.query.includes("SELECT")) {
				scope.error = false;
				$http.post("pigeon-core/get-data.php", {
						'sql': scope.query
					})
					.then(function (response) {
							scope.data = response.data.data;
					       	var transformeddata = transform_column_as_series(scope.data, scope.axisyTitle, scope.type, scope.query);

								Highcharts.chart('chart', {
									title: {
										text: scope.title
									},
									subtitle: {
										text: scope.subtitle
									},

									xAxis: {
										title: {
											text: scope.axisxTitle
										},
										categories: transformeddata.category
									},

									yAxis: {
										title: {
											text: scope.axisyTitle
										}
									},

									plotOptions: {
										pie: {
											allowPointSelect: true,
											cursor: 'pointer',
											showInLegend: true
										}
										,
									column: {
										pointPadding: 0.2,
										borderWidth: 0
									},

									series: {
										borderWidth: 0,
										dataLabels: {
											enabled: scope.dataLabel,
											format: '{point.y}'
										}
									}
								},

								legend: {
									layout: 'vertical',
									align: 'right',
									verticalAlign: 'top',
									x: -40,
									y: 20,
									floating: true,
									borderWidth: 1,
									backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
									shadow: true
								},

									series: transformeddata.series
							});

					});

		} else {
			scope.msg = "Pigeon Chart only accept SELECT query only";
			scope.error = true;
		}
	};

	return linkFunction;
};

direc.templateUrl = 'pigeon-chart/template/outputTemplate.html';

return direc;
});


function transform_column_as_category(source, query){
	var categorykey = query.split("BY")[1].replace(/ +/g, "");
	var order = categorykey.split(",");
	var groups = nestedGroup(source, order);
	console.log(JSON.stringify(groups));
	return groups;
}

//recursive call for creating nested arrays
function nestedGroup(list, order){
		if( _.isEmpty(order)) return [];			

		var groups = _.groupBy(list, _.first(order));
		var group = {};
		return _.map(groups, function(obj, key){
				//create name-categories pairs (format required in grouped-categories.js)
				group = {
					name : key,
					//get the rest of the order, remove the first index (looping)
					categories: nestedGroup(obj, _.rest(order))
				};
			return checkifEmpty(group, order);
		});
}

function checkifEmpty(group, order){
	if(_.isEmpty(group.categories) ){
			//remove "categories" property if it's empty
		 return _.omit(group, 'categories'); 
	}else{
		if(_.rest(order) == _.last(order)){
			//convert objects into a single array
			group.categories = _.pluck(group.categories, 'name');
		}
		return group;
	}
}

function transform_column_as_series(source, title, charttype, query){
	
	if(charttype === "pie"){
		
		piedata = [];
		
		for(x in source){
			//return an array of each object's values 
			allvalues = Object.values(source[x])
			piedata.push(allvalues);			
		}
		
		return {series: [{type: charttype, name: title, data: piedata}]};
		
	}else{ 
		var querystr = query.toLowerCase();
		var categoryArr = [];
		var seriesArr = [];
		var lastcol = [];	
		
		if(querystr.includes("group by")){
			categoryArr = transform_column_as_category(source, query);
			
			var length = Object.keys(source[0]).length;
			for(x in source){
				var lastcolvalue = source[x][Object.keys(source[x])[Object.keys(source[x]).length - 1]];	
				lastcol.push(lastcolvalue);			
			}
			seriesArr = [{'type':charttype, data: lastcol}];
		}else{
			allseries = [];

			//Obtaining all keys from the first row (table columns' name from sql).
			allkeys = Object.keys(source[0])

			//Pushing n JSON object to allseries array based on number of column generated
			for(var i = 0; i < allkeys.length; i++){
				allseries.push({'type':charttype, 'name': allkeys[i], 'data':[]});
			}

			//for each row, push the value into each JSON object's data based on number of column generated.
			for(x in source){
				for(var i = 0; i < allkeys.length; i++){
					allseries[i]['data'].push(source[x][allkeys[i]]);
				}
			}	
				categoryArr = allseries[0].data;
				seriesArr = allseries.slice(1);	
		}
			//category contains value for x-axis (category), and series contains an array of series based on number of column generated - first column		
			return {category: categoryArr, series: seriesArr};			
	}
}