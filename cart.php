<?php
session_start(); // Start the session at the very top
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electronia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        function updateQuantity(uid, pid, change, oquantity) {
            const quantityElement = document.getElementById('quantity-' + pid);
            let quantity = parseInt(quantityElement.textContent);

            // Check if the change will exceed available quantity
            if (change > 0 && quantity >= oquantity) {
                alert("No more quantity available!!!");
                return;
            }

            // Update the quantity
            quantity += change;

            if (quantity < 1) {
                alert("Quantity cannot be less than 1");
                return;
            }

            quantityElement.textContent = quantity;

            const pricePerUnit = parseFloat(document.getElementById('price-' + pid).textContent.split('= ₹')[0].split('x ')[0].replace('₹', ''));
            const newTotalPrice = pricePerUnit * quantity;
            document.getElementById('price-' + pid).textContent = `₹${pricePerUnit} x ${quantity} = ₹${newTotalPrice}`;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "updatecart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Optionally handle the response here
                }
            };
            xhr.send(`uid=${uid}&pid=${pid}&quantity=${quantity}`);

        }
    </script>

    <style>
        body {
            background-color: black;
        }

        .profilediv {
            border-top: 3px solid white;
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

        .product-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: transform 0.2s;
            text-align: center;
            position: relative;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-name {
            font-size: 16px;
            margin: 10px 0;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .category {
            font-size: 14px;
            color: #888;
        }

        .quantity {
            font-size: 14px;
            color: #555;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .buy-now-button {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: red;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark text-light navbar-expand-lg" data-bs-theme="dark" style="z-index: 2000;">
        <div class="container-fluid">
            <a class="navbar-brand">ELECTRONIA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3" id="clr">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Products</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="product.php?category=Ac">Air Conditioner</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Washing machine">Washing
                                    Machines</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Mobile">Mobile Phones</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Tablet">Tablets</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Tv">Television</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a id="profileButton" class="nav-link"><i class="fa-solid fa-user"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liked.php"><i class="fa-solid fa-heart"></i></a>
                    </li>
                    <li style="color:white;" class="nav-link">
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
        </div>
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


    <div class="container mt-4">
        <div class="row">
            <?php
            include('dbconfig.php');

            // Connect to the database
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_SESSION['username'])) {
                $username = htmlspecialchars($_SESSION['username']);
                // Fetch user ID
                $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $uid = htmlspecialchars($row['id']);
                } else {
                    echo "<p>User not found.</p>";
                    exit;
                }
            } else {
                echo "<p style='color:red;' >Please log in to view your cart!!</p>";
                echo "<a href='signin.html' style='width:140px;' class='btn btn-primary'>Login</a>";
                exit;
            }

            // Fetch all products in the cart along with their quantity from the cart table
            $stmt = $conn->prepare("SELECT cart.cquantity, products.* FROM cart INNER JOIN products ON cart.pid = products.Pid WHERE products.deleted = 0 AND cart.id = ?");
            $stmt->bind_param("i", $uid);
            $stmt->execute();
            $result = $stmt->get_result();

            $totalAmount = 0;

            if (mysqli_num_rows($result) === 0) {
                echo "<p style='color:white;' >No products found in your cart.</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $productId = urlencode($row['Pid']);
                    $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
                    $quantity = intval($row['cquantity']);
                    $oquantity = intval($row['quantity']);
                    $totalPrice = $price * $quantity;
                    $totalAmount += $totalPrice;

                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <span class="close-btn" onclick="deleteFromCart(<?= $uid ?>, '<?= $productId ?>')"><i
                                    class="fas fa-times"></i></span>
                            <a href='viewproduct.php?id=<?= $productId ?>' class='product-link'>
                                <img src='uploads/<?= htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8') ?>'
                                    alt='<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?>' class='img-fluid'>
                                <h5 class='product-name'><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></h5>
                                <p class='price' id="price-<?= $productId ?>">₹<?= $price ?> x <?= $quantity ?> =
                                    ₹<?= $totalPrice ?></p>
                            </a>
                            <?php
                            if($oquantity==0)
                            {
                                echo"<p style='color:red;' > Out of stock!!!</p>";
                            }
                            else if($oquantity<$quantity)
                            {
                                echo "<p style='color:red;'> Only ".$oquantity." products available</p> ";
                            }
                            ?>
                            <p class='quantity'>Quantity:
                                <button
                                    onclick="updateQuantity(<?= $uid ?>, '<?= $productId ?>', -1, <?= $oquantity ?>)">-</button>
                                <span id="quantity-<?= $productId ?>"><?= $quantity ?></span>
                                <button
                                    onclick="updateQuantity(<?= $uid ?>, '<?= $productId ?>', 1, <?= $oquantity ?>)">+</button>
                            </p>
                            <p class='category'><?= htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') ?></p>

                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="bottom-bar">
        <span>Total Amount: ₹<?= $totalAmount ?></span>
        <a href="buynow.php"> <button class="buy-now-button">Buy Now</button></a>
    </div>

    <script>
        function deleteFromCart(uid, pid) {
            if (confirm("Are you sure you want to remove this item from your cart?")) {
                window.location.href = "deletefromcart.php?uid=" + uid + "&pid=" + pid;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>