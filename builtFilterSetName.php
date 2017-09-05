<!DOCTYPE html>
<html>
<body>

<style>
td{
	text-align:center;
	border: 1px solid black;
}

th{
	border: 1px solid black;
}

table{
	border: 1px solid black;
	margin-left:auto; 
    margin-right:auto;
}
</style>

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
	
if(!($stmt = $mysql_handle->prepare("SELECT b.setName, name as deck
FROM built b
INNER JOIN decks d ON d.name = b.deckName
WHERE b.setName = ?"))){
echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['setName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->bind_result($setName, $deckName)){
	echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
}

	echo "<br></br>";
	echo "<table><caption>Built</caption><tr><th>setName</th><th>deckName</th></tr>";
		// output data of each row
while($stmt->fetch()) {
echo "<tr><td>".$setName."</td>". "<td>".$deckName."</td></tr>";
}
echo "</table>";

echo '</br><a href="http://web.engr.oregonstate.edu/~greenlan/projectHTML.php">Return</a>';

$stmt->close();
?>

</body>
</html>