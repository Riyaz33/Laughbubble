<?php require($_SERVER['DOCUMENT_ROOT'] . '/header.php' ); ?>
<?php include_once("/analytic.php"); ?><html>
<head>
<link rel="stylesheet" type="text/css" href="/main/posts.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


</head>

<?php

/*Connects to database*/
$con = mysqli_connect($db_host,$db_username,$db_pass, $db_name);


/*
Query to database in taking out every single like that is from that user. Put that information inside of an array.
*/
$query = "SELECT image_ID FROM userLike WHERE user_ID = $id";
$row = mysqli_fetch_assoc(mysqli_query($con, $query));
$queryLoop = $con->query($query);
while ($result=mysqli_fetch_array($queryLoop)) {
	$likeTable[] = $result;
}

/*
Take all the rows inside of userPosts if requirements have been reached. Sort code by descending score. Put all information inside
of the #newSorted
*/
$query = "SELECT id, laughs, title, timeUpload, img FROM userPosts WHERE laughs >1 ORDER BY score DESC";
$row = mysqli_fetch_assoc(mysqli_query($con, $query));
$queryLoop = $con->query($query);

	echo '<div id="scroll">';

//while loop is required to store all selected database information into $dbPosts
	while ($result=mysqli_fetch_array($queryLoop)) {
		$newSorted[] = $result;
	}
	
//loop through the newSorted array.

echo '<div class="container"><div class="spacer"></div></div>';
for ($x=0;$x<count($newSorted);$x++) {
	//The images inside of $newSorted is displayed
	$pictureID = $newSorted[$x]['id'];
	$laughs = $newSorted[$x]['laughs'];
	$laughID = "laugh".$pictureID;
	echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><a href="/main/add/image.php?imageID='.$pictureID.'"><h4 class="picTitle">'.$newSorted[$x]["title"].'</h4></a></div><div class="col-md-2 col-xs-2 col-xs-1"></div></div>';
	echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div>';
	echo '<a href="/main/add/image.php?imageID='.$pictureID.'"><img src="data:image/jpeg;base64,'.base64_encode($newSorted[$x]['img']).'" class="posts col-md-8 col-sm-8 col-xs-10"/></a><br>';
	echo '<div class="col-md-2 col-sm-2 col-xs-1 "></div></div>';
	
	/*
	$needLike is a variable set to check if the like button needs to be yellow.
	Currently it is false. Foreach loops through entire $likeTable
	*/
	$needlike = false;
	foreach ($likeTable as $k => $v) {
	
	//if value of laugh in laughtable is equal to the one being printed out from the page, change need like variable into true. call the loadXMLDOC
		if ($v["image_ID"] == $pictureID) {
			$needlike=true;
			echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><button name="'.$pictureID.'" type="button" id="'.$pictureID.'" class="btn btn-warning btn-lg" onclick="loadXMLDoc('.$pictureID.','.$laughs.',true)"><span class=" glyphicon glyphicon-thumbs-up"></span></a></button> ';
			//to make code efficient, after the number has been matched to the printed picture, take it out from the array.
			unset($likeTable[$k]);
			break;
		}
	}
	
	/*
	If needlike still ends up being false, the picture does not need to be liked. 
	*/
	if ($needlike == false) {
	echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><button name="'.$pictureID.'" type="button" class="btn btn-lg " id="'.$pictureID.'" onclick="loadXMLDoc('.$pictureID.','.$laughs.',false)"><span class=" glyphicon glyphicon-thumbs-up"></span></a></button>';
	}
	
	
	echo '<div class="pull-right"><a href="/main/add/image.php?imageID='.$pictureID.'"><h4>Laughs: <span id="'.$laughID.'"> '.$laughs.'</span> </h4></a></div></div><div class="col-md-2 col-sm-2 col-xs-1 "></div></div>';
	
}
	

	
?>

<script>

/*
Create current array which stores all the photo id that was liked.
*/
var current = [];


function loadXMLDoc(ID, laughs, liked)
{
$(document).ready(function(){

/*
Use Jquery's ajax to send request to database. 
If photo was already liked (when the page was created), lower the laugh number. If photo has been liked(when the page was created), and the button was pressed again, 
add picture_id into current array and change it to a "Blank" (non-yellow) color.
If photo was not already liked (when teh page was created), increase the laugh number. If photo has not been liked (when the page was created), and the button was pressed
again, add pictrue)id into current araray and change like button to a "yellow" color. Current array helps to see if picture laugh amount has changed after the page 
has been loaded.
*/
$.ajax({url:"add/laugh.php?q="+ID,success:function(result){
    $('#'+ ID).toggleClass(" btn-warning ");
   
    	var noneEqual = true; 
	if (liked == true) {
		
		for (var x = 0; x<current.length; x++) {
			if (current[x] == ID) {
				current.splice(x,1);
				noneEqual = false; 
				$('#laugh'+ID).html(laughs);
				break;
			}
			
		}
		
		if (noneEqual == true) {
			current.push(ID);
			$('#laugh'+ID).html(laughs-1);
		}
	} else {
		for (var x = 0; x<current.length; x++) {
			if (current[x] == ID) {
				current.splice(x,1);
				noneEqual = false; 
				$('#laugh'+ID).html(laughs);
				break;
			}
			
		}
		
		if (noneEqual == true) {
			current.push(ID);
			$('#laugh'+ID).html(laughs+1);
		}		
	}

  }});
  
});
}




</script>

</html>