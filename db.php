<?php
$host = "localhost";
$user = "root";   // default in XAMPP/WAMP
$pass = "";       // empty by default
$dbname = "puzzle_game";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
