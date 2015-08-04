<?php include_once("/analytic.php"); /* Google Analytics*/
session_start(); ?>
<html>
    <head>
        <title>LaughBubble</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--Data used by browser to show how to display information on the OSage, in this case it is telling the browser to load the page using the device width as a base -->
       	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href = "http://laughbubble.com/design/css/Styles.css" rel="stylesheet">
        <link rel="apple-touch-icon" href="http://www.laughbubble.com/lol.ico">
        <link rel="icon" type="image/ico" href="http://www.laughbubble.com/lol.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    
    
    <body>
       <div class = "navbar navbar-inverse navbar-static-top">    <!-- navbar div --> 
            <div class = "container"> <!-- New "row" on page -->
                <a href = "/" class = "navbar-brand text-center">LaughBubble</a> 		<!-- Laughbubble logo in header-->
                
					
			
           </div>
          </div>
        </div>
        <div class="container">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
           <h1> Hey there </h1>
           <p>It appears that you have tried to access your account more than 3 times.<br> 
           Just to make sure you are human, we would like you to enter the captcha below as well as your log-in credentials<br>
           <h3>Thanks</h3></p>
        <form role="form" method="post">
                                <div class="row">
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                               
                                                <input type="text" class="form-control" placeholder="Username" name="username">
                                    </div>
                                </div>
                                <div class="row">
                                           <div class="form-group">
                                                
                                                <input type="password" class="form-control" placeholder="Password" name="password">
                                            </div>
                                </div>

                                			<div class="g-recaptcha" data-sitekey="6LcQcgATAAAAAJKQmDkeu74FtX6qk-QTIUURalds"></div>

                                        <input type="submit" value="Login" id="btmbutton" class="btn btn-warning " name="submit">
                                </div>
  

                                </form>
                                </div>
                                <div clas="col-xs-1"></div>
                             </div>
                               

           </body>

<?php //Code to log user in		
		
		// Connect to Database
		include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );
		
	if (isset($_POST["submit"])) {
		
		/*Code to check if human, using google reCaptcha API*/
		
		//Gets the value from captcha
		$captcha=$_POST['g-recaptcha-response'];
		
		if(!empty($captcha)){
			$google_url="https://www.google.com/recaptcha/api/siteverify";
			$secret="6LcQcgATAAAAAEHyLEjxtm3rvWiv-LBlDfozMGW9";//secret key for captcha statistics
			$ip=$_SERVER['REMOTE_ADDR']; //for statistics
			$captchaurl=$google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;//URL for API Request
			
			$curl_init = curl_init();
			curl_setopt($curl_init, CURLOPT_URL, $captchaurl);
			curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_init, CURLOPT_TIMEOUT, 10);
			$results = curl_exec($curl_init);
			curl_close($curl_init);
			
			//API request is returned in JSON, decoding it using json_decode() and storing results into $results array
			$results= json_decode($results, true);
			
			if($results['success']){ //if captcha is done correctly, goes through with log-in process
		
				//stores user input
				$username = $_POST["username"];
				$password = $_POST["password"];
				//query to check username and password
				$query = "SELECT * FROM `userTable` WHERE `username` = '$username' AND `password` = '$password'";
				$result = mysqli_query($db, $query); 
				$row = mysqli_fetch_assoc($result);
	
				if ( !(empty($username)) && !(empty($password)) ) { //checks if fields are completed
					if ($password == $row["password"] & $username == $row['username']) {//checks if username and password match
					//sets session varaibles
					$_SESSION["username"] = $row['username'];
					$_SESSION["id"] = $row['id'];
					$_SESSION["password"] = $row["password"];
					//redirect to main page
					echo"<script type='text/javascript'>window.location.href ='posts.php'</script>";
					} else {
					echo "Incorrect username or password.";
					}
				} else {
				echo "<script type='text/javascript'>alert('Please complete all fields.');</script>";
				}	
			}else{
				echo "Invalid reCAPTCHA code/Please check box.";
			}
		}else{
			echo "<script> alert('Please re-enter your reCAPTCHA/Please check box.');</script>";
		}
	}
  		
?>                     
</html>