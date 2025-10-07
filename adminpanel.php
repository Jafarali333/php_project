<?php  
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products
$sql = "SELECT * FROM products WHERE deleted = 0";
$result = mysqli_query($conn, $sql);
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
            background-color: #343a40; /* Dark gray/black background */
            color: white;
            display: flex;
            flex-direction: column;
        }

        .nav h2, .nav h3 {
            color: #f8f9fa; /* Light gray/white for text */
        }

        .nav button {
            width: 100%;
            margin-bottom: 10px;
            padding: 12px;
            background-color: #007BFF; /* Blue button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .nav button:hover {
            background-color: #0056b3; /* Darker blue on hover */
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
            background-color: #343a40; /* Dark header */
            color: white;
        }

        img {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-link button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .product-link button:hover {
            background-color: #0056b3;
        }

        /* Add Product Button */
        .add-product-btn {
            display: inline-block;
            width: 200px;
            padding: 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .add-product-btn:hover {
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
            <h2>Product List</h2>
            <?php
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Photo</th>";
            echo "<th>Name</th>";
            echo "<th>Price</th>";
            echo "<th>Category</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $productId = urlencode($row['Pid']);
                $photo = htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8');
                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
                $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8');

                echo "<tr>";
                echo "<td><a href='aviewproduct.php?id=$productId'><img src='uploads/$photo' alt='$name'></a></td>";
                echo "<td><a href='aviewproduct.php?id=$productId'>$name</a></td>";
                echo "<td>₹$price</td>";
                echo "<td>$category</td>";
                echo "<td>";
                echo "<a href='delete.php?id=$productId' class='product-link'><button>Delete</button></a> ";
                echo "<a href='edit.php?id=$productId' class='product-link'><button>Edit</button></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            ?>
        </div>

        <!-- Add Product Button -->
        <a href="addproduct.html" class="add-product-btn">Add Product</a>
    </div>

</body>
</html>
