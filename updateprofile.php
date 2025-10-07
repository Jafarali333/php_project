<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/fa8784f0ca.js" crossorigin="anonymous"></script>
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <?php
    include('dbconfig.php');

    // Connect to the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
    <?php
    if (isset($_GET['username'])) {
        $username =($_GET['username']); // Sanitize and convert to integer
        //echo $username;
        // Fetch product details using $product_id
        $sql = "SELECT * from users where username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {


            $username1 = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
            $number = htmlspecialchars($row['number'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8');
            $adress = htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8');
        }
    }
    ?>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa8784f0ca.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-control {
            background-color: #333;
            border: none;
            border-radius: 30px;
            padding-left: 40px;
            color: #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #b0b0b0;
            opacity: 1;
        }

        .form-control:focus {
            box-shadow: none;
            background-color: #444;
            color: #ffffff;
        }

        .input-group-text {
            background: none;
            border: none;
            padding-left: 10px;
            color: #b0b0b0;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #b0b0b0;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 30px;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
        }

        #button {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-align: center;
            margin-top: 10px;
            display: block;
        }

        a:hover {
            color: #0069d9;
        }

        textarea {
            resize: none;
            background-color: #333;
            border: none;
            border-radius: 15px;
            padding: 15px;
            color: #e0e0e0;
            width: 100%;
            height: 100px;
        }

        textarea::placeholder {
            color: #b0b0b0;
        }

        textarea:focus {
            background-color: #444;
        }
    </style>
</head>

<body>
    <div id="container">
        <?php
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            // Assuming user details are fetched here and stored in $username1, $number, $email, $adress

            echo "<form action='updateprofile2.php?username=$username' method='post' class='d-flex flex-column w-100 p-3 grid gap-2'>";
            echo "<h1>Update Profile</h1>";

            // Username field
            echo "<div class='input-container'>";
            echo "<i class='fa-solid fa-user'></i>";
            echo "<input type='text' value='$username1' name='username' id='username' class='form-control' placeholder='User name'>";
            echo "</div>";

            // Mobile number field
            echo "<div class='input-container'>";
            echo "<i class='fa-solid fa-phone'></i>";
            echo "<input type='number' value='$number' name='number' id='number' class='form-control' placeholder='Mobile No'>";
            echo "</div>";

            // Email field
            echo "<div class='input-container'>";
            echo "<i class='fa-solid fa-envelope'></i>";
            echo "<input type='email' value='$email' name='email' id='email' class='form-control' placeholder='Email'>";
            echo "</div>";

            // Address field (textarea for more space)
            echo "<div class='input-container'>";
            echo "<i class='fa-solid fa-location-dot'></i>";
            echo "<textarea name='adress' id='adress' class='form-control' placeholder='Address'>$adress</textarea>";
            echo "</div>";

            // Change Password Link
            echo "<a href='changepassword.php?username=$username'>Change Password</a>";

            // Submit button
            echo "<div class='d-flex justify-content-center'>";
            echo "<button class='w-75 rounded-pill btn btn-primary btn-sm' id='button'>Update</button>";
            echo "</div>";

            echo "</form>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
