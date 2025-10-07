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
$name = $_POST['pname'];
$category = $_POST['category'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];

// Handle file upload
$photo = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo = basename($_FILES['photo']['name']);
    $target = "uploads/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
}

//echo $photo;
//echo $price;
$product_id = intval($_GET['id']); // Sanitize and convert to integer
//echo $photo;
// Fetch product details using $product_id
if ($photo) {
    $sql = "UPDATE products SET 
    name = '$name', 
    price = $price, 
    category = '$category', 
    quantity = $quantity, 
    description = '$description', 
    photo = '$photo' 
    WHERE pid = $product_id";
} else {
    $sql = "UPDATE products SET 
        name = '$name', 
        price = $price, 
        category = '$category', 
        quantity = $quantity, 
        description = '$description'
        WHERE pid = $product_id";
}

// Execute query
$result = mysqli_query($conn, $sql);
//echo $sql; // Check the constructed SQL

// Check for errors
if (!$result) {
    echo "Error updating record: " . mysqli_error($conn);
} else {
    echo "Record updated successfully.";
    header("Location: adminpanel.php");
}

?>