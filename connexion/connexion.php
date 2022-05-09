<?php

require('config.php'); // file with informations to connect 

function connectDB(){
    try{ //try to execute request in 
        global $servername, $username, $mdp, $dbname; //var with information to connect
        $co = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $mdp); // connexion to the DB 
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Attribute to see the error in the code 
    }
    catch(PDOException $e){ // if it can't connect to the DB
        die("Error : " . $e->getMessage()); // stop php code 
    }
    return $co;
}

?>