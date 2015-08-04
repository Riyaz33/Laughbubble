<?php 
	include($_SERVER['DOCUMENT_ROOT'] . '/header.php' );
	session_start();

$userID = $id;


//Getting total number of laughs of the posts of the pictures of the user has posted
$queryL = "SELECT SUM(laughs) FROM userPosts where user_ID = '$userID'";
$res = mysqli_query($db,$queryL);
$rowL = mysqli_fetch_row($res);
$laughs = $rowL[0];

	//Determining the rank of user based on # of laughs
	if(is_null($laughs)){
		$laughs = 0;
	}
	$rank = "Beginner";
	
	if($laughs > 15 && $laughs < 51) {
	 $rank = "Apprentice";
	} else if($laughs > 50 && $laughs < 101 ){
	$rank = "Laugh Pro";
	} else if($laughs > 100 && $laughs < 301) {
	$rank = "Laugh Master";
	} else if ($laughs > 300){
	$rank = "Comedian";
	}

//Getting the bio from the data base
$queryB = "SELECT `bio` from userTable where id = '$userID'";
$resB = mysqli_query($db, $queryB);
$rowB = mysqli_fetch_array($resB);
$bio = $rowB[0];


?>

 <html>
    <head>
    <link href = "http://laughbubble.com/design/css/Styles.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">
    	<div class="spacer"></div>
    </div>
    <div class="container-fluid">
  	<div class="col-md-4 col-xs-5">
  
        <div class="jumbotron">
    
        	<!--Profile Picture -->
        	<img src="profile_default.jpg">
        		
        		<!-- Profile info, includes: username, rank, bio, number of laughs-->
        		<h3><span class="boldtext">User: </span><?php echo '<a data-toggle="modal" data-target ="#myModal">'.$rank.'</a> '; echo $un;?></h3>
        		<h3><span class="boldtext">Laughs: </span><?php echo $laughs; ?></h3>
        		<h3><span class="boldtext">Biography: </span><div id= "bio"><?php  printf($bio);?></div></h3>
        		
		<!-- Ranking system popup-->
        	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" arialabelledby="myModalLablel" aria-hidden="true">
                                        		<div class="modal-dialog">
   								 <div class="modal-content">
     									 <div class="modal-header">
        							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      			  <h3 class="modal-title" id="myModalLabel">Available Ranks</h3>
     				 </div>
      					<div class="modal-body">
      						
       						<div class="text-center">	
							<ul>
							<li>0-15 Laughs = Beginner </li>
							<li>16-50 Laughs = Apprentice </li>
							<li>51-100 Laughs = Laugh Pro </li>
							<li> 101-300 Laughs = Laugh Master </li>
							<li> 300+ Laughs = Comedian </li>
							</ul>
      						</div>
      					<div class="modal-footer">
       					<center><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></center>
				        
     					 </div>

    </div>
  </div>
</div>  
                
        
    
      </div>
    </div>
  </div>

       
        
        
        <div class="container-fluid">  <!-- fluid so it fills all space available -->
        <div class="col-md-8 col-xs-7 ">
      
