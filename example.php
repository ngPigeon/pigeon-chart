<!DOCTYPE html>

<!-- data-ng-app="pigeon-chart" in the html is essential to inject ngPigeon-chart into the webpage-->
<html lang="en" data-ng-app="pigeon-chart" data-ng-cloak>
<head>
    <title>Example</title>
	<!-- The includes.php file is required to include all necessary dependencies-->
    <?php
		include "pigeon-chart/php/includes.php"
	?>
    
</head> 

<body>
    <div id="axis">
	</div>
    <div>
		<!--Support multiple charts-->
		<pigeon-chart query="SELECT relyear, tmdb_score FROM movie ORDER BY relyear LIMIT 20"
			  title="Top 10 Movies with Highest TMDB Score"
			  subtitle="Year 1953 to Year 2016"
			  type="spline"
			  axisy-title="TMDB Score"
			  show-legend="bottom"
			  show-data-label="true"
			  zoom-type="xy">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT relyear, RATINGCODE, min(runtime), avg(runtime), max(runtime)
							 FROM movie
							 WHERE relyear = 1967
							 GROUP BY relyear, RATINGCODE"
					  title="Stock Quotes For DiGi"
					  subtitle="Comparison between open, high, low and close price"
					  type="column"
					  axis-y-title="Stock Quotes"
					  axis-x-title="Date"
					  show-data-label="false"
					  show-legend="left"
					  zoom-type="y">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT school, COUNT(school) AS Total
							 FROM student
							 GROUP BY school"
					  title="Students from Swinburne, UCTS and Sunway Group By Gender"
					  subtitle="BICT and CS Students"
					  type="pie"
					  axis-y-title="Count"
					  axis-x-title="Gender"
					  show-data-label="false"
					  show-legend="top"
					  zoom-type="xy">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT name, val FROM web_marketing"
					  title="Web Marketing"
					  type="bar"
					  axis-y-title="Value"
					  axis-x-title="Category"
					  show-data-label="false"
					  show-legend="right"
					  zoom-type="x">Placeholder for generic chart</pigeon-chart>
    </div>    
</body>
</html>

