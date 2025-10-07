<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['uid']) && isset($_POST['pid']) && isset($_POST['quantity'])) {
    $uid = intval($_POST['uid']);
    $pid = intval($_POST['pid']);
    $quantity = intval($_POST['quantity']);

    // Update the cart quantity
    $stmt = $conn->prepare("UPDATE cart SET cquantity = ? WHERE id = ? AND pid = ?");
    $stmt->bind_param("iii", $quantity, $uid, $pid);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    header("Location: cart.php");

    $stmt->close();
}

$conn->close();
?>
