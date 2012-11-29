<?php

	session_start();
	
	//Connecting to the database
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'bauermec-db';
	$dbuser = 'bauermec-db';
	$dbpass = '3oOrH2Zp73LGtjGm';


	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
		or die("Error connecting to database server");

	mysql_select_db($dbname, $mysql_handle)
		or die("Error selecting database: $dbname");
	
	if( $_SESSION['user'] == NULL || $_SESSION['pass'] == NULL) {
	
	$username = mysql_real_escape_string($_POST['input_1']);
	$password = mysql_real_escape_string($_POST['input_2']);
	
	$password = md5($password);
	
	$_SESSION['user'] = $username;
	$_SESSION['pass'] = $password;
	
	}
	
	$sql = "SELECT * FROM `Admin` WHERE Username = '" .addslashes($_SESSION['user']) ."' and Password = '" .addslashes($_SESSION['pass']) ."'";
	
	//echo $sql;
	
	$result = mysql_query($sql, $mysql_handle);
	
	$count = mysql_num_rows($result);

	$mode = 0;

	if($count == 1){
		$mode = 1;
	} else {
	
		$sql = "SELECT C_id FROM Charity WHERE Username = '" .addslashes($_SESSION['user']) ."' and Password = '" .addslashes($_SESSION['pass']) ."'";
		
		$result = mysql_query($sql, $mysql_handle);
		
		$count = mysql_num_rows($result);
		
		$row = mysql_fetch_row($result);
		
		$_SESSION['cid'] = $row[0];
	
		
		if( $count == 1) {
			$mode = 2;
		} else {

			header( "Location: login.php" );
		}
			
	}	
	
			
?>
	

<HTML>
	<HEAD>
	
	<?php include 'header.php' ?>
	
	<?php
		
		if($mode == 1)
			echo " <TITLE>Charity Insertion</TITLE> ";
		else if ($mode == 2)
			echo " <TITLE>Region Insertion</TITLE>  ";
			
	?>
		
		<link rel="stylesheet" type="text/css" href="style.css" />
		
	</HEAD>

	<BODY>
	

		<div id="center">
		
		<?php
		
	
		echo "Welcome " .addslashes($_SESSION['user']) ." \n";
		
		if( $mode === 1){
		
		?>
		
		<p>Add Charity to Database</p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<p id="nospace"><input type ="text" name="input_11" value="Charity Name" /></p>
		<p id="nospace"><input type ="text" name="input_12" value="Charity Description" /></p>
		<p id="nospace"><input type ="text" name="input_13" value="Charity Username" /></p>
		<p id="nospace"><input type ="text" name="input_14" value="Charity Password" /></p>
		<p id="nospace"><input type="submit" name="change_user" value="Insert" /></p>
		</form>
		
		<?php
		
			
		} else if ($mode === 2){
		
		?>
		
		<p>Add Region to Database</p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<p id="nospace"><input type ="text" name="input_11" value="Region Name" /></p>
		<p id="nospace"><input type ="text" name="input_12" value="Region Description" /></p>
		<p id="nospace"><input type ="text" name="input_13" value="Region Latitude" /></p>
		<p id="nospace"><input type ="text" name="input_14" value="Region Longitude" /></p>
		<p id="nospace"><input type="submit" name="change_region" value="Insert" /></p>
		</form>
		
		
		<?php
		
		} 
	
		if($_POST['change_user'] === "Insert") {
		
		
			//it is ok if this is null
			if($_POST['input_12'] === "" || $_POST['input_12'] === "Charity Description")
				$input_2 = "NULL";
			else
				$input_2 = "'".$_POST['input_12']."'";
			
			
			//these fields should not be null
			if($_POST['input_11'] === "" || $_POST['input_11'] === "Charity Name")
				$input_1 = "NULL";
			else
				$input_1 = "'".$_POST['input_11']."'";

			if($_POST['input_13'] === "" || $_POST['input_13'] === "Charity Username")
				$input_3 = "NULL";
			else
				$input_3 = "'".$_POST['input_13']."'";
				
			if($_POST['input_14'] === "" || $_POST['input_14'] === "Charity Password")
				$input_4 = "NULL";
			else
				$input_4 = "'".md5($_POST['input_14'])."'";
				
			
		
			$sql = "INSERT INTO `Charity`(`Name`, `Description`, `Username`, `Password`) VALUES ($input_1, $input_2, $input_3, $input_4)";
			
			
			mysql_query($sql, $mysql_handle);
			
			echo '<p id="tabbed">Inserted into Charities</p>';
			
		
		} else if($_POST['change_region'] === "Insert") {
		
			//this field can be null
			if($_POST['input_12'] === "" || $_POST['input_12'] === "Region Description")
				$input_2 = "NULL";
			else
				$input_2 = "'".$_POST['input_12']."'";
				
			//these should not be
			if($_POST['input_11'] === "" || $_POST['input_11'] === "Region Name")
				$input_1 = "NULL";
			else
				$input_1 = "'".$_POST['input_11']."'";

			if($_POST['input_13'] === "" || $_POST['input_13'] === "Region Latitude")
				$input_3 = "NULL";
			else
				$input_3 = "'".$_POST['input_13']."'";
				
			if($_POST['input_14'] === "" || $_POST['input_14'] === "Region Longitude")
				$input_4 = "NULL";
			else
				$input_4 = "'".$_POST['input_14']."'";	
		

			$sql = "INSERT INTO `Region` (R_id, Name, Description, Latitude, Longitude) VALUES (NULL, $input_1, $input_2, $input_3, $input_4)";
			
			mysql_query($sql, $mysql_handle);
			
			$sql = "SELECT R_id FROM Region WHERE Name = $input_1 and Latitude = $input_3 and Longitude = $input_4";
			
			$result = mysql_query($sql, $mysql_handle);
			
			$row = mysql_fetch_row($result);
			
			$rid = $row[0];
			
			$cid = $_SESSION['cid'];
			
			$sql = "INSERT INTO Charity_In_Region (C_id, R_id) VALUES ('$cid', '$rid')";
			
			mysql_query($sql, $mysql_handle);
			
			echo '<p id="tabbed">Inserted into Regions</p>';
			
			
		}
			
		?>
		
		<form action="logout.php" method="post">
		<p id="nospace"><input type="submit" name="leave" value="Logout" /></p>
		</form>
		</div>
		

	</BODY>
	
	
	</BODY>
	
</HTML>