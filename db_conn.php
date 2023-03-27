<?php

$servername="localhost";
$dbusername="root";
$dbpassword="";
$dbname="10kg_test";

$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);

// Check connection
if (!$conn){
    die("Maintenance Mode.");
}

session_start();
include_once ("sql_utilities.php");


