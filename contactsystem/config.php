<?php

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'session_example_database');
define('DB_SERVER', 'localhost');

/* Attempt to connect to MySQL database */
/** @var mysqli $mysqli */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
if($mysqli->connect_errno){
    die("ERROR: Could not connect. (" .$mysqli->connect_errno. ") " . $mysqli->connect_error);
}