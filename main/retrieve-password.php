<!-- page emails user their password if they forgot it-->
<html>
    <ded><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
        <title>LaughBubble</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--Data used by browser to show how to display information on the page, in this case it is telling the browser to load the page using the device width as a base -->
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href = "/design/css/Styles.css" rel="stylesheet"><!--links to style css sheet -->
        <link rel="apple-touch-icon" href="/lol.ico" />
        <link rel="icon" type="image/ico" href="/lol.ico"/>
    </head>
    <?php
	//db connection
	require($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );

	if (isset($_POST["submit1"])) {
		if (isset($_POST["username"])){
			//getting user info
			$username = $_POST["username"];
			$email = $_POST["email"];
			
			//Getting password from database
			$query =  "SELECT * FROM userTable WHERE username = '$username' AND email = '$email'";
			$result = mysqli_query($db, $query);
			$rowcount=mysqli_num_rows($result);
			
			if ($rowcount) { //checking if there is a user associated with the entered username and password
				$row = mysqli_fetch_assoc($result);

				$email = $row['email'];
				$user = $row['username'];
				$pass = $row['password'];
				
					//email information: it sends them their password
					$to = $email;
					$subject = 'LaughBubble - Password Retrieval';
					$body = "Hello {$user}, it appears you have forgotten your password! Here it is: < {$pass} >. We suggest you write it down or change it to something more memorable! (Password can be changed by logging in and navigating to: http://laughbubble.com/main/settings/settings.php)";
					$headers = 'From: Laughbubble <noreply@laughbubble.com>';
	
					$sendMail = mail($to, $subject,$body,$headers);
					if($sendMail) {
						$message = "Your password was sent to <b>{$email}</b>. If you don't have access to that email anymore, please contact Laughbubble support. Thanks!";
					} else {
						$message = "Error - password could not be sent. Contact Laughbubble support for more help. Thanks!";
					}

				
				
			} else {
				$message = "Username or Email not found in database. Please try again.";
			}

		}
	}
	?>
    
    <body>
       <div class = "navbar navbar-inverse navbar-static-top">  <!-- navbar div with characteristics -->
            <div class = "container"> <!-- New "row" on page -->
                <a href = "/" class = "navbar-brand text-center">LaughBubble</a> <!-- Creates logo and adds a link to it -->
           </div>
        </div>
        

	<div class="container">
	<h1>Password retrieval</h1>
	
	<form role="form" method="post" action = "retrieve-password.php">
		<p>Forgot your password? Enter your username and check your email.</p> 
		<input id="textbox" class="form-control" placeholder="Username" type="text" name="username">		<div class="smallspac"></div>
		<input id="textbox" class="form-control" placeholder="Email" type="text" name="email">
		<div class="smallspac"></div>
		<button  id="button2" type="submit1" value="submit1" name = "submit1" class="btn btn-warning">Submit</button>		
	</form>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <span id = "messageArea"><?php if (isset($message)) {echo $message;} ?></span>
         </div>
         
         
      
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
    
</html>