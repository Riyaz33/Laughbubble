	<?php session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );
	include($_SERVER['DOCUMENT_ROOT'] . '/core/init.php' );
	
	/*Take specify from settings main page.*/
	$specify = $_GET['q'];
	
	
	switch ($specify) {
	
	/*If case is password, check if old password field matches the database password for that user.*/
	case "password":
		
	$op = $_POST["op"];
	$np = $_POST["np"];
	//$np = "asdf";
	//$op = $_GET["op"];
	$checkpw = mysqli_query($db, "SELECT * FROM `userTable` WHERE password = '$op' and id = '$id'");
		$rowcount = mysqli_num_rows($checkpw);
		//echo $rowcount;
	if ($rowcount == 1) {
			$query =  "UPDATE `userDatabase`.`userTable` SET `password` = '$np' WHERE `userTable`.`id` = $id;";
			mysqli_query($db, $query);
			echo "Your password has been sucessfully changed.";
		
	} else {
	echo 'Old Password does not match!';
	
	}
	
	break;
	
	/*Check if new username equals any usernames (text wise), if no, set that username for the user. If yes, don't allow user. */
	case "username":

		$nu = $_POST["NewUsername"];
		
		$checkUsername = mysqli_query($db, "SELECT `id` FROM `userTable` WHERE username= '$nu'");
		$rowcount = mysqli_num_rows($checkUsername);
		
		if ($rowcount==0) {

			$query =  "UPDATE `userDatabase`.`userTable` SET `username` = '$nu' WHERE `userTable`.`id` = $id;";
			mysqli_query($db, $query);
			echo "Changed Successfully. New Username: ";
			echo $nu;
		} else{
		echo $nu;
		echo " has already been taken. Sorry!";
	
	}

	
	break;
	/*Update user biography and put it in database.*/
	case "bio":

	$nbio = $_POST["bio"];
	
		$query =  "UPDATE `userDatabase`.`userTable` SET `bio` = '$nbio' WHERE `userTable`.`id` = $id;";
		mysqli_query($db, $query);
		echo "1";

	break;
	
	
	   default:
		echo 'hello';
				         
				         }
				         

	?>