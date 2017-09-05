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
	
if(!($stmt = $mysql_handle->prepare("INSERT INTO decks (name, color, cardCount, playFormat)
	VALUES
	(?,?,?,?);"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssis",$_POST['name'],$_POST['color'],$_POST['cardCount'],$_POST['playFormat']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " row to decks.";
}
echo '</br><a href="http://web.engr.oregonstate.edu/~greenlan/projectHTML.php">Return</a>';
?>