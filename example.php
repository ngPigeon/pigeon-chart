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
    
    <div class="container">
        <pigeon-chart query="SELECT * FROM student"></pigeon-chart>
    </div>
    
</body>
</html>

