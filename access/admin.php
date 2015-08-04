<!--Admin page to sift through bad images -->
<?php require($_SERVER['DOCUMENT_ROOT'] . '/header.php' ); ?>
<?php include_once("/analytic.php");
session_start();

if($_SESSION["username"] != "admin") {
	echo "<script> window.location.href='../main/posts.php'</script>";
} 
 ?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="posts.css" >

</head>
<?php

include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );


$query = "SELECT * FROM userPosts ORDER BY timeUpload DESC";
$row = mysqli_fetch_assoc(mysqli_query($db, $query));
$queryLoop = $db->query($query);
	
	echo '<div class="container"><div class="spacer"></div></div>';
	echo '<form role="form" method="post">';
	
	while ($result=mysqli_fetch_array($queryLoop)) {
		$pictureID = $result['id'];
		$ip = $result["IP_ADDRESS"];
		$userID = $result["user_ID"];
		if(is_null($ip)){
		$ip = "IP unavailable";
		}
		echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><h4 class="picTitle">Picture ID #'.$pictureID.'<br> IP: '.$ip.'<br>User ID #'.$userID.'</h4></div><div class="col-md-2 col-xs-2 col-xs-1"></div></div>';
		echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div>';
		echo '<img src="data:image/jpeg;base64,'.base64_encode($result['img']).'" class="posts col-md-8 col-sm-8 col-xs-10"/><br>';
		echo '<br><button type="submit" name='.$pictureID.'>Remove</button>';
		echo '<div class="col-md-2 col-sm-2 col-xs-1 "></div></div>';
	}
	echo '</form>';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		for($i = 0; $i < 1000; $i++){
			if(isset($_POST[$i])){
			echo '<script>alert('.$i.')</script>';
			}
		}
  	
	}

	

	
?>


</html>