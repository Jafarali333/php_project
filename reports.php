<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle sorting by time
if (isset($_GET['sort'])) {
    $time = $_GET['sort'];

    // Handle the custom date range
    if ($time === 'custom' && isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $time = "WHERE o.order_date BETWEEN '$start_date' AND '$end_date'";
    } else {
        // Other predefined options
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
} else {
    $time = ""; // Default case when no sorting is selected
}

// Handle sorting by category
if (isset($_GET['catagory'])) {
    $catagory = $_GET['catagory'];
    switch ($catagory) {
        case 'Ac':
            $cat = " category='Ac'";
            break;
        case 'Washing machine':
            $cat = " category='Washing machine'";
            break;
        case 'Tv':
            $cat = " category='Tv'";
            break;
        case 'Mobile':
            $cat = " category='Mobile'";
            break;
        case 'Tablet':
            $cat = " category='Tablet'";
            break;
        default:
            $cat = "";
    }
} else {
    $cat = ""; // Default case when no sorting is selected
}

// Combine filters
if ($time !== "" && $cat !== "") {
    $filter = "$time AND $cat";
} else if ($cat !== "") {
    $filter = "WHERE $cat";
} else {
    $filter = "$time $cat";
}

// Fetch all products
$sql = "SELECT p.category, SUM(oi.quantity) AS total_quantity_sold ,p.name,oi.price
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON p.name = oi.product_name
        $filter
        GROUP BY p.name
        ORDER BY total_quantity_sold DESC";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));  // Output the error for debugging
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .nav {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
        }

        .nav h3 {
            margin-bottom: 20px;
        }

        .nav button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nav button:hover {
            background-color: #0056b3;
        }

        .container {
            padding: 40px;
            flex: 1;
            background-color: white;
            border-radius: 10px;
            margin: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #e0e0e0;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .add-product-btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .add-product-btn:hover {
            background-color: #218838;
        }

        form {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
        }

        #custom-date-range {
            display: none;
            gap: 10px;
            margin-top: 10px;
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
        <a href="adminpanel.php"><button>Products</button></a>
        <a href="userlist.php"><button>Users</button></a>
        <a href="orderlist.php"><button>Orders</button></a>
        <a href="reports.php"><button>Reports</button></a>
        <a href="alogout.php"><button>Logout</button></a>
    </div>

    <div class="container">
        <h1>Product List</h1>

        <form>
            <select id="time" name="sort" onchange="timesort()">
                <option value="oneday" <?= isset($_GET['sort']) && $_GET['sort'] === 'oneday' ? 'selected' : '' ?>>One Day
                </option>
                <option value="week" <?= isset($_GET['sort']) && $_GET['sort'] === 'week' ? 'selected' : '' ?>>Last Week
                </option>
                <option value="month" <?= isset($_GET['sort']) && $_GET['sort'] === 'month' ? 'selected' : '' ?>>Last Month
                </option>
                <option value="alltime" <?= isset($_GET['sort']) && $_GET['sort'] === 'alltime' ? 'selected' : '' ?>>All
                    Time</option>
                <option value="custom" <?= isset($_GET['sort']) && $_GET['sort'] === 'custom' ? 'selected' : '' ?>>Custom
                    Date Range</option>
            </select>

            <!-- Category Sorting Dropdown -->
            <select id="catagory" name="catagory" onchange="catagorysort()">
                <option value="Ac" <?= isset($_GET['catagory']) && $_GET['catagory'] === 'Ac' ? 'selected' : '' ?>>Ac
                </option>
                <option value="Washing machine" <?= isset($_GET['catagory']) && $_GET['catagory'] === 'Washing machine' ? 'selected' : '' ?>>Washing Machine</option>
                <option value="Mobile" <?= isset($_GET['catagory']) && $_GET['catagory'] === 'Mobile' ? 'selected' : '' ?>>
                    Mobile</option>
                <option value="Tablet" <?= isset($_GET['catagory']) && $_GET['catagory'] === 'Tablet' ? 'selected' : '' ?>>
                    Tablet</option>
                <option value="Tv" <?= isset($_GET['catagory']) && $_GET['catagory'] === 'Tv' ? 'selected' : '' ?>>TV
                </option>
            </select>
            <div id="custom-date-range">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date"
                    value="<?= htmlspecialchars($_GET['start_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date"
                    value="<?= htmlspecialchars($_GET['end_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <button type="button" onclick="applyCustomDate()">Apply</button>
            </div>
        </form>

        <div class="table-container">
            <?php
            echo "<table>";
            echo "<thead><tr>";
            echo "<th>Product Name</th><th>Category</th><th>Total Quantity Sold</th><th>Price</th><th>Total Amount</th>";
            echo "</tr></thead><tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
                $quantity = htmlspecialchars($row['total_quantity_sold'], ENT_QUOTES, 'UTF-8');
                $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8');
                $total = $quantity * $price;

                echo "<tr>";
                echo "<td><a href='#'>$name</a></td>";
                echo "<td>$category</td>";
                echo "<td>$quantity</td>";
                echo "<td>₹$price</td>";
                echo "<td>₹$total</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
            ?>
        </div>
    </div>

    <script>
        function timesort() {
            const sort = document.getElementById('time').value;
            const customDateRange = document.getElementById('custom-date-range');
            if (sort === 'custom') {
                customDateRange.style.display = 'flex';
            } else {
                customDateRange.style.display = 'none';
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('sort', sort);
                urlParams.delete('start_date');
                urlParams.delete('end_date');
                window.location.search = urlParams.toString();
            }
        }

        function applyCustomDate() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            if (endDate < startDate) {
                alert("Starting date is bigger than end date!!");
            }
            else {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('sort', 'custom');
                urlParams.set('start_date', startDate);
                urlParams.set('end_date', endDate);
                window.location.search = urlParams.toString();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sort = document.getElementById('time').value;
            const customDateRange = document.getElementById('custom-date-range');
            if (sort === 'custom') {
                customDateRange.style.display = 'flex';
            }
        });

        function catagorysort() {
            const catagory = document.getElementById('catagory').value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('catagory', catagory);
            window.location.search = urlParams.toString();
        }
    </script>
</body>

</html>