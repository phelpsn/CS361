<HTML>
        <HEAD>

                <TITLE>Charity Regions</TITLE>
                <link rel="stylesheet" type="text/css" href="web.css" />

        </HEAD>

        <BODY>

        <div id="top"><span id="middle"><span id="end">

        <!--<h1><img src="Charity.jpeg" width = "385" height = "256" />Charity Regions</h1>-->
		<h1>Charity Regions</h1>

        <?php

                require_once 'phoogle.php';

				$dbhost = 'oniddb.cws.oregonstate.edu';
                $dbname = 'phelpsn-db';
                $dbuser = 'phelpsn-db';
                $dbpass = 'O8PVgYSwdBRJeT2L';

                $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
                        or die("Error connecting to database server");

                mysql_select_db($dbname, $mysql_handle)
                        or die("Error selecting database: $dbname");


                $map = new PhoogleMap; 
                $map->setAPIKey("AIzaSyC4ekwyKAcgK9oE5LBdO924C3saPpT2y-M");
				$map->printGoogleJS();
                 
                $sql = 'SELECT longitude, latitude, description, name FROM `Charity`'; 
                $result=mysql_query($sql,$mysql_handle); 
                while($row=mysql_fetch_array($result)){ 
                   $longitude=$row['longitude']; 
                   $latitude=$row['latitude']; 
                   $description=$row['description'];
				   $name=$row['name'];
				   $bubbletext=$name . " Charity - " . $description;
                   $map->addGeoPoint($latitude,$longitude, $bubbletext); 
                }

                $map->showMap(); 


                mysql_close($mysql_handle);



        ?>

        <p id="nospace"><a href="index.html">Home</p>

        </div></span></span>


        </BODY>

</HTML>

