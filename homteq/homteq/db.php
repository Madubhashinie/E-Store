<?php
/*
$dbhost = 'phpmyadmin.localhost';
$dbuser = 'root';
$dbpass = 'T#def@456M';
$dbname = 'w2051854_0';
//create a DB connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//if the DB connection fails, display an error message and exit
if (!$conn)
{
die('Could not connect: ' . mysqli_error($conn));
}
//select the database
mysqli_select_db($conn, $dbname);
*/
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'T#def@456M';  // Make sure this password is correct
$dbname = 'w2051854_0';

$conn = mysqli_connect($dbhost, $dbuser,"" , $dbname);

if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

echo "Connection successful!";
?>