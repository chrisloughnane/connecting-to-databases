<?php 

session_start();

$_SESSION["firstname"] =  $_GET["firstname"]; 

$_SESSION["lastname"] =  $_GET["lastname"]; 

$_SESSION["method"] = "GET method";

header('Location: redirectedpage.php');