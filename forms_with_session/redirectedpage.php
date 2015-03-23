<?php 

session_start();

echo "The redirected page uses a session to display the following:<br>";

echo "<h2>" . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "</h2>";

echo "<br>Using " . $_SESSION["method"];