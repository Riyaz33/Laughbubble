<?php
session_start();
$id = $_SESSION['id'];
include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );
//receive information from database
/*This page is used for when user clicks on like button. It changes the laugh amount for that picture from the database. */
$imageClickedID = $_REQUEST['q'];

/*Finds the laugh amount from the image clicked*/
$query = "SELECT laughs FROM userPosts WHERE id = $imageClickedID";
$row = mysqli_fetch_assoc(mysqli_query($db, $query));
$queryLoop = $db->query($query);

	while ($result=mysqli_fetch_array($queryLoop)) {
	$like = $result[0];
	}
	
/*Attempts to find if the user already liked the photo or not.*/	
$query = "SELECT user_ID, image_ID FROM userLike WHERE image_ID = $imageClickedID AND user_ID = $id";
$result = mysqli_query($db, $query);
$rowcount=mysqli_num_rows($result);
/*If the rowcount is 0, that means the user hasn't liked the photo before and vice versa.*/


if ($rowcount == 0) {
		/*Increase the like amount by 1 and add a new row inside of userLike table to show that user liked the photo. */
		
		$like = $like + 1;
		$query = "UPDATE `userDatabase`.`userPosts` SET `laughs` = '$like' WHERE `userPosts`.`id` = $imageClickedID";
		$sql = "INSERT INTO `userDatabase`.`userLike` (`id`, `user_ID`, `image_ID`, `timeLiked`) VALUES (NULL, '$id', '$imageClickedID', NOW())";
		mysqli_query($db, $query);
		mysqli_query($db, $sql);
} else {
		/*Decrease the like amount by 1 and delete the row of userLike with that pictureID and that userID */
		$like = $like - 1;
		$query = "UPDATE `userDatabase`.`userPosts` SET `laughs` = '$like' WHERE `userPosts`.`id` = $imageClickedID";
		$sql = "DELETE FROM `userLike` WHERE `user_ID` = $id AND `image_ID` = $imageClickedID";
		mysqli_query($db, $query);
		mysqli_query($db, $sql);
}

?>