<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
    
    // Fetch user ID
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $uid = htmlspecialchars($row['id']);
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "You must be logged in to perform this action.";
    exit;
}

// Get the product ID from the URL
if (isset($_GET['pid'])) {
    $product_id = intval($_GET['pid']);

    // Delete the product from the cart
    $stmt = $conn->prepare("DELETE FROM liked_items WHERE c_id = ? AND p_id = ?");
    $stmt->bind_param("ii", $uid, $product_id);

    if ($stmt->execute()) {
        // Redirect back to the cart page or show a success message
        header("Location: liked.php?message=Product removed successfully");
        exit;
    } else {
        echo "Error removing product: " . mysqli_error($conn);
    }
} else {
    echo "Product ID not specified.";
}

mysqli_close($conn);
?>
