<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
}
else{
    header("Location: signin.html");
}

// Fetch user ID
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $uid = htmlspecialchars($row['id']);
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);


    // Check if product is already in liked items
    $checkQuery = "SELECT p_id FROM liked_items WHERE c_id = ? AND p_id = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ii", $uid, $product_id);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) > 0) {
        // Product already in cart, update quantity
        
        
        echo "Product is already liked.";
    }
    else{
        // Product not in cart, insert new record
        $insertQuery = "INSERT INTO liked_items (c_id, p_id) VALUES (?,?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ii", $uid, $product_id);
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "Product added to liked products successfully.";
        } else {
            echo "Error adding product to liked products !!!! " . mysqli_error($conn);
        }
    }

    header("Location:liked.php");
    exit;
}

mysqli_close($conn);
?>
