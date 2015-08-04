<?php //register code 
/*
Session starts. Header has been called for mobile apps that require jquery ajax requests. 
*/	
session_start(); 
header('Access-Control-Allow-Origin: *');
include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );

//http://laughbubble.com/check.php?q=asdca&info=4
//takes information from index.php and depending on what $specify is, the switch statement will choose the appropriate case. 
$specify = $_GET['q'];

switch ($specify) {

/*
Echos back to the database "1 "if session is already set. After information is processed, will immediatly redirect to main page.
*/
	case "checkID":
		if (isset($_SESSION["id"])) {
			echo "1";
		}
		break;
		
		/*
		Will get $username and $password from post. Creates session if both username and password is exists and is correct. 
		*/
	case "login":
	$username = $_POST["username"];
	$password = $_POST["password"];
		$query = "SELECT * FROM `userTable` WHERE `username` = '$username' AND `password` = '$password'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		if ($password == $row["password"] & $username == $row['username']) {
			$_SESSION["username"] = $row['username'];
			$_SESSION["id"] = $row['id'];
			$_SESSION["password"] = $row["password"];
		} else {
			echo "0";
		}	
						
		break;
		
		/*
		Check email from $info (where email has been stored). $checkEmail variable will obtain a value of either 1 or 0 depending if that email has been taken or not. 
		*/
	case "email":
		$info = $_GET['info'];
		$checkEmail = mysqli_query($db, "SELECT `id` FROM `userTable` WHERE email= '$info'");
		echo mysqli_num_rows($checkEmail);
		break;
		/*
		Check username from $info (where username has been stored). $checkEmail variable will obtain a value of either 1 or 0 depending if that username has been taken or not.
		*/
	case "username":
		$info = $_GET['info'];
		$checkUsername = mysqli_query($db, "SELECT `id` FROM `userTable` WHERE username= '$info'");
		echo mysqli_num_rows($checkUsername);
		break;
		
		/* Case 'Final': is activited when user clicks sign up. Variable email, username, password are all stored into the database and email gets sent. Also, sessions are set. 
		*/
	case "final":
			$email = $_POST["email"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$sql = ("INSERT INTO `userDatabase`.`userTable` (`id`,`email`,`username`, `password`,`bio`,`activated`,`profilePic`,`profilePicName`,`created`, `IP_ADDRESS`) VALUES( null,'$email','$username','$password',null,null,null,null,NOW(), '$ip')") or die ("Unable to enter");						
		mysqli_query($db, $sql);
   		$query = " SELECT * FROM `userTable` WHERE `username` = '$username' ";
		$row = mysqli_fetch_assoc(mysqli_query($db, $query));
		
		$username = $row['username'];		
		$user_id = $row['id'];
		$hash = md5($user_id);
		$email = $row['email'];								

		$to = $email;
		$subject = 'LaughBubble Confirmation Email';
		$body = "Hello ";
		$body .= ucfirst($username);
		$body .= ", thank you for signing up to Laughbubble.com. Please confirm your registration by clicking the following link: http://www.laughbubble.com/access/activate.php?id=";
		$body .= $hash . "&name=" . $user_id;
		$headers = 'From: Laughbubble <noreply@laughbubble.com>';
							
		$sendMail = mail($to, $subject,$body,$headers);
		if($sendMail) {
			echo "<script type='text/javascript'>alert('confirmation email sent.');</script>";
		} else {
			echo "<script type='text/javascript'>alert('oror');</script>";
		}
					
		//sessions for sign up
								
		$_SESSION["username"] = $row['username'];
		$_SESSION["id"] = $row['id'];
		$_SESSION["password"] = $row["password"];
							
		
		break;
	default:
		echo 'error';
		break;
}
?>