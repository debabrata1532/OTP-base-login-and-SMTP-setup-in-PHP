<?php
    $server= "localhost";
    $user= "root";
    $password = "";
    $database = "test";

    $con= mysqli_connect($server,$user,$password,$database);



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $name = $_POST['name'];
       
        // echo $otp;
        // echo "hello";
        
        $sql = "select * from user where email = '$email'";
        $res = mysqli_query($con, $sql);
        $numrows = mysqli_num_rows($res);
        if($numrows == 0){
            if($pass == $cpass){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $otp = rand(111111,999999);
               
                $insertQuery = "insert into user (name,email,password,otp) values ('$name', '$email', '$hash', '$otp')";
                $result = mysqli_query($con , $insertQuery);
                if($result){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Thank you</strong> Your registration is done, <a href="login.php"> click here to login</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
                
                
            }
            else{
                echo   "<script> alert('Password and confirm Password is not matched' ) </script>";
            }

        }
        else{
            echo "<script> alert('The email id is already register, Login with your id') </script>";
        }
    
    
    }


?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Register</title>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>
                   
                   
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container my-3">
        <pre><b>Register Your self with Us </b></pre>
        <form action="index.php" method="POST" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name"
                    aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" id="confirm-password" name="cpassword" class="form-control" onkeyup ="matching()" >
                <pre id="msg"></pre>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

    <script>
        // check password and confirm password is matching or not using "Keyup event"

       
        function matching(){
            var password = document.getElementById("password").value;
            var cpassword = document.getElementById("confirm-password").value;
            var msg = document.getElementById("msg");

            if(password !== cpassword){
              msg.innerHTML = "Password do not match";
              msg.style.color="red";
            }
            else{
                msg.innerHTML = "Password matched";
                msg.style.color="green";
            }

        }

        
    </script>

</body>

</html>