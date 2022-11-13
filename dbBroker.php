<?php

$host = "localhost";
$user = "root";
$password = "";
$port = "3307";  //na mom racunaru je ovaj port
$database = "knjige";

$connection = new mysqli($host, $user, $password, $database, $port);

if ($connection->connect_errno) {
    exit("Connection failed. Error: " . $connection->connect_error);
}
