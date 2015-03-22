<?php

/****
*	A simple example of PDO connection to a MySQL database using include.
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

try
{
	$db = new PDO('mysql:host=' . $location . ';dbname=' . $database . ';charset=utf8', $username, $password);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	echo '<h3>Connected to <b>' . $location . '</b></h3>';
}
catch (PDOException $e){
	echo "There was a problem." . "<br/>";
	$error = 'Unable to connect to the <b>' . $location . '</b> database. Please try again later.';
	include 'error.html.php';
	//exit();  //only uncomment this if you want to a complete lockout when fail occurs.
}