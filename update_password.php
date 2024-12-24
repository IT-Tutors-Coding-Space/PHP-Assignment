<?php
// Include database connection
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'Registration and login';

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = htmlspecialchars($_POST['token']);

}