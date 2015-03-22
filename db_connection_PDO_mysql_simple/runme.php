<?php

/****
*	A simple example of PDO connection to a MySQL database using object.
*
*	Author: Chris Loughnane 
*	Email: chris.loughnane@gmx.com
*	Porfolio: http://portfolio.chrisloughnane.com/
*	Date: 22/03/2015
*
****/

/****
* Conenction parameters
*/

$location = "localhost";
$database = "connectionexamples";
$username = "chris";
$password = "chris";

/****
* Table name you want to use
*/
$table = "simple_example";

echo "<h3>Simple PDO MySQL database connection example</h3>";
/****
* Make connection to the database
*/
try{
	$db = new PDO('mysql:host=' . $location . ';dbname=' . $database . ';charset=utf8', $username, $password);
	echo '<h3>Connected to <b>' . $location . '</b></h3>';
}
catch (PDOException $e){
	$e->getMessage();
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

/****
* Execute some operations with the connection
*/

dropTable($table);

createTable($table);

populateTable($table);

displayhRows($table);

function dropTable($table)
{
	global $db;

	/****
	* Drop(delete) the table if it already exists.
	*/
	try{
		$sql=$db->prepare("DROP TABLE $table");
		$sql->execute();

		echo "<br><b>" . $table . "</b> table dropped successfully"; 

	}catch(PDOException $e){
		echo "<br>" . $e->getMessage();
	}
}

function createTable($table)
{
	global $db;

	try{
		$sql ="CREATE TABLE IF NOT EXISTS $table(
			ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
			Name VARCHAR( 50 ) NOT NULL, 
			Gender VARCHAR( 250 ) NOT NULL);";
		$db->exec($sql);

		echo "<br><b>" . $table . "</b> table created successfully";

	}catch(PDOException $e){
	    echo "<br>" . $e->getMessage();//Remove or change message in production code
	}
}

function populateTable($table)
{
	global $db;

	try{
		# Insert values to our database
		$val = "INSERT INTO $table (name, gender)
		VALUES
			('Bjarne', 'male'),
			('Marius', 'female'),
			('Jenny', 'female'),
			('Silje', 'female'),
			('Jimbo', 'male'),
			('Tigermuff', 'male'),
			('Lucas', 'male'); ";
		$val = trim($val);
		$count = $db->exec($val);
		 
		// Check how many rows we added.
		echo '<br>Created ' . $count . ' row(s) in <b>' . $table . "</b> table.";

	}catch(PDOException $e){
	    echo "<br>" . $e->getMessage();//Remove or change message in production code
	}
}

function displayhRows($table)
{
	global $db;

	try{
		$sql = "SELECT `name`, `gender` FROM `$table` LIMIT 0, 30 ";
		$statement=$db->prepare($sql);
		$statement->execute();

		echo "<br><br><h3>The following rows were found in the database.</h3>";

		while($row=$statement->fetch()){
			echo "<br><b>" . $row['name'] . "</b> is " . $row['gender'];
		}

	}catch(PDOException $e) {
		echo '<br>' . $e->getMessage();
	}
}