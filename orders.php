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
if (!isset($_SESSION['username'])) {
    echo "<p>Please log in to see your orders.</p>";
    exit;
} else {
    $uname = $_SESSION['username'];
}

// SQL query to fetch order data
$sql = "SELECT o.id AS order_id, o.total_amount, o.payment_method, o.delivery_address, o.order_status, 
               oi.product_name, oi.quantity, oi.price, COALESCE(p.photo, 'default.png') AS photo 
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id 
        JOIN products p ON p.name = oi.product_name 
        WHERE o.username = ?
        ORDER BY o.id, oi.product_name";  // Order by order ID and product name
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $uname);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders</title>
<style>
    /* Dark theme styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #121212;
        color: #E0E0E0;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        background-color: #1E1E1E;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }
    h1 {
        text-align: center;
        color: #F0F0F0;
        font-size: 2em;
    }
    .order {
        background-color: #2A2A2A;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }
    .order-header {
        font-size: 1.1em;
        margin-bottom: 10px;
    }
    .order-items {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #333;
    }
    .order-items:last-child {
        border-bottom: none;
    }
    .product-photo {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        margin-right: 10px;
        object-fit: cover;
    }
    .product-name {
        font-weight: bold;
        color: #FFC107;
    }
    .item-info, .order-summary {
        display: flex;
        justify-content: space-between;
        padding-top: 5px;
    }
    .item-info div, .order-summary div {
        width: 33%;
        text-align: center;
    }
    .order-summary {
        margin-top: 10px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Your Orders</h1>
    <?php
    $currentOrderId = null; // Variable to track the current order

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // If the order_id changes, close the previous order block and start a new one
            if ($currentOrderId != $row['order_id']) {
                // Close the previous order block (if exists)
                if ($currentOrderId != null) {
                    echo "</div>"; // Close the previous order
                }
                
                // Print new order header (only once per order)
                $currentOrderId = $row['order_id'];
                echo "<div class='order'>";
                echo "<div class='order-header'>Order ID: #" . htmlspecialchars($currentOrderId) . "</div>";
                echo "<div class='order-header'>Total Amount: $" . htmlspecialchars($row['total_amount']) . "</div>";
                echo "<div class='order-header'>Payment Method: " . htmlspecialchars($row['payment_method']) . "</div>";
                echo "<div class='order-header'>Delivery Address: " . htmlspecialchars($row['delivery_address']) . "</div>";
                echo "<div class='order-header'>Order Status: " . htmlspecialchars($row['order_status']) . "</div>";
            }

            // Display item details
            echo "<div class='order-items'>";
            echo "<img class='product-photo' src='uploads/" . htmlspecialchars($row['photo']) . "' alt='Product Image'>";
            echo "<div class='product-name'>" . htmlspecialchars($row['product_name']) . "</div>";
            echo "<div class='item-info'>
                    <div>Quantity: " . htmlspecialchars($row['quantity']) . "</div>
                    <div>Price: $" . htmlspecialchars($row['price']) . "</div>
                  </div>";
            echo "</div>";  // End of one item
        }
        echo "</div>";  // Close the last order block
    } else {
        echo "<p>No orders found.</p>";
    }
    ?>
</div>
</body>
</html>
<?php
// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
