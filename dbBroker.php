<?php
$host = "localhost";
$db = "iteh-domaci1";
$username = "root";
$password = "";

//konekcija sa bazom
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_errno) {
    exit("Connection with database failed! " . $connection->connect_errno);
}
?>