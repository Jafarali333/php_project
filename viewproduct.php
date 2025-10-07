
<?php
session_start(); // Start the session at the very top
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profileButton');
            const profileContainer = document.getElementById('profileContainer');
            const closeButton = document.getElementById('closeButton');

            profileButton.addEventListener('click', function () {
                profileContainer.classList.toggle('hidden');
            });

            closeButton.addEventListener('click', function () {
                profileContainer.classList.add('hidden');
            });
        });
    </script>

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

        #profileContainer {
            position: fixed;
            height: 200vh;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .hidden {
            display: none;
        }

        .profilediv {
            border-top: 3px solid white;
        }

        h3 {
            color: white;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <nav class="navbar bg-dark navbar-expand-lg" style="z-index: 2000;">
        <div class="container-fluid">
            <a class="navbar-brand" style="color:white;" >ELECTRONIA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3" id="clr">
                    <li class="nav-item">
                        <a style="color:white;" class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color:white;" class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="color:white;" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a style="color:black;" class="dropdown-item" href="product.php?category=Ac">Air Conditioner</a></li>
                            <li><a style="color:black;" class="dropdown-item" href="product.php?category=Washing machine">Washing Machines</a></li>
                            <li><a style="color:black;" class="dropdown-item" href="product.php?category=Mobile">Mobile Phones</a></li>
                            <li><a style="color:black;" class="dropdown-item" href="product.php?category=Tablet">Tablets</a></li>
                            <li><a style="color:black;" class="dropdown-item" href="product.php?category=Tv">Television</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:white;" href="#footer">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a id="profileButton" style="color:white;" class="nav-link"><i class="fa-solid fa-user"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:white;" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:white;" href="liked.php"><i class="fa-solid fa-heart"></i></a>
                    </li>
                    <li class="nav-item" style="color:white;">
                        <?php 
                        if (isset($_SESSION['username'])) {
                            echo "Welcome! " . htmlspecialchars($_SESSION['username']);
                        } else {
                            echo 'Welcome! Guest';
                        }
                        ?>
                    </li>
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>l,ki,
    </nav>

    <div id="profileContainer" class="hidden w-25 p-3 " style="min-width: 300px;">
        <h3 style="color: aliceblue;">Profile Information</h1>
        <div class="profilediv" style="color:aliceblue; font-size:1.3em;">
        <?php 
                if (isset($_SESSION['username'])) {
                    echo "Welcome! ". htmlspecialchars($_SESSION['username']);
                } else {
                    echo 'Welcome! Guest';
                }
                ?>
        </div>
        <div >
                <img src="image/profile.png" alt="" class="profilediv rounded-circle w-50 p-3 ratio ratio-1x1" >
        </div>
         <div class="profilediv" style="color:white;" >
        <?php 
                if (isset($_SESSION['username'])) {
                    $username = htmlspecialchars($_SESSION['username']);
                   // $uid = htmlspecialchars($_SESSION['id']);
                   // echo $uid;
                    echo "<a style='color:white;' href='updateprofile.php?username=$username'>Wiew or update profile</a>";
                } else {
                    echo 'You are not logged in for update profile';
                }
                ?>    
        </div>
        
        <div class="profilediv">
                <a href="orders.php" style='color:white;' >Your Orders</a>
        </div>
        
        <div class="profilediv ">
            <?php
             if (isset($_SESSION['username']))
             {
                    echo "<a href='logout.php' ><button class='btn btn-primary'>logout</button></a>";
             }
             else{
                echo "<a href='signin.html'><button class='btn btn-primary' >Sign in</button></a>";
                echo"---";
                echo " <a href='signup.html'><button class='btn btn-primary' >Sign up</button></a>";
             }
             ?>
             
        </div>
        <div class="profilediv">
        <button id="closeButton" class="btn btn-primary " >Close</button>
        </div>
    </div>

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
                if (isset($_SESSION['username'])) {
                    echo "<a href='addtocart.php?pid=$product_id' class='btn btn-primary'>Add to cart</a>";
                } else {
                    echo"<p style='color:red; ' >You are not logged in to buy product !!!</p>";
                    echo "<a href='signin.html' class='btn btn-primary'>Login</a>";
                    // Optionally, show a login prompt
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
