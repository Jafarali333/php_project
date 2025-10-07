<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$totalAmount = 0;
$orderItems = [];
$paymentMethod = "";
$address = "";
$newAddress = "";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<p>Please log in to place an order.</p>";
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

// Fetch the cart items for the logged-in user
$stmt = $conn->prepare("SELECT cart.cquantity, products.* FROM cart INNER JOIN products ON cart.pid = products.Pid INNER JOIN users ON cart.id = users.id WHERE users.username = ? AND products.deleted = 0 and products.quantity!=0");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) === 0) {
    echo "<p>No items in your cart to order.</p>";
    exit;
} else {
    while ($row = $result->fetch_assoc()) {
        $productname = htmlspecialchars($row['name']);
        $quantity = intval($row['cquantity']);
        $price = floatval($row['price']);
        $totalPrice = $price * $quantity;
        $totalAmount += $totalPrice;

        // Store order item details
        $orderItems[] = [
            'product_name' => $productname,
            'quantity' => $quantity,
            'price' => $price,
            'product_id' => intval($row['Pid'])
        ];
    }
}

// Fetch existing addresses for the logged-in user
$addresses = [];
$stmt = $conn->prepare("SELECT address FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $addresses[] = htmlspecialchars($row['address']);
}

// Handle the order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get payment method and address from the form
    $paymentMethod = htmlspecialchars($_POST['payment_method']);
    $address = htmlspecialchars($_POST['address']);
    $newAddress = htmlspecialchars(trim($_POST['new_address']));

    // Validate address input
    if (empty($address) && strlen($newAddress) < 15) {
        echo "<p>Please provide a new address that is at least 15 characters long.</p>";
        exit;
    }

    // Use new address if provided, otherwise use the selected address
    $finalAddress = !empty($newAddress) ? $newAddress : $address;

    // Prepare to insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders (username, total_amount, payment_method, delivery_address, order_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sdss", $username, $totalAmount, $paymentMethod, $finalAddress);
    $stmt->execute();

    // Get the last inserted order ID
    $orderId = $stmt->insert_id;

    // Insert each order item and update the product quantity
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
    $stmtUpdate = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE Pid = ?");

    foreach ($orderItems as $item) {
        // Insert order item
        $stmt->bind_param("isid", $orderId, $item['product_name'], $item['quantity'], $item['price']);
        $stmt->execute();

        // Update product quantity
        $stmtUpdate->bind_param("ii", $item['quantity'], $item['product_id']);
        $stmtUpdate->execute();
    }

    // Clear the cart after the order is placed
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = (SELECT id FROM users WHERE username = ?)");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    echo "<p>Order placed successfully! Total amount: ₹" . $totalAmount . "</p>";
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Confirm Your Order</h2>
        <div class="list-group">
            <?php foreach ($orderItems as $item): ?>
                <div class="list-group-item">
                    Product Name: <?= htmlspecialchars($item['product_name']) ?><br>
                    Quantity: <?= htmlspecialchars($item['quantity']) ?><br>
                    Price: ₹<?= htmlspecialchars($item['price']) ?> x <?= htmlspecialchars($item['quantity']) ?> = ₹<?= htmlspecialchars($item['price'] * $item['quantity']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <h4 class="mt-3">Total Amount: ₹<?= $totalAmount ?></h4>

        <form method="post">
            <div class="mb-3">
                <label for="paymentMethod" class="form-label">Select Payment Method</label>
                <select name="payment_method" id="paymentMethod" class="form-select" required>
                    <option value="">Choose...</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Select Delivery Address</label>
                <select name="address" id="address" class="form-select">
                    <option value="">Choose an address...</option>
                    <?php foreach ($addresses as $addr): ?>
                        <option value="<?= $addr ?>"><?= $addr ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="newAddress" class="form-label">Or enter a new address (minimum 15 characters)</label>
                <textarea name="new_address" id="newAddress" class="form-control" rows="3" placeholder="Enter your address here..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
