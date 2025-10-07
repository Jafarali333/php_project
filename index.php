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


    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css"
        integrity="sha512-DJLNx+VLY4aEiEQFjiawXaiceujj5GA7lIY8CHCIGQCBPfsEG0nGz1edb4Jvw1LR7q031zS5PpPqFuPA8ihlRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css"
        integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css"
        integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css"
        integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileButton = document.getElementById('profileButton');
        const profileContainer = document.getElementById('profileContainer');
        const closeButton = document.getElementById('closeButton');

        profileButton.addEventListener('click', function () {
            if (profileContainer.classList.contains('hidden')) {
                profileContainer.classList.remove('hidden');
            } else {
                profileContainer.classList.add('hidden');
            }
        });

        closeButton.addEventListener('click', function () {
            profileContainer.classList.add('hidden');
        });
    });
</script>

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <nav class="navbar bg-dark text-ligh  navbar-expand-lg" data-bs-theme="dark" style="z-index: 2000;">
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
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="product.php?category=Ac">Air Conditioner</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Washing machine">Washing Machines</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Mobile">Mobile Phones</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Tablet">Tablets</a></li>
                            <li><a class="dropdown-item" href="product.php?category=Tv">Television</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</i></a>
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
                    <li style="color:white;" class="nav-link" >
                    <?php 
                if (isset($_SESSION['username'])) {
                    echo "Welcome! ". htmlspecialchars($_SESSION['username']);
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


    <div id="carouselExampleRide" class="carousel slide carousel-fade" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="product.php?category=Mobile"><img src="image/img1.png" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="product.php?category=Ac"><img src="image/img2 .png" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="product.php?category=Tablet"><img src="image/img3 .png" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="product.php?category=Mobile"><img src="image/img4 .png" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="product.php?category=Washing machine"><img src="image/img5 .png" class="d-block w-100" alt="..."></a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="row">
        <div class="rw d-flex justify-content-around">
            <a href="product.php?category=Tablet"><img src="image/p1.png" class="img-thumbnail" id="rw" alt="..."></a>
            <a href="product.php?category=Ac"><img src="image/p2.png" class="img-thumbnail" id="rw" alt="..."></a>
            <a href="product.php?category=Tv"><img src="image/p3.png" class="img-thumbnail" id="rw" alt="..."></a>
            <a href="product.php?category=Mobile"><img src="image/p4.png" class="img-thumbnail" id="rw" alt="..."></a>
            <a href="product.php?category=Washing machine"><img src="image/p5.png" class="img-thumbnail" id="rw" alt="..."></a>
        </div>
    </div>


    <div class="row d-flex justify-content-around">
        <div class="card mb-3" style="max-width: 46%;">
            <div class="row g-2">
                <div class="col-md-4">
                    <img src="image/hdfc.png" class="img-fluid rounded-start" alt="..." style="height: 170px;">
                </div>
                <div class="col">
                    <div class="card-body">

                        <p class="card-text"><b>Enjoy up to 5% extra savings at Electronia<br> with Tata Neu HDFC Bank
                                Credit Card.</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3" style="max-width: 46%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="image/hdfc1.png" class="img-fluid rounded-start" alt="..." style="height: 170px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><b>check Out Bank offers on your Favourite Brands.<br>
                                Max 10% Up to &#8377 5,000 Instant Discount on Credit Cards</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div claas="title py-2">
            <h3>Deals of the Day</h3>
        </div>
        <div class="row d-flex justify-content-around" style="margin-top: 20px;">
            <div class="card" style="width: 18rem;">
                <img src="image/acc1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><s>&#8377 45,000</s> &#8377 39,999</p>
                    <p class="card-text"><b>VOLTAS</b></p>
                    <p class="card-text"><b>Air Conditioner</b></p>
                    <p class="card-text">*Instant Discount Up to &#8377 5,000 on HDFC and ICIC Cards</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="image/phn1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><s>&#8377 22,999</s> &#8377 15,999</p>
                    <p class="card-text"><b>VIVO</b></p>
                    <p class="card-text"><b>T3 5G</b></p>
                    <p class="card-text">*Inclusive of all Offers</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="image/tv.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><s>&#8377 59,999</s> &#8377 37,916</p>
                    <p class="card-text"><b>SONY</b></p>
                    <p class="card-text"><b>43" 4K UHD LED<br>Google TV</b></p>
                    <p class="card-text">*Inclusive of Bank Offers</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="image/wm.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><s>&#8377 21,200</s> &#8377 15,790</p>
                    <p class="card-text"><b>WHIRPOOL</b></p>
                    <p class="card-text"><b>Whirpool 7.5Kg Fully Automatic Washing Machine<br>Google TV</b></p>
                    <p class="card-text">*With 12 Wash Programs<br>Plus Exchange Discount</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-5">
        <div claas="title py-2">
            <h3>Electronia Collections</h3>
        </div>
        <div class="row d-flex justify-content-around" style="margin-top: 20px;">
            <div class="card mb-3" style="max-width: 46%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="image/t1.png" class="img-fluid rounded-start" alt="..." style="height: 206px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Electronia</h5>
                            <p class="card-text"><b>Bestselling Tablets</b></p>
                            <p class="card-text"><small class="text-body-secondary">Starting at</small></p>
                            <p class="card-text"><b>&#8377 7,390*</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3" style="max-width: 46%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="image/acc2.png" class="img-fluid rounded-start" alt="..." style="height: 206px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Electronia</h5>
                            <p class="card-text"><b>Inverter ACs</b></p>
                            <p class="card-text"><small class="text-body-secondary">Starting at</small></p>
                            <p class="card-text"><b>&#8377 26,990*</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-5">
        <div claas="title py-2">
            <h3>Brands we Are Passionate About</h3>
        </div>
        <div class="row d-flex justify-content-around">
            <img src="image/c1.png" class="img-thumbnail" id="rw1" alt="...">
            <img src="image/c2.png" class="img-thumbnail" id="rw1" alt="...">
            <img src="image/c3.png" class="img-thumbnail" id="rw1" alt="...">
            <img src="image/c4.png" class="img-thumbnail" id="rw1" alt="...">
            <img src="image/c5.png" class="img-thumbnail" id="rw1" alt="...">
            <img src="image/c6.png" class="img-thumbnail" id="rw1" alt="...">
        </div>
    </div>


    <div class="container-fluid py-5">
        <div claas="title py-2">
            <h3>Why Electronia</h3>
            <div class="container">
                <img src="image/in1.png" style="width: 100%; margin-top: 20px;">
            </div>
        </div>
    </div>

    <!-- contact with us -->
    <!-- footer -->
    <div class="container-fluid mt-3 bg-dark text-white py-5" id="footer">

        <!-- <div> -->
        <div class="row">
            <div class="col" style="border-right: 1px solid white;">
                <ul class="d-flex">
                    <li>
                        <!-- <div class=""> -->
                        <h5>CONNECT WITH US</h5>
                        <div class="">
                            <div class="input-group input-group-md mb-3">
                                <form action="contact.php" method="post" >
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-md" placeholder="Enter Email" name="contactemail">
                                <input type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-top:5px;" >
                                </form>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-dark"><i class="fa-brands fa-youtube"></i></button>

                            <button type="button" class="btn btn-dark"><i class="fa-brands fa-facebook"></i></button>

                            <button type="button" class="btn btn-dark"><i class="fa-brands fa-instagram"></i></button>

                            <button type="button" class="btn btn-dark"><i class="fa-brands fa-linkedin-in"></i></button>

                            <button type="button" class="btn btn-dark"><i class="fa-brands fa-twitter"></i></button>

                        </div><br>

                        <div>
                            <p>&copy Copyright 2023 Electronia. All rights reserved</p>
                        </div>

            </div>



            <div class="col " style="border-right: 1px solid white;">
                <div class="row">
                    <div class="col">
                        USEFUL LINKS<br>
                        About Electronia<br>
                        Help And Support<br>
                        FAQs<br>
                        Buying Guide<br>
                        Return Policy<br>
                        B2B Orders<br>
                        Store Locator<br>
                        E-Waste<br>
                        Franchise Opportunity<br>
                    </div>
                    <div class="col">
                        Site Map<br>
                        Careers At Croma<br>
                        Terms Of Use<br>
                        Disclaimer<br>
                        Privacy Policy<br>
                        Unboxed<br>
                        Gift Card<br>
                        Croma E-Star<br>
                    </div>
                </div>
            </div>

            <div class="col px-4">
                <div class="row">
                    <div class="col">
                        PRODUCTS<br>
                        Televisions & <br>Accessories<br>
                        Home <br>Appliances<br>
                        Phones & <br>Wearables<br>
                        Computers &<br> Tablets<br>
                        itchen Appliances<br>
                        Audio & Video<br>
                        Health & Fitness
                    </div>
                    <div class="col">
                        Grooming & Personal Care<br>
                        Cameras & Accessories<br>
                        Smart Devices<br>
                        Gaming<br>
                        Accessories<br>
                        Top Brands<br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div> -->

    </div>
</body>

</html>
<style>
    body {
        background-color: black;
    }
    .profilediv{
        border-top: 3px solid white;
    }
    #rw {
        height: 150px;
        width: 150px;
        margin-top: 28px;
        margin-bottom: 28px;
        border-radius: 20px;
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

    .rw {
        display: flex;
    }

    h3 {
        color: white;
    }

    #rw1 {
        height: 130px;
        width: 150px;
        margin-top: 20px;
        border-radius: 20px;
    }
</style>