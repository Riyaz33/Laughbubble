<?php
//including core variables
include($_SERVER['DOCUMENT_ROOT'] . '/core/init.php' );
//Database connection
include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' ); 
//google analytics
include_once("/analytic.php");
//If user is not logged in, it will redirect to a page asking them to log in
if(is_null($id)) { 
  	echo"<script type='text/javascript'>window.location.href = '/main/loginPlease.php'</script>"; 	
}
?>

<!--Header file, included on all pages except index.php 
Includes the html content that is on all pages, mainly consists of navigation bar -->

<html>
    <head>
        <title>LaughBubble</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href = "http://laughbubble.com/design/css/Styles.css" rel="stylesheet">
        <link rel="apple-touch-icon" href="http://www.laughbubble.com/lol.ico">
        <link rel="icon" type="image/ico" href="http://www.laughbubble.com/lol.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    	<body>
    	<!--Navigation bar -->
        <div class = "navbar navbar-inverse navbar-fixed-top">
            <div class = "container">
               
                <!--Logo-->
                <a href = "/main/posts.php" class = "navbar-brand">LaughBubble</a>
                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>
                
      		<!-- navigation bar options -->
                <div class = "collapse navbar-collapse navHeaderCollapse">
                    <ul class = "nav navbar-nav navbar-right">
                        <!--Popular posts tab-->
                        <li><a href = "/main/posts.php">Popular</a></li>
                        <!--Most recent tab-->
                        <li class ><a href = "/main/mostRecent.php">Most Recent</a></li>
                        <!--Upload tab-->
                        <li><a href = "/main/upload.php"><button type="button" value="upload" name="upload" class="btn btn-warning btn-xs">Upload</button></a></li>
                        
                        <!--Dropdown navigation menu: profile, settings, logout-->
                        <li class = "dropdown">
                            <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown"><span id="name">Profile</span> <img  class="profilepic" src="http://laughbubble.com/design/profile_default.jpg" alt="Error"></img><b class = "caret"></b></a>
                            <ul class = "dropdown-menu">
                                <li><a href = "/design/profile.php">View Profile</a></li>
                                <li><a href = "/main/settings">Settings</a></li>
                                <li class="divider"></li>
                                
                                
				<!--Sign out-->
                                <form method="post" action="">
                                <li class="text-center"><button  type="logout" value="logout" name = "logout" class="btn btn-danger">Sign Out</button>
                                </form>
                                <!--Redirection to homepage after sigining out-->
                                <?php $redirectLink = $_SERVER["DOCUMENT_ROOT"]."/index.php"; ?>                               
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
	//Displaying the username on the navbar
 	echo "<script type='text/javascript'>document.getElementById('name').innerHTML =('$un');</script>";
	//Logging the user out
	if(isset($_POST["logout"])){
		session_destroy();
   		echo"<script type='text/javascript'>window.location.href = 'http://laughbubble.com/'</script>";
	}
	mysqli_close($con);	
?>	