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
$sql = "SELECT password FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $rusername);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            }}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
$opassword="";
$npassword = $_POST['password'];
$opassword = $_POST['opassword'];
//echo $number;
$hpassword = password_hash($opassword, PASSWORD_DEFAULT);
$nhpassword = password_hash($npassword, PASSWORD_DEFAULT);
// Verify hashed password with the entered password
if (password_verify($opassword,$hashed_password)) {
    
    $sql = "UPDATE users SET 
    password= '$nhpassword'
    WHERE username = '$rusername'";

}
else{
    //echo $opassword;
   // echo $npassword;
    echo "Wrong old password ";
}

// Execute query
$result = mysqli_query($conn, $sql);
//echo $sql; // Check the constructed SQL

// Check for errors
if (!$result) {
    echo "Error updating profile: " . mysqli_error($conn);
} else {
    $_SESSION['username'] = $rusername;
    echo "profile updated successfully.";
    header("Location: index.php");
}

?>