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

class DatabaseConnection {

    protected static $connection;
    
    public function connect(){
        
        // Try and connect to the database
        if(!isset(self::$connection))
        {

        	include 'database.connection.settings.php';

            self::$connection = new PDO('mysql:host=' . $location . ';dbname=' . $database . ';charset=utf8', $username, $password);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }
    
        // If connection was not successful, handle the error
        if(self::$connection === false)
        {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
    
    public function query($query)
    {
        $connection = $this -> connect();

        $result=$connection->prepare($query);
        $result->execute();

        return $result;
    }
    
    public function select($query)
    {
        $rows = array();
        $result = $this -> query($query);
        if($result === false)
        {
            return false;
        }

        while ($row = $result -> fetch())
        {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function error()
    {
        $connection = $this -> connect();
        return $connection->errorInfo();
    }
}