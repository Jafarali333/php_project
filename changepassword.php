<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
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
    </style>
</head>

<body>
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
        $username = ($_GET['username']); // Sanitize and convert to integer
        // Fetch user details
        $sql = "SELECT * from users where username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $username1 = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
            $number = htmlspecialchars($row['number'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8');
        }
    }
    ?>
    
    <div id="container" class="d-flex justify-content-center">
        <?php
        echo "<form action='updatepassword.php?username=$username' method='post' class='d-flex flex-column w-80 p-3 grid gap-2 '>";
        echo "<h1 class=''>Change Password</h1>";

        echo "<div class='input-container'>";
        echo "    <i class='fa-solid fa-lock p-2 g-col-6'></i>";
        echo "    <input type='password' name='opassword' id='opassword' class='form-control' placeholder='Current Password' required>";
        echo "</div>";

        echo "<div class='input-container'>";
        echo "    <i class='fa-solid fa-lock p-2 g-col-6'></i>";
        echo "    <input type='password' name='password' id='password' class='form-control' placeholder='New Password' required>";
        echo "</div>";

        echo "<div class='input-container'>";
        echo "    <i class='fa-solid fa-lock p-2 g-col-6'></i>";
        echo "    <input type='password' name='cpassword' id='cpassword' class='form-control' placeholder='Confirm Password' required>";
        echo "</div>";

        echo "<div class='d-flex justify-content-center p-2 g-col-6'>";
        echo "    <button class='w-75 rounded-pill btn btn-primary btn-sm' id='button'>Update</button>";
        echo "</div>";

        echo "</form>";
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
