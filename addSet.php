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
	
if(!($stmt = $mysql_handle->prepare("INSERT INTO sets (name, cardCount, block, releaseDate)
	VALUES
	(?,?,?,?);"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("siss",$_POST['name'],$_POST['cardCount'],$_POST['block'],$_POST['releaseDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " row to sets.";
}
echo '</br><a href="http://web.engr.oregonstate.edu/~greenlan/projectHTML.php">Return</a>';
?>