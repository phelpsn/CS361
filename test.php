<HTML>
	<HEAD>
	
		<TITLE>Charity Regions</TITLE>
		<link rel="stylesheet" type="text/css" href="web.css" />
		
	</HEAD>

	<BODY>
	
	<div id="top"><span id="middle"><span id="end">

	<h1><img src="car.png" width = "30" height = "30" />Charity Regions</h1>
	
	<?php
	
		require_once 'phoogle.php';
		
		$dbhost = 'oniddb.cws.oregonstate.edu';
		$dbname = 'bauermec-db';
		$dbuser = 'bauermec-db';
		$dbpass = '3oOrH2Zp73LGtjGm';

		$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
			or die("Error connecting to database server");

		mysql_select_db($dbname, $mysql_handle)
			or die("Error selecting database: $dbname");

		
		$map = new PhoogleMap; 
		$map->setAPIKey("ABQIAAAAMzmH8ET-royJSZxVI_R2whSalI8YE3jb8PPUN4-L1qTINTpxKxTmHW_FfncMi3vNp1mqm6MwcwzS9w"); 
		$map->printGoogleJS();
		 
		$sql = 'SELECT longitude, latitude FROM `PlacesVisited`'; 
		$result=mysql_query($sql,$mysql_handle); 
		while($row=mysql_fetch_array($result)){ 
		   $longitude=$row['longitude']; 
		   $latitude=$row['latitude']; 
		   
		   $map->addGeoPoint($latitude,$longitude); 
		}
		
		$map->showMap(); 
		

		mysql_close($mysql_handle);



	?>
	
	<p id="nospace"><img src="home.png" width = "20" height = "20" /><a href="index.html">Home</p>
		
	</div></span></span>
	

	</BODY>

</HTML>

