<?php
session_start(); // Start session to persist login state

include('dbconfig.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    //$uid = mysqli_real_escape_string($conn, $_POST['id']);
    // Validate inputs
    if (empty($username) || empty($password)) {
        echo "Please enter username and password";
        exit;
    }
    
    // Query to fetch hashed password for the given username
    $sql = "SELECT password FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            
            // Verify hashed password with the entered password
            if (password_verify($password,$hashed_password)) {
                // Password is correct, start a new session
                $_SESSION['username'] = $username;
               // $_SESSION['id'] = $uid;
                echo "Login successful!";
                header("Location: index.php"); // Redirect to profile page
                exit;
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "Username not found";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
