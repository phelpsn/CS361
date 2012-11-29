 <?php 
 
 $to = "tunnissj@onid.orst.edu" ; 
 $from = $_REQUEST['Email'] ; 
 $name = $_REQUEST['Name'] ; 
 $headers = "From: $from";
 $subject = "Web Contact Data"; 
 
 $charity_name = $_REQUEST['Company'];
 
 $fields = array(); 
 $fields{"Name"} = "Name"; 
 $fields{"Company"} = "Company"; 
 $fields{"Email"} = "Email"; 
 $fields{"Phone"} = "Phone"; 
 $fields{"list"} = "Mailing List"; 
 $fields{"Message"} = "Message"; 
 
 // Get charity provided 'special' info
 $fields{"Message_special"} = "Special Message";
 $fields{"video_link"} = "Video URL";
 
 /* File upload code */
 
 // verify folder exists. If not then create it.
 if (!is_dir('charity_uploads/')) {
    mkdir('charity_uploads/');
}
 
 $target_path = "charity_uploads/" . $charity_name . "_" .basename($_FILES['uploadedfile']['name']);
 
 // Upload file to charity_uploads folder, notify if error
 if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
 }
 else{
    echo "There was an error uploading the file, please try again!\n\n";
 }
 
// -----------------------------------


 $body = "We have received the following information:\n\n"; foreach($fields as $a => $b){ 	$body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }
 
 // Append image name dynamically since it won't be covered by loop
 $body .= "Image Name (on local server): " . $target_path;

 
 
 $headers2 = "From: noreply@hungerconnect.com"; 
 $subject2 = "Thank you for contacting us"; 
 $autoreply = "Thank you for contacting us. Somebody will get back to you as soon as possible, usualy within 48 hours. If you have any more questions, please consult our website at web.engr.oregonstate.edu/~phelpsn";
 
 if($from == '') {print "You have not entered an email, please go back and try again";} 
 else { 
 if($name == '') {print "You have not entered a name, please go back and try again";} 
 else { 
 $send = mail($to, $subject, $body, $headers); 
 $send2 = mail($from, $subject2, $autoreply, $headers2); 
 if($send) 

 {
 ?>
<p> Success!</p>
 <p><a href = "index.php"> Home</a></p>
 <?php
 } 
 else 
 {print "We encountered an error sending your mail, please notify webmaster@hungerconnect.com"; } 
 }
}
 ?>