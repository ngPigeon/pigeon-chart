/*global angular, console, $, alert, jQuery*/
/*jslint vars: true*/
/*jslint plusplus: true*/

var app = angular.module("pigeon-chart", []);

app.directive("pigeonChart", function ($parse, $http) {
    "use strict";
    var direc = {};
    direc.restrict = "E";
    
    direc.controller = "myCtrl";
    
    direc.scope = {
		//accept as string
        query : "@",
		//not string
//        editable: "=editable"
    };
    
    
    direc.compile = function () {
        var linkFunction = function (scope, element, attributes) {
            
            if (scope.query.includes("SELECT")) {
                $http.post("pigeon-chart/php/pigeon-core.php", {'sql': scope.query})
                    .then(function (response) {
                        //if returned data is string form which is error message, execute this
                        if ((typeof response.data) === "string") {
                            scope.msg = response.data;
                            scope.error = true;
                        } else {
                            scope.data = response.data.data;
                            scope.error = false;
						}
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