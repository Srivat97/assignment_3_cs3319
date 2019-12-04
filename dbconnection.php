<?php
/* This file connects to the hospital database, and is accessed by all other files before interacting with the database */
require_once './config/config.php'; 


$connection = mysqli_connect($config['db']['db1']['host'],$config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname'] );

if(!$connection)
{
    die("Database Connection Failed: " . 
            mysqli_connect_error() );
}
?>