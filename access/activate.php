<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );

if(isset($_GET['id'])) {
	
	$hash = $_GET['id'];
	$user_id = $_GET['name'];
	
	$query = "SELECT * FROM userTable WHERE id = '$user_id'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	
	$DBID = $row['id'];
	if ($hash == md5($DBID)) {
		mysqli_query($db, "UPDATE `userDatabase`.`userTable` SET `activated`='1' WHERE `userTable`.`id` = '$user_id' ");
		echo "Your account has been activated. Enjoy your time at Laughbubble.com. Redirecting in 3 seconds.";
		$_SESSION["username"] = $row['username'];
		$_SESSION["id"] = $row['id'];
		$_SESSION["password"] = $row["password"];
	} else {
		echo "there were errors <br/> <a href='/index.php'>return home</a>";
		return;
		
	}
	header('Refresh: 3; URL=http://www.laughbubble.com');
	exit();
	
}

?>