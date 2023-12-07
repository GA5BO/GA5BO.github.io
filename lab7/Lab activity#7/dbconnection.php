<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "lab_activity_db";

$conn = mysqli_connect ($servername, $username, $password, $databasename);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>