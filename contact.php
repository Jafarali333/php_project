<?php
include('dbconfig.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $email = mysqli_real_escape_string($conn, $_POST['contactemail']);

// Validation results
$errors = [];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

} else {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
        exit();
    }
}

    
    // Insert user data into database
    $sql = "INSERT INTO contact (email) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s",$email);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
    
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);

?>
