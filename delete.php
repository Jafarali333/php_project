<?php
// Database connection
include('dbconfig.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
$product_id = intval($_GET['id']); // Sanitize and convert to integer

    $sql = "UPDATE products SET 
    deleted=1 
    WHERE pid = $product_id";

$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    echo "Error deleting record: " . mysqli_error($conn);
} else {
    echo "Record deleted successfully.";
    header("Location: adminpanel.php");
}

?>