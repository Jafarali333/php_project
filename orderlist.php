<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a status update is requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $orderId = intval($_POST['order_id']);
    $newStatus = mysqli_real_escape_string($conn, $_POST['new_status']);

    $updateSql = "UPDATE orders SET order_status = '$newStatus' WHERE id = $orderId";

    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Order status updated successfully!'); window.location.href = 'orderlist.php';</script>";
    } else {
        echo "<script>alert('Error updating order status: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch all orders with corresponding order items
$sql = "
    SELECT o.id AS order_id, o.username, o.order_status, o.total_amount, o.order_date, o.payment_method, o.delivery_address,
           oi.product_name, oi.quantity, oi.price
    FROM orders o
    LEFT JOIN order_items oi ON o.id = oi.order_id
    ORDER BY order_id DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Navigation Sidebar */
        .nav {
            width: 250px;
            padding: 20px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .nav h2, .nav h3 {
            color: #f8f9fa;
        }

        .nav button {
            width: 100%;
            margin-bottom: 10px;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .nav button:hover {
            background-color: #0056b3;
        }

        .nav h3 {
            margin-bottom: 40px;
        }

        /* Main Content Area */
        .container {
            flex: 1;
            padding: 30px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
        }

        h2 {
            margin-bottom: 20px;
        }

        .table-container {
            height: 65vh;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Order Status Buttons */
        .status-buttons form {
            display: inline-block;
            margin-right: 10px;
        }

        .btn-order-placed {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-shipped {
            padding: 8px 16px;
            background-color: #ffc107;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-delivered {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-order-placed:hover {
            background-color: #0056b3;
        }

        .btn-shipped:hover {
            background-color: #e0a800;
        }

        .btn-delivered:hover {
            background-color: #218838;
        }

        /* For responsiveness */
        @media (max-width: 768px) {
            .nav {
                width: 100%;
                padding: 15px;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="nav">
    <?php
    $username = $_SESSION['a_username'];
    if ($username) {
        echo "<h3>Welcome $username!</h3>";
    } else {
        header("Location: adminpanellogin.php");
    }
    ?>
    <h2>Navigation</h2>
    <a href="adminpanel.php"><button>Products</button></a>
    <a href="userlist.php"><button>Users</button></a>
    <a href="orderlist.php"><button>Orders</button></a>
    <a href="reports.php"><button>Reports</button></a>
    <a href="alogout.php"><button>Logout</button></a>
</div>

<div class="container">
    <div class="table-container">
        <h2>Order List</h2>
        <?php
        $currentOrderId = null;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($currentOrderId !== $row['order_id']) {
                if ($currentOrderId !== null) {
                    echo "</tbody></table>";
                }

                $currentOrderId = $row['order_id'];
                echo "<h3>Order ID: $currentOrderId</h3>";
                echo "<p><strong>Username:</strong> " . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Total Amount:</strong> ₹" . htmlspecialchars($row['total_amount'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Order Date:</strong> " . htmlspecialchars($row['order_date'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Payment Method:</strong> " . htmlspecialchars($row['payment_method'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Delivery Address:</strong> " . htmlspecialchars($row['delivery_address'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Order Status:</strong> " . htmlspecialchars($row['order_status'], ENT_QUOTES, 'UTF-8') . "</p>";

                echo "<div class='status-buttons'>";
                echo "<form method='POST'>
                        <input type='hidden' name='order_id' value='$currentOrderId'>
                        <input type='hidden' name='new_status' value='Order Placed'>
                        <button type='submit' class='btn-order-placed'>Order Placed</button>
                      </form>";

                echo "<form method='POST'>
                        <input type='hidden' name='order_id' value='$currentOrderId'>
                        <input type='hidden' name='new_status' value='Shipped'>
                        <button type='submit' class='btn-shipped'>Shipped</button>
                      </form>";

                echo "<form method='POST'>
                        <input type='hidden' name='order_id' value='$currentOrderId'>
                        <input type='hidden' name='new_status' value='Delivered'>
                        <button type='submit' class='btn-delivered'>Delivered</button>
                      </form>";
                echo "</div>";

                echo "<table><thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead><tbody>";
            }

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>₹" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }

        if ($currentOrderId !== null) {
            echo "</tbody></table>";
        }
        ?>
    </div>
</div>
</body>
</html>
