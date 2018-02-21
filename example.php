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
        <pigeon-chart query="SELECT tdate, open, high, low, close FROM quotes WHERE stock = 'DiGi Bhd' LIMIT 20" title="Stock Quotes For DiGi" subtitle="Comparison between open, high, low and close price" type="line" axisy-title="Stock Quotes" axisx-title="Date" data-data-label="false">Placeholder for generic chart</pigeon-chart>
    </div>    
</body>
</html>

