<html>
	<body>
		<head>
			<link rel="stylesheet" type="text/css" href="style.css" />
			<title>Charity Application</title>
		</head>
		<?php include 'header.php' ?>
		<div id="content">
		<h1>Charity Application</h1>
		<font face=Arial size=2> 
		 <form  enctype="multipart/form-data" method="post" action="contact.php"> 
		 <table bgcolor=#ffffcc align=center> 
		 <tr><td colspan=2><strong>Charities, apply to add your name to our website using this form:</strong></td></tr> 
		 <tr><td><font color=red>*</font> Name:</td><td><input size=25 name="Name"></td></tr> 
		 <tr><td><font color=red>*</font> Email:</td><td><input size=25 name="Email"></td></tr> 
		 <tr><td><font color=red>*</font>Charity Name:</td><td><input size=25 name="Company"></td></tr> 
		 <tr><td>Phone:</td><td><input size=25 name="Phone"></td></tr> 
		 <tr><td>Subscribe to<br> mailing list:</td><td><input type="radio" name="list" value="No"> No Thanks<br> <input type="radio" name="list" value="Yes" checked> Yes, keep me informed<br></td></tr> 
		 <tr><td colspan=2>Why your charity deserves to be on our website:</td></tr> 
		 <tr><td colspan=2 align=center><textarea name="Message" rows=5 cols=35></textarea></td></tr> 
		 
		 <tr><td colspan=2>If there is are any pictures, text, or video clips relevant to your region, please add them below: <br><br></td></tr>
		 <tr><td colspan=2>Special message from your charity:</td></tr> 
		 <tr><td colspan=2 align=center><textarea name="Message_special" rows=5 cols=35></textarea></td></tr> 
		 
		 
			
			<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
			<tr><td>Link to Video (Youtube, etc...): <input size=25 name="video_link"></td></tr> <br />
			
			
			<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
			<tr><td>Choose a picture to upload: <input name="uploadedfile" type="file" /><br /></td></tr>
			

		 
		 
		 <tr><td colspan=2 align=center><input type=submit name="send" value="Submit"></td></tr> 
		 <tr><td colspan=2 align=center><small>A <font color=red>*</font> indicates a field is required</small></td></tr> 
		 </table> 
		 </form> 
		 </div>
	 </body> 
 </html>
