<?php
require "../db.php";

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $password = $conn->real_escape_string($_POST['password']);
    $number = $conn->real_escape_string($_POST['number']);
    $district = $conn->real_escape_string($_POST['district']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $type_of_entity = $conn->real_escape_string($_POST['type_of_entity']);
    $date = Date("Y-m-d / h:i:s A");

    // Hash the password
    $hashed_password = $password;

    // Insert data into the database
    $sql = "INSERT INTO admins (user_id, user_name, password, number, email, district, address, type_of_entity, registered_at) 
            VALUES ('', '$user_name', '$hashed_password', '$number', '$email', '$district', '$address', '$type_of_entity', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; padding: 5px;'>User added successfully!</p>";
    } else {
        echo "<p style='color: red; padding: 5px;'>Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red; padding: 5px;'>Invalid request method!</p>";
}

$conn->close();
?>
