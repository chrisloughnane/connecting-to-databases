<?php 

session_start();

$_SESSION["firstname"] =  $_POST["firstname"]; 

$_SESSION["lastname"] =  $_POST["lastname"]; 

$_SESSION["method"] = "POST method";

header('Location: redirectedpage.php');


