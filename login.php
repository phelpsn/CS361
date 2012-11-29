<?php
	session_start();
?>

<HTML>
	<HEAD>
	
		<?php include 'header.php' ?>
		<TITLE>Login</TITLE>
		<link rel="stylesheet" type="text/css" href="style.css" />
		
	</HEAD>

	<BODY>

	
		<div id="center">
		<form action= "insertion.php" method="post">
	
		<?php
	
		if($_SESSION['user'] != NULL){
			echo "<p> Logged in as ".$_SESSION['user'];
		
		}else { ?>

		<p id="nospace">Login</p>
		<p id="nospace">Username : <input type ="text" name="input_1"/></p>
		<p id="nospace">Pasword  : <input type ="password" name="input_2"/></p>
	
		<?php } ?>
		
		<p id="nospace"><input type="submit" name="change" value="Login" /></p>
		</form>
		</div>

	</BODY>

</HTML>


