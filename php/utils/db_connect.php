<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "airline_db";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (ErrorException $e) {
    echo $e;
}
