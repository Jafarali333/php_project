<?php
session_start();
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all users
$sql = "SELECT * FROM users WHERE deleted = 0"; // Assuming there's a deleted field
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
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
            background-color: #343a40; /* Dark gray/black background to match reports.php */
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
            background-color: #007BFF; /* Retain blue button color */
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
            background-color: #343a40; /* Dark header to match sidebar */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Add User Button */
        .add-user-btn {
            padding: 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: fit-content;
        }

        .add-user-btn:hover {
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
        <?php
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Username</th>";
        echo "<th>Number</th>";
        echo "<th>Email</th>";
        echo "<th>Address</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $userId = urlencode($row['id']);
            $username = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
            $number = htmlspecialchars($row['number'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
            $address = htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>$userId</td>";
            echo "<td>$username</td>";
            echo "<td>$number</td>";
            echo "<td>$email</td>";
            echo "<td>$address</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        ?>
    </div>

    <!-- Add User Button -->
    <!-- Uncomment if needed: -->
    <!-- <a href="adduser.html" class="add-user-btn">Add User</a> -->
</div>

</body>
</html>
