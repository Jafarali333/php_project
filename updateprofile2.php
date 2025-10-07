<?php

session_start(); 
// Database connection
include('dbconfig.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['username'])) {
    $rusername =($_GET['username']);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
//$password="";
$name = $_POST['username'];
$number = $_POST['number'];
$email = $_POST['email'];
$adress= $_POST['adress'];


    $sql = "UPDATE users SET 
    username = '$name', 
    number = '$number', 
    email = '$email', 
    address = '$adress' 
    WHERE username = '$rusername'";


// Execute query
$result = mysqli_query($conn, $sql);
//echo $sql; // Check the constructed SQL

// Check for errors
if (!$result) {
    echo "Error updating profile: " . mysqli_error($conn);
} else {
    $_SESSION['username'] = $name;
    echo "profile updated successfully.";
    header("Location: index.php");
}

?>