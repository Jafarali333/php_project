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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO products (name, category, price, quantity, description, photo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiss", $name, $category, $price, $quantity, $description, $photo);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "New product added successfully!";
        header("Location: addproduct.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
