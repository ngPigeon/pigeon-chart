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
        <pigeon-chart query="SELECT relyear, RATINGCODE, min(runtime), avg(runtime), max(runtime) FROM movie WHERE relyear = 1967 GROUP BY relyear, RATINGCODE" title="Stock Quotes For DiGi" subtitle="Comparison between open, high, low and close price" type="column" axisy-title="Stock Quotes" axisx-title="Date" data-data-label="false" show-legend="true">Placeholder for generic chart</pigeon-chart>
<!--        <pigeon-chart query="SELECT school, COUNT(school) AS Total FROM student GROUP BY school" title="Students from Swinburne, UCTS and Sunway Group By Gender" subtitle="BICT and CS Students" type="column" axisy-title="Count" axisx-title="Gender" data-data-label="false" show-legend="true">Placeholder for generic chart</pigeon-chart>
        <pigeon-chart query="SELECT name, val FROM web_marketing" title="Web Marketing" subtitle="" type="bar" axisy-title="Value" axisx-title="Category" data-data-label="false" show-legend="false">Placeholder for generic chart</pigeon-chart>-->
    </div>    
</body>
</html>

