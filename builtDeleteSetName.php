<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'greenlan-db';
$dbuser = 'greenlan-db';
$dbpass = 'VW1PU9s9qH5PhVD6';

ini_set('display_errors', 'On');

$mysql_handle = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($mysql_handle->connect_errno){
	echo "Connection error " . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
	}
	
if(!($stmt = $mysql_handle->prepare("DELETE FROM built WHERE setName=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['setName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " row from built.";
}

echo '</br><a href="http://web.engr.oregonstate.edu/~greenlan/projectHTML.php">Return</a>';
?>