<?php
session_start();

$db = "cigarette_detection";
$user = "root";
$password = "";
$server = "localhost";

$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}