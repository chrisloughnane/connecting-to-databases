<?php

/****
*	A simple example of PDO connection to a MySQL database using an object.
*
*	Author: Chris Loughnane 
*	Email: chris.loughnane@gmx.com
*	Porfolio: http://portfolio.chrisloughnane.com/
*	Date: 22/03/2015
*
****/

include 'database.connection.class.php';

/****
* Create instance of class.
*/
$db = new DatabaseConnection();

echo "<h3>PDO MySQL database connection via object handler example</h3>";

/****
* Table name you want to use
*/
$table = "simple_example";

dropTable($table);

createTable($table);

populateTable($table);+

displayhRows($table);

function dropTable($table)
{
	global $db;

	/****
	* Drop(delete) the table if it already exists.
	*/
	try{
		$db->query("DROP TABLE $table");

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
		
		/****
		* Using DB object to create the table.
		*/
		$db -> query($sql);

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

		/****
		* Using DB object to populate the table.
		*/
		$db->query($val);

		$count = $db->select("SELECT count(*) FROM " . $table);

		echo '<br>Created ' . $count[0][0] . ' row(s) in <b>' . $table . "</b> table.";

	}catch(PDOException $e){
	    echo "<br>" . $e->getMessage();//Remove or change message in production code
	}
}

function displayhRows($table)
{
	global $db;

	try{
	    $rows = $db -> select("SELECT * FROM " . $table);

	    echo "<br><br><h3>The following rows were found in the database.</h3>";

	    /****
	    * Handle the return from the db object.
	    * Note the column fields are case sensitive!
	    */
	    foreach ($rows as $row):
	        echo "<br><b>" . $row['Name'] . "</b> is " . $row['Gender'];
		endforeach;
	}
	catch (PDOException $e){
		$error = 'Error getting data.' . $e->getMessage();
		include 'error.html.php';
	}
}
