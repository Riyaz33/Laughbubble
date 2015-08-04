<html>
<head> </head>
<body> 
<?php



function sendEmail($user_email, $hash, $id, $username) {
	$to = $user_email;
	$subject = 'LaughBubble Confirmation Email.';
	$body = "Hello " . ucfirst($username) . ", thank you for signing up to Laughbubble.com. Please confirm your registration by c
licking the following link: http://www.laughbubble.com/access/activate.php?id=" . $hash . "&name=" . $id . "/";
	$headers = 'From: Laughbubble! <noreply@laughbubble.com>';
	
	$sendMail = mail($to, $subject,$body,$headers);
	if($sendMail) {
			echo "<script type='text/javascript'>alert('confirmation email sent.');</script>";
	} else {
			echo "<script type='text/javascript'>alert('error');</script>";
	}
}

?> 
</body>
</html>