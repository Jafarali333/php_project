<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/fa8784f0ca.js" crossorigin="anonymous"></script>
</head>

<body class=" ">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <div id="container" class="d-flex justify-content-center d-md-inline-flex position-absolute top-50 start-50 translate-middle bg-secondary
    ">


        <form action="adminpanellogin.php" method="post" class="d-flex flex-column w-80 p-3 grid gap-2 ">
            <h1 class="">Sign in</h1>

            <div class="d-flex flex-row bg-secondary-subtle rounded-pill ">
                <i class="fa-solid fa-user p-2 g-col-6"></i>
                <input type="text" name="username" id="username" class="bg-transparent border border-0"
                    placeholder="User name">
            </div>

            <div class="d-flex flex-row bg-secondary-subtle rounded-pill">
                <i class="fa-solid fa-lock p-2 g-col-6"></i>
                <input type="password" name="password" id="password" class="bg-transparent border border-0"
                    placeholder="Password">
            </div>

            <div class="d-flex justify-content-center p-2 g-col-6">
                <input type="submit" name="submit" class="w-75 rounded-pill btn btn-primary btn-sm" id="button">
            </div>

        </form>
    </div>
</body>

</html> 
<?php
    include('dbconfig.php');
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if(!$conn)
    {
        die("connection error".mysqli_connect_error());
    }
    if($_SERVER['REQUEST_METHOD']== "POST")
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql=" Select * from admin where a_username='$username' ";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $row=mysqli_fetch_assoc($result);
            
            if(mysqli_num_rows($result)==1) 
            {  
                $pwd=$row['a_password'];
                $unm=$row['a_username']; 
                if($username==$unm && password_verify($password,$pwd))
                {
                        session_start();
                        $_SESSION['a_username']=$username;
                        header("Location: adminpanel.php");

                }else
                {
                        echo "Invalid password!!!!!";
                }
            }
            else{
                echo "Invalid username!!!Username not found !!!!";
            }
    }
?>