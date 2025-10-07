<?php
include('dbconfig.php');


// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$search = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$orderBy = "";

// Sorting logic
switch ($sort) {
    case 'price_asc':
        $orderBy = "ORDER BY price ASC";
        break;
    case 'price_desc':
        $orderBy = "ORDER BY price DESC";
        break;
    case 'name_asc':
        $orderBy = "ORDER BY name ASC";
        break;
    case 'name_desc':
        $orderBy = "ORDER BY name DESC";
        break;
}

// SQL query
$sql = "SELECT * FROM products WHERE deleted = 0";
if (!empty($category)) {
    $sql .= " AND category = '$category'";
}
if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
}
$sql .= " $orderBy";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            margin: 0;
        }
        .navbar .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .navbar .nav-links a:hover {
            background: #555;
        }
        .navbar .nav-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }
        .navbar .nav-controls select,
        .navbar .nav-controls input[type="text"] {
            padding: 5px;
            border: none;
            border-radius: 4px;
        }
        .navbar .nav-controls select {
            background: #fff;
            color: #333;
        }
        .navbar .nav-controls input[type="text"] {
            width: 150px;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 250px;
            text-align: center;
            padding: 15px;
            box-sizing: border-box;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .product-card h2 {
            font-size: 18px;
            margin: 0;
            padding: 0;
        }
        .product-card p {
            color: #777;
            font-size: 14px;
            margin: 10px 0;
        }
        .product-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .product-card .category {
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Product List</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#">Liked Items</a>
            <a href="cart.php">Cart</a>
        </div>
        <div class="nav-controls">
            <select id="sort" name="sort" onchange="sortProducts()">
                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Name: A to Z</option>
                <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Name: Z to A</option>
            </select>
            <input type="text" id="filter" name="filter" placeholder="Search..." 
                   value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>" 
                   oninput="searchProducts()">
        </div>
    </div>
    <div class="container">
        <div class="product-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-card" style="display: flex;">
                    <a href="like.php?id=<?= urlencode($row['Pid']) ?>"><i class="fa-solid fa-heart"></i></a>
                    <a href="viewproduct.php?id=<?= urlencode($row['Pid']) ?>" class="product-link">
                        <img src="uploads/<?= htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8') ?>" 
                             alt="<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?>">
                        <h2><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <p class="price">₹<?= htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php if ($row['quantity'] <= 0): ?>
                            <p style="color:red;">Out of stock!!!</p>
                        <?php endif; ?>
                        <p class="category"><?= htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>
        let debounceTimeout;

        function sortProducts() {
            const sort = document.getElementById('sort').value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('sort', sort);
            window.location.search = urlParams.toString();
        }

        function searchProducts() {
            clearTimeout(debounceTimeout); 
            debounceTimeout = setTimeout(() => {
                const search = document.getElementById('filter').value;
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('filter', search);
                window.location.search = urlParams.toString();
            }, 2000); 
        }
    </script>
</body>
</html>
