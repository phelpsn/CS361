<HTML>
        <HEAD>

                <TITLE>Charity Regions</TITLE>
                <link rel="stylesheet" type="text/css" href="web.css" />
				<link rel="stylesheet" type="text/css" href="style.css" />
        </HEAD>

        <BODY>
	
		<?php include 'header.php' ?>
		
		<div id="content">
		
        

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
				   $bubbletext=$name . " Charity - " . $description."<p><a  onclick='postToFeed();return false;'><font color='blue'><u> Donate</u></font></a></p><p id='msg'></p>";
                   $map->addGeoPoint($latitude,$longitude, $bubbletext); 
                }

                $map->showMap(); 


                mysql_close($mysql_handle);



        ?>

	
<div id='fb-root'></div>
    <script src='http://connect.facebook.net/en_US/all.js'></script>
	<script>
	FB.init({appId: "511374655547520", status: true, cookie: true});
function postToFeed() {
		
        // calling the API ...
        var obj = {
          method: 'feed',
          //redirect_uri: 'http://web.engr.oregonstate.edu/~meehand',
          link: 'http://web.engr.oregonstate.edu/~meehand',
          picture: 'http://i.imgur.com/AfFe8.jpg',
          name: 'Hunger Connect',
          caption: 'I donated to a charity!',
          description: 'I\'m better than you because I donated to the less fortunate.'
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
      }

</script>


		</div>
        </BODY>

</HTML>

