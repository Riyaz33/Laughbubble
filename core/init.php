<?php
session_start();
// error rporting: (uncomment if necessary) error_reporting(E_ALL);

//Database connection
include($_SERVER['DOCUMENT_ROOT'] . '/access/connectMain.php' );
//error message if database connection failed
if ($db->connect_errno) {
    echo "Failed to connect to MySQL DB: (" . $db->connect_errno . ") " . $db->connect_error;
}

//Sets info variables of user from database 
if (isset($_SESSION['id'])) {
	$uid = $_SESSION['id'];
	$query = " SELECT * FROM `userTable` WHERE id = '$uid' ";
	$row = sendQuery($db, $query);
	list($id, $email, $un, $pw, $active) = setVariables($row);
}

//returns db variables
function setVariables($row) {
	$dbID 		= $row[0];
	$dbEmail	= $row[1];
	$dbUsername 	= $row[2];
	$dbPassword 	= $row[3];
	$dbActive	= $row[4];

	return array($dbID, $dbEmail, $dbUsername, $dbPassword, $dbActive);
}

//function used to do mysql query's
function sendQuery($connection, $query) {
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result);
	return $row;
}

?>