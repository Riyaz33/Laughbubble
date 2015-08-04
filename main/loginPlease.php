<!--Users that are not trying to access laughbubble that are not lgogged in are redirected to this page-->
<?php 
session_start();
//if users are already logged in, it redirects them to the posts page
if(isset($_SESSION["username"])) {	
	echo"<script type='text/javascript'>window.location.href = '../main/posts.php'</script>";
}
?>
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
    </head>
    
    
    <body>
       <div class = "navbar navbar-inverse navbar-static-top">    <!-- navbar div --> 
            <div class = "container"> <!-- New "row" on page -->
                <a href = "/" class = "navbar-brand text-center">LaughBubble</a> 		<!-- Laughbubble logo in header-->
                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse"> <!-- toggles dropdown menu when a certain screen size-->
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>
                 <div class = "collapse navbar-collapse navHeaderCollapse">  <!-- adds class to be toggled during collapse-->
                <ul class = "nav navbar-nav navbar-right">       
                    <li class = "dropdown">                         <!-- Login drop-down menu-->
        		<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Login<span class = "caret"></span></a>
                            	<ul class = "dropdown-menu" role="menu">
                           		<form role="form" method="post"><div class="smallspac"></div>      <!-- class adds spacing between input boxes-->
                                        <li>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input class="form-control" type="text" placeholder="username" name="username" id="logUser">
                                            </div>
                                        </li><div class="smallspac"></div>                       <!-- input boxes for username and password-->
                                        <li>
                                            <div class="input-group">
                                               <span class="input-group-addon">!</span>
                                                <input class="form-control" type="password" placeholder="password" name="password" id="logPass" >
                                            </div>
                                        </li><div class="largespac"></div>
                                        <li>
                                        	<div class="form-group text-center">
                                        <input type="submit" value="Login" id="btmbutton" class="btn btn-warning " name="submit">
                                        		
                                        	</div>
                                        </li>   
                                    </form>
					
					<!-- forgot password-->	
                                    <li class="remIo"><a href = "/main/retrieve-password.php">Forgot your password?</a></li>
                        	</ul>
            	</ul>
           </div>
          </div>
        </div>
<div class="container">
<div class="row">           
             <h3> Please login or signup to access laughbubble! </h3>
            <div class="col-md4">
                 <div class="text-center">
                   <h2> Sign Up! </h2>
                        <div class="sBox">
                            <form role="form" method="post">
                                <div class="row">
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                               
                                                <input type="text" class="form-control" placeholder="Email" name="email">
                                            </div>
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

                                <div class="row">
                                    <label>
                                        <input type="checkbox" name="terms"> I agree with the <a href="#">Terms and Conditions</a>.</label><br>
                                        <input type="submit" value="Sign-up" id="btmbutton" class="btn btn-warning " name="submit1">
                                </div>
              <?php //Code to log user in
		
		// Connect to Database
		include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );
		
	if (isset($_POST["submit"])) {
		
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
			echo"<script type='text/javascript'>window.location.href = '../main/posts.php'</script>";
		} else {
			echo "Incorrect username or password.";
		}
	} else {
		echo "<script type='text/javascript'>alert('Please complete all fields.');</script>";
	}	
					
	} 

?>                                        
                                
<?php //register code 	 
		
if (isset($_POST["submit1"])) {

	  //checking if they agree with terms and conditions
	  if( !isset($_POST["terms"])){
          	echo "<script type='text/javascript'> alert('please agree with terms and conditions'); </script>";
		die();
          }
	
	//getting user info
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

		
	if(empty($username) || empty($password) || empty($email)) {	//checks if all fields have values
		echo "Please ensure you have filled in all fields.";
	} else if ( !(empty($username)) && !(empty($password)) && !(empty($email))) {

			$checkEmail = mysqli_query($db, "SELECT * FROM userTable WHERE email= '$email'"); 
	
			if ($checkEmail->num_rows == 0) { //checks if email has already signed up
				
				$checkUsername = mysqli_query($db,"SELECT * FROM userTable WHERE username= '$username'");		
					if ($checkUsername->num_rows == 0) { //checks if username is available
					
						//inserts data into database
						$sql = mysqli_query($db, "INSERT INTO `userDatabase`.`userTable` (`id`,`email`,`username`, `password`,`created`) VALUES( null,'$email','$username','$password',NOW())") or die ("Unable to enter");
					
						$query = mysqli_query($db, " SELECT id FROM userTable WHERE `username` = '$username' ");
						$row = mysqli_fetch_array($query);
						
						//sets user id variable
						$user_id = $row[0];

						//sessions for sign up
						$_SESSION["username"] = $username;
						$_SESSION["id"] = $user_id;
						$_SESSION["password"] = $password;
								
						//creates a user specific number foremail activation						
						$hash = md5($user_id);
	
						//email activation
						function sendEmail($user_email, $hash, $id, $username) {
							$to = $user_email;
							$subject = 'LaughBubble Confirmation Email.';
							//link is used to update db to see if user is activated
							$body = "Hello " . ucfirst($username) . ", thank you for signing up to Laughbubble.com. Please confirm your registration by clicking the following link: http://www.laughbubble.com/access/activate.php?id=" . $hash . "&name=" . $id . "/";
							$headers = 'From: Laughbubble! <noreply@laughbubble.com>';

							$sendMail = mail($to, $subject,$body,$headers);
							if($sendMail) {
			echo "<script type='text/javascript'>alert('confirmation email sent.');</script>";
							} else {
								echo "<script type='text/javascript'>alert('oror');</script>";
							}
						}
							//calls the sendMail function based on user ingo
							sendEmail($email, $hash, $user_id, $username);
							
							//redirects to main page after registartion complete
							echo"<script type='text/javascript'>window.location.href = '../main/posts.php'</script>";

						} else {
						echo '<p align="center" >Username already in use. Choose another username.</p>';
						}
					} else {
					echo '<p align="center" >Email already in use. Choose another email.</p>';
					}			
			} else {
			echo "<script type='text/javascript'>alert('Please complete all fields.');</script>";
			}	
		} 
		?>
                                        
                             </form>   
                     	</div>
               </div>
                 
          
           </div>
                 
        </div>
        </div>
    
        <div class ="navbar navbar-default navbar-fixed-bottom">   <!-- Fixed bottom header  -->
            <div class = "container">
                <p class = "navbar-text pull-left"> LaughBubble Co.</p>
                
            </div>
        </div>     
    </body>  
</html>