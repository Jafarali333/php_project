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

// Fetch user ID
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $uid = htmlspecialchars($row['id']);
}

if (isset($_GET['pid'])) {
    $product_id = intval($_GET['pid']);

    // Check if product is already in the cart
    $checkQuery = "SELECT cquantity FROM cart WHERE id = ? AND pid = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ii", $uid, $product_id);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) > 0) {
        // Product already in cart, update quantity
        $row = mysqli_fetch_assoc($checkResult);
        $newQuantity = $row['cquantity'] + 1;

        $updateQuery = "UPDATE cart SET cquantity = ? WHERE id = ? AND pid = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "iii", $newQuantity, $uid, $product_id);
        mysqli_stmt_execute($updateStmt);
        
        echo "Product quantity updated successfully.";
    } else {
        // Product not in cart, insert new record
        $insertQuery = "INSERT INTO cart (id, pid, cquantity) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        $quantity = 1; // Set initial quantity to 1
        mysqli_stmt_bind_param($insertStmt, "iii", $uid, $product_id, $quantity);
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "Product added to cart successfully.";
        } else {
            echo "Error adding product to cart: " . mysqli_error($conn);
        }
    }

    header("Location: cart.php");
    exit;
}

mysqli_close($conn);
?>
