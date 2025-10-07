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
    $usrname = mysqli_real_escape_string($conn, $_POST['username']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword= mysqli_real_escape_string($conn, $_POST['cpassword']);

// Validation results
$errors = [];

// Validate username length (6 to 20 characters)
if (strlen($usrname) < 6 || strlen($usrname) > 20) {
    $errors[] = "Username must be between 6 and 20 characters.";
}

// Validate phone number length (10 digits)
if (!preg_match('/^\d{10}$/', $number)) {
    $errors[] = "Phone number must be exactly 10 digits.";
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Validate password (minimum length 6)
if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters long.";
}

// Check if passwords match
if ($password !== $cpassword) {
    $errors[] = "Passwords do not match.";
}

// Display validation results
if (empty($errors)) {
    echo "All inputs are valid!";
} else {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
        exit();
    }
}


    // Check for empty fields
    if (empty($usrname) || empty($number) || empty($email) || empty($password)) {
        echo "Please fill all required fields";
        exit;
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if username or email already exists
    $sql_check = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
    $stmt_check = mysqli_prepare(   $conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ss", $usrname, $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        echo "Username or email already exists";
        exit;
    }
    
    // Insert user data into database
    $sql = "INSERT INTO users (username, number, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $usrname, $number, $email, $hashed_password);
        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful";
            header("Location: signin.html");
            exit;
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
