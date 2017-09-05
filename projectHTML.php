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

h1{
	text-align:center;
}
</style>

<h1>Magic The Gathering Database by Nathan Greenlaw</h1>
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

/*Deck table being displayed and inserting into deck table*/

$sql = 'SELECT * FROM `decks`';
$result = $mysql_handle->query($sql);

if ($result->num_rows > 0) {
    echo "<table><caption>Decks</caption><tr><th>Name</th><th>Color</th><th>cardCount</th><th>playFormat</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td>" .
		"<td>".$row["color"]."</td>". "<td>".$row["cardCount"]."</td>".
		"<td>".$row["playFormat"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div>
	<form method="post" action="addDeck.php"> 

		<fieldset>
			<label>Name:</label>
			<p><input type="text" name="name" /></p>
			
			<label>Color:</label>
			<p><input type="text" name="color" /></p>
			
			<label>Card Count:</label>
			<p><input type="number" name="cardCount" /></p>
			
			<label>Format:</label>
			<p><input type="text" name="playFormat" /></p>
		</fieldset>
		<p><input type="submit" value="Submit Deck"/></p>
	</form>
</div>


<?php
/*adding themes table*/

$sql = 'SELECT * FROM `themes`';
$result = $mysql_handle->query($sql);

if ($result->num_rows > 0) {
	echo "<br></br>";
    echo "<table><caption>Themes</caption><tr><th>Block</th><th>Inspiration</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["block"]."</td>". "<td>".$row["inspiration"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div>
	<form method="post" action="addTheme.php"> 

		<fieldset>
			<label>Block:</label>
			<p><input type="text" name="block" /></p>
			
			<label>Inspiration:</label>
			<p><input type="text" name="inspiration" /></p>
	
		</fieldset>
		<p><input type="submit" value="Submit Theme"/></p>
	</form>
</div>



<?php
$sql = 'SELECT * FROM `sets`';
$result = $mysql_handle->query($sql);

if ($result->num_rows > 0) {
	echo "<br></br>";
    echo "<table><caption>Sets</caption><tr><th>Name</th><th>cardCount</th><th>Block</th><th>releaseDate</th></tr>";
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["name"]."</td>" .
		"<td>".$row["cardCount"]."</td>". "<td>".$row["block"]."</td>".
		"<td>".$row["releaseDate"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div>
	<form method="post" action="addSet.php"> 

		<fieldset>
			<label>Name:</label>
			<p><input type="text" name="name" /></p>
			
			<label>Card Count:</label>
			<p><input type="number" name="cardCount" /></p>
			
			<label>Block:</label>
			<p><select name="block">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT block FROM themes"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($block)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $block . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
			
			<label>Release Date:</label>
			<p><input type="date" name="releaseDate" /></p>
		</fieldset>
		<p><input type="submit" value="Submit Set"/></p>
	</form>
</div>

<?php
/*adding built table*/

$sql = 'SELECT * FROM `built`';
$result = $mysql_handle->query($sql);

if ($result->num_rows > 0) {
	echo "<br></br>";
    echo "<table><caption>Built</caption><tr><th>setName</th><th>deckName</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["setName"]."</td>". "<td>".$row["deckName"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div>
	<form method="post" action="addBuilt.php"> 

		<fieldset>
			<label>Set Name:</label>
			<p><select name="setName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT name FROM sets"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($setName)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $setName . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
			
			<label>Deck Name:</label>
			<p><select name="deckName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT name FROM decks"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($deckName)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $deckName . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
	
		</fieldset>
		<p><input type="submit" value="Submit Built"/></p>
	</form>
</div>

<!-- Filter by setName -->
<div>
	<form method="post" action="builtFilterSetName.php"> 

			<label>Filter By Set:</label>
			<select name="setName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct setName FROM built"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by deckName -->
<div>
	<form method="post" action="builtFilterDeckName.php"> 

			<label>Filter By Deck:</label>
			<select name="deckName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct deckName FROM built"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Delete Queries -->

</br>

<!-- Delete by setName -->
<div>
	<form method="post" action="builtDeleteSetName.php"> 

			<label>Delete By Set:</label>
			<select name="setName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct setName FROM built"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Delete"/>
	</form>
</div>

<!-- Delete by deckName -->
<div>
	<form method="post" action="builtDeleteDeckName.php"> 

			<label>Delete By Deck:</label>
			<select name="deckName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct deckName FROM built"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Delete"/>
	</form>
</div>

<?php
/*Add cards table*/
$sql = 'SELECT * FROM `cards`';
$result = $mysql_handle->query($sql);

if ($result->num_rows > 0) {
	echo "<br></br>";
    echo "<table><caption>Cards</caption><tr><th>Name</th><th>cardType</th><th>cost</th><th>color</th><th>rarity</th><th>setName</th><th>deckName</th></tr>";
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["name"]."</td>" .
		"<td>".$row["cardType"]."</td>". "<td>".$row["cost"]."</td>".
		"<td>".$row["color"]."</td>"."<td>".$row["rarity"]. "<td>".$row["setName"]."</td>".
		"<td>".$row["deckName"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div>
	<form method="post" action="addCard.php"> 

		<fieldset>
			<label>Name:</label>
			<p><input type="text" name="name" /></p>
			
			<label>Type:</label>
			<p><input type="text" name="cardType" /></p>
			
			<label>Cost:</label>
			<p><input type="number" name="cost" /></p>
			
			<label>Color:</label>
			<p><input type="text" name="color" /></p>
			
			<label>Rarity:</label>
			<p><input type="text" name="rarity" /></p>
			
			<label>Set Name:</label>
			<p><select name="setName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct name FROM sets"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
			
			<label>Deck Name:</label>
			<p><select name="deckName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct name FROM decks"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>

		</fieldset>
		<p><input type="submit" value="Submit Card"/></p>
	</form>
</div>

<!-- Filter by cardType -->
<div>
	<form method="post" action="cardFilterType.php"> 

			<label>Filter By Type:</label>
			<select name="cardType">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct cardType FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($cardType)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $cardType . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by cost -->
<div>
	<form method="post" action="cardFilterCost.php"> 

			<label>Filter By Cost:</label>
			<select name="cost">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct cost FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($cost)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $cost . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by color -->
<div>
	<form method="post" action="cardFilterColor.php"> 

			<label>Filter By Color:</label>
			<select name="color">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct color FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($color)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $color . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by rarity -->
<div>
	<form method="post" action="cardFilterRarity.php"> 

			<label>Filter By Rarity:</label>
			<select name="rarity">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct rarity FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($rarity)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $rarity . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by setName -->
<div>
	<form method="post" action="cardFilterSetName.php"> 

			<label>Filter By Set:</label>
			<select name="setName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct setName FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<!-- Filter by deckName -->
<div>
	<form method="post" action="cardFilterDeckName.php"> 

			<label>Filter By Deck:</label>
			<select name="deckName">
				<?php
				if(!($stmt = $mysql_handle->prepare("SELECT distinct deckName FROM cards"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				if(!$stmt->bind_result($name)){
					echo "Bind failed: "  . $mysql_handle->connect_errno . " " . $mysql_handle->connect_error;
				}
				while($stmt->fetch()){
					echo '<option > ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<input type="submit" value="Filter"/>
	</form>
</div>

<?php
mysqli_close($mysql_handle);

?>

</body>
</html>