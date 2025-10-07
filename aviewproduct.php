<?php
include('dbconfig.php'); // Include your database configuration

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electronia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- FontAwesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        body {
            background-color: black;
            color: white; /* Default text color */
        }

        .navbar {
            color: white; /* Navbar text color */
        }

        .product-container {
            max-width: 600px; /* Limit the width */
            margin: 20px auto; /* Center the container */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
            border-radius: 10px; /* Rounded corners */
            text-align: center; /* Center-align text */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Subtle shadow */
        }

        .product-image {
            width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
            border-radius: 10px; /* Rounded corners for the image */
            margin-bottom: 15px; /* Spacing below the image */
        }

        .product-title {
            font-size: 2em; /* Larger title font size */
            margin: 10px 0; /* Margins for spacing */
        }

        .price {
            font-size: 1.5em; /* Price font size */
            color: #FFD700; /* Gold color for the price */
        }

        .category {
            font-size: 1.2em; /* Category font size */
            margin: 5px 0; /* Spacing above and below */
        }

        .description {
            font-size: 1em; /* Description font size */
            margin: 10px 0; /* Spacing for better readability */
        }

        h3 {
            color: white;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $product_id = intval($_GET['id']); // Sanitize and convert to integer
            // Fetch product details using $product_id
            $sql = "SELECT * from products where Pid=$product_id";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                $qty= htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8');
                echo "<div class='product-container'>";
                echo "<img src='uploads/" . htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "' class='product-image'>";
                echo "<h2 class='product-title'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</h2>";
                echo "<p class='price'>₹" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='category'>" . htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='description'>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</p>";
                
                if($qty<=0)
                {
                    echo"<p style='color:red; ' >Out of stock !!!</p>";       
                }
                
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
