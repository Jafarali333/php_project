<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$time = "";
$cat = "";

// Determine time filter
if (isset($_GET['sort'])) {
    $time = $_GET['sort'];
    switch ($time) {
        case 'oneday':
            $time = "WHERE o.order_date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
            break;
        case 'week':
            $time = "WHERE o.order_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
            break;
        case 'month':
            $time = "WHERE o.order_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
            break;
        case 'alltime':
            $time = "";
            break;
        default:
            $time = "";
    }
}

// Determine category filter
if (isset($_GET['catagory'])) {
    $catagory = $_GET['catagory'];
    switch ($catagory) {
        case 'Ac':
            $cat = "category='Ac'";
            break;
        case 'Washing machine':
            $cat = "category='Washing machine'";
            break;
        case 'Tv':
            $cat = "category='Tv'";
            break;
        case 'Mobile':
            $cat = "category='Mobile'";
            break;
        case 'Tablet':
            $cat = "category='Tablet'";
            break;
        default:
            $cat = "";
    }
}

// Combine filters
$filter = ($time && $cat) ? "$time AND $cat" : ($cat ? "WHERE $cat" : $time);

// Fetch data
$sql = "SELECT p.category, SUM(oi.quantity) AS total_quantity_sold, p.name, oi.price
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON p.name = oi.product_name
        $filter
        GROUP BY p.name";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Create Excel file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="sales_report.xls"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Product Name', 'Category', 'Total Quantity Sold', 'Price', 'Total Amount']); // Header row

while ($row = mysqli_fetch_assoc($result)) {
    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
    $quantity = htmlspecialchars($row['total_quantity_sold'], ENT_QUOTES, 'UTF-8');
    $total = $quantity * $price;
    
    fputcsv($output, [$name, $row['category'], $quantity, "₹$price", "₹$total"]); // Data row
}

fclose($output);
exit();
