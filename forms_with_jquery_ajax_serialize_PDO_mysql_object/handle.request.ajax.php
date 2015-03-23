<?php

/****
*	A simple example of PDO connection to a MySQL database using an object and adding data from a submitted form.
*
*	Author: Chris Loughnane 
*	Email: chris.loughnane@gmx.com
*	Porfolio: http://portfolio.chrisloughnane.com/
*	Date: 23/03/2015
*
****/

include 'database.connection.class.php';

/****
* Create instance of class.
*/
$db = new DatabaseConnection();

/****
* Table name you want to use
*/
$table = "simple_example";

/****
* Comment out dropTable($table) if you would like to see the table grow.
*/
dropTable($table);

createTable($table);

/****
* Handle AJAX submitted form
*/

if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];

    switch($action) { //Switch case for value of action
      case "example": addToDatabase(); break;
    }
  }
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function addToDatabase(){

  
  $return = $_POST;
  
  if ($return["FirstName"] == ""){
   $return["FirstName"] = "Mickey";
  }
  if ($return["SecondName"] == ""){
    $return["SecondName"] = "Mouse";
  }

  addEntry($return["FirstName"], $return["SecondName"], $return["gender"]);
  
  $return["json"] = json_encode($return);
  echo json_encode($return);
}

function dropTable($table)
{
  global $db;

  /****
  * Drop(delete) the table if it already exists.
  */
  try{
    $db->query("DROP TABLE $table");

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
      firstname VARCHAR( 50 ) NOT NULL, 
      secondname VARCHAR( 50 ) NOT NULL,
      gender VARCHAR( 250 ) NOT NULL);";
    
    /****
    * Using DB object to create the table.
    */
    $db -> query($sql);

  }catch(PDOException $e){
      echo "<br>" . $e->getMessage();//Remove or change message in production code
  }
}

function addEntry($firstname, $secondname, $gender)
{
  global $db;
  global $table;

  try{
    # Insert values to our database
    $val = "INSERT INTO $table (firstname, secondname, gender)
    VALUES
      ('$firstname', '$secondname', '$gender');";
    $val = trim($val);

    /****
    * Using DB object to populate the table.
    */
    $db->query($val);

  }catch(PDOException $e){
      echo "<br>" . $e->getMessage();//Remove or change message in production code
  }
}
?>