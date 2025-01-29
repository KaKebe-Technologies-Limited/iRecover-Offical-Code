

<?php
// Define constants
define('DB_HOST', 'localhost');
define('DB_USER', 'u850523537_iRecoverUser');
define('DB_PASS', '@Admin 101619');
define('DB_NAME', 'u850523537_iRecover');

// Create connection using constants
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}