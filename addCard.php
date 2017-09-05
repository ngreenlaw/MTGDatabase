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
	
if(!($stmt = $mysql_handle->prepare("INSERT INTO cards( name, cardType, cost, color, rarity, setName, deckName )
	VALUES
	(?,?,?,?,?,?,?);"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssissss",$_POST['name'],$_POST['cardType'],$_POST['cost'],$_POST['color']
,$_POST['rarity'],$_POST['setName'],$_POST['deckName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " row to cards.";
}
echo '</br><a href="http://web.engr.oregonstate.edu/~greenlan/projectHTML.php">Return</a>';
?>