<?php
// Author: Atheer
// Task: Database connection

$host = "localhost";
$username = "root";
$password = "";
$database = "little_minds_store";
$port = 3308;

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>