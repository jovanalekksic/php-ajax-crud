<?php

$host = "localhost";
$user = "root";
$password = "";
$port = 3307;  //na mom racunaru je ovaj port
$database = "knjige";

$conn = new mysqli($host, $user, $password, $database,3307);

if ($conn->connect_errno) {
    exit("Connection failed. Error: " . $conn->connect_error);
}
