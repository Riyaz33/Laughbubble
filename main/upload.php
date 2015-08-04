<?php session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/header.php' );
include_once("/analytic.php") ;
	
	include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' ); 
	
	/*
	Take file, title name, size of file.
	*/
	$file = $_FILES['image']['tmp_name'];
	$title = $_POST["title"];
	$size = $_FILES['image']['size'];
	$ip = $_SERVER["REMOTE_ADDR"];
	if (!isset($file)) {
		
	} else {
	
	/*If file selected, check if image_size (very special function) is an image extension. If yes, inset into database. If picture is greater that 2MB, 
	user will not be able to upload image.  */
	//2097152 = 2MB
		if ($size<=2097152) {
		
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name = addslashes($_FILES['image']['name']);
		$image_size = getimagesize($_FILES['image']['tmp_name']);
	
			if ($image_size==FALSE) {
	 			echo "That's not an image";
			} else {
				$sql = "INSERT INTO userPosts (user_ID, title, imgName, img, timeUpload, IP_ADDRESS) VALUES ('$id','$title','$image_name','$image', NOW(), '$ip')";
				
				mysqli_query($db, $sql);
				
				$to = "ryan.schultz8489@hotmail.com";
				$subject = 'LaughBubble photo has been uploaded';
				$body = "Ryan, ".$image_name." has been uploaded to Laughbubble. The title of the photo is ".$title.".";
				$headers = 'From: Laughbubble <noreply@laughbubble.com>';
				
				mail($to, $subject,$body,$headers);
				
				
			}
	
		} else {
			echo "<script>alert('Sorry, image must be less than 2MB');</script>";
		}
	}
	
	
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	
	<title>Upload</title>
		<link rel="stylesheet" type="text/css" href="add/uploadingPage.css">
		<link href = "/design/css/Styles.css" rel="stylesheet">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
</head>
<body>
 


	
	<div class="container">
	<div class="spacer"> </div>
	<div class="col-xs-2"></div>
	<div class="spacer"> </div>
		<div class="col-xs-8 text-center">
			<form method="post" action="upload.php" enctype="multipart/form-data">
			
			<h1 class="hmsmHeader">Upload</h1>
			<input id="title" type="text" name="title" placeholder="Add a Title"></input>
			
			
			<input id="chose" type="file" name="image" class="btn btn-danger"></input>
			
			 <input type="submit" name="submit" value="Upload Image" id="uploadPic" class="btn btn-warning btn-lg"> </input> 

			</form>
			
			<br>
			
			<div class="col-xs-2">
			
    </div>
			</div>
		</div>
	<script src="http://malsup.github.com/jquery.form.js"></script>	

	<br>
	</body>
	



</html>