<!-- Tabs on profile page-->
<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
    		<!--Title of 'posts' tab-->
    		<li class= "active" role="presentation" ><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Posts</a></li>
    		<!--Title of 'Laughed At' tab-->
    		<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Laughed At</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    		<!--Users posts tab content -->
    		<div role="tabpanel" class="tab-pane active" id="messages">
    
			<?php //Posts by User Tab

			//MySQL query to get the user's posts
			$query = "SELECT * FROM userPosts  WHERE user_ID = '$userID' ORDER BY timeUpload DESC";
			$row = mysqli_fetch_assoc(mysqli_query($db, $query));
			$queryLoop = $db->query($query);
	
			echo '<div class="container"><div class="spacer"></div></div>';
			//checking if user has at least 1 post
			if ($queryLoop->num_rows > 0) {
				//Displaying the user's posts
				while ($result=mysqli_fetch_array($queryLoop)) { //goes through a loop to go through each row
					//Gets picture database ID and title
					$pictureID = $result['id'];
					$pictureTitle = $result['title'];
	
					//Display's pictures here
					echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><a href="/main/add/image.php?imageID='.$pictureID.'"><h4 class="picTitle">'.$pictureTitle.'</h4></a></div><div class="col-md-2 col-sm-2 col-xs-1"></div></div><div class="container"> <div class="col-md-2 col-sm-2 col-xs-1"></div><a href="/main/add/image.php?imageID='.$pictureID.'"><img src="data:image/jpeg;base64,'.base64_encode($result['img']).'" class="posts col-md-8 col-sm-8 col-xs-10"/></a><br><div class="col-md-2 col-sm-2 col-xs-1 pull-right"></div></div><div class="container extraS"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><div class="pull-right"><a href="http://www.laughbubble.com/main/add/image.php?imageID='.$pictureID.'"><h4>Laughs: '.$result['laughs'].'</h4></a></div></div><div class="col-md-2 col-sm-2 col-xs-1"></div></div>';
				}
	
			} else { //says user has not posted when they have no pictures posted
				echo $_SESSION["username"].' has not posted anything yet.';
			}	
			?>
		
 			<div class="spacer"></div>
    		</div>
    		<!--Posts laughed at by user-->
    		<div role="tabpanel" class="tab-pane" id="settings">
    			<?php //Posts laughed at at by user tab 
    	
    			//MySQL Query to get which pics the user liked
    			$query = "SELECT image_ID from userLike where user_ID = '$userID'";
    			$result = mysqli_query($db, $query);
			//key counter for $imageID array
    			$i=0;
    			//gets the image ID's liked by the user and stores them in array $imageID
    			while($row = mysqli_fetch_assoc($result)) {
    				$imageID[$i] = $row["image_ID"];
    				$i++;
    	    		}
    	    		
    	    		//Second query to display the images the user laughed at
    	    		//uses $imageID to determine which pictures to pick from userPosts database
    			$query2 = "SELECT * FROM userPosts WHERE id IN (".implode(',',$imageID).") ORDER BY timeUpload DESC";
    			$result2 = mysqli_query($db, $query2);
    			
    			while($row2 = mysqli_fetch_assoc($result2)){
    				//Picture ID and title from databse
    				$pictureID = $row2['id'];
				$pictureTitle = $row2['title'];
				
				//Displaying the pictures on screen
				echo '
				<div class="container"><div class="col-md-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><a href="/main/add/image.php?imageID='.$pictureID.'"><h4 class="picTitle">'.$pictureTitle.'</h4></a></div><div class="col-md-2 col-sm-2 col-xs-1"></div></div><div class="container"> <div class=" col-md-1"></div><a href="/main/add/image.php?imageID='.$pictureID.'"><img src="data:image/jpeg;base64,'.base64_encode($row2['img']).'" class="posts col-md-8 col-sm-8 col-xs-10"/></a><br><div class="col-md-2 col-sm-2 col-xs-1 pull-right">
	
				</div></div><div class="container extraS"><div class="col-md-8 col-sm-8 col-xs-10">
	
				<div class="pull-right"><a href="http://www.laughbubble.com/main/add/image.php?imageID='.$pictureID.'"><h4>Laughs: '.$row2['laughs'].'</h4></a></div></div><div class="col-md-2 col-sm-2 col-xs-1"></div></div>';
			}
    	 		?>
			<div class="spacer"></div>
    		</div>


</div>
</div>
</div>
</div>
</div>

  
 
</div>

</div>
    
        <div class ="navbar navbar-default navbar-fixed-bottom">   <!-- Footer  -->
            <div class = "container">
                <p class = "navbar-text pull-left"> LaughBubble Co.</p>
                <p class = "navbar-text pull-right">Property of: Darren, Ryan, Riyaz, Vrund, Amal, Kashav, and Calvin </p>
            </div>
        </div>    
            
          </body>
</html>