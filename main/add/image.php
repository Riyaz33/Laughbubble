<?php require($_SERVER['DOCUMENT_ROOT'] . '/header.php' ); ?><html>
<head>
<link rel="stylesheet" type="text/css" href="posts.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


</head>
<?php
/*Code is close to identical to posts.php (please refer to that page). The only difference is that only one image is shown and that imageID is
the one taken from $Request['imageID']. 
*/
$imageID = $_REQUEST['imageID'];

include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );

$query = "SELECT image_ID FROM userLike WHERE user_ID = $id";
$row = mysqli_fetch_assoc(mysqli_query($db, $query));
$queryLoop = $db->query($query);
while ($result=mysqli_fetch_array($queryLoop)) {
	$likeTable[] = $result;
}


$query = "SELECT id, laughs, title, timeUpload, img FROM userPosts WHERE id = $imageID";
$row = mysqli_fetch_assoc(mysqli_query($db, $query));
$queryLoop = $db->query($query);

	echo '<div id="scroll">';

//while loop is required to store all selected database information into $dbPosts
	while ($result=mysqli_fetch_array($queryLoop)) {
		$newSorted[] = $result;
	}
	
//function is called and stored into variable $newSorted

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
	$needlike = false;
	foreach ($likeTable as $k => $v) {
	
	//echo $newSorted[$x]['id'];
		if ($v["image_ID"] == $pictureID) {
			$needlike=true;
			echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><button name="'.$pictureID.'" type="button" id="'.$pictureID.'" class="btn btn-warning btn-lg" onclick="loadXMLDoc('.$pictureID.','.$laughs.',true)"><span class=" glyphicon glyphicon-thumbs-up"></span></a></button> ';
			unset($likeTable[$k]);
			break;
		}
	}
	if ($needlike == false) {
	echo '<div class="container"><div class="col-md-2 col-sm-2 col-xs-1"></div><div class="col-md-8 col-sm-8 col-xs-10"><button name="'.$pictureID.'" type="button" class="btn btn-lg " id="'.$pictureID.'" onclick="loadXMLDoc('.$pictureID.','.$laughs.',false)"><span class=" glyphicon glyphicon-thumbs-up"></span></a></button>';
	}
	
	
	echo '<div class="pull-right"><a href="/main/add/image.php?imageID='.$pictureID.'"><h4>Laughs: <span id="'.$laughID.'"> '.$laughs.'</span> </h4></a></div></div><div class="col-md-2 col-sm-2 col-xs-1 "></div></div>';
	
}
	

	
?>

<script>

var current = [];
function loadXMLDoc(ID, laughs, liked)
{
$(document).ready(function(){
$.ajax({url:"laugh.php?q="+ID,success:function(result){
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


</body>
</html>