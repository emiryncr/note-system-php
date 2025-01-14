<!doctype html>
<html lang="en">

<?php

include "connection.php";

if(isset($_POST['submit'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $checkExistQuery = "SELECT * FROM users WHERE username = '$uname'";
    if (mysqli_num_rows(mysqli_query($connection, $checkExistQuery)) > 0) {
        echo "<script>
            alert('This username is already taken');
            window.location.href = 'signup.php';
        </script>";
        exit();
    }else{
        $sqlAddUser = "INSERT INTO users (username, password) VALUES ('$uname' ,'$pass')";
        if($sqlAddResult = mysqli_query($connection, $sqlAddUser)){
            echo "<script>
                alert('User added, u are redirect to the login'');
            </script>";
            header('Location: login.php');
        }else{
            echo "Error: " . $sqlAddUser . "<br>" . mysqli_error($connection);
        }
    }
}


?>


  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-white">

  <main class="container mt-5">
    <h1>Sign up to note!</h1>

    <form class=".container-sm mx-auto" style="max-width: 250px;" action="signup.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
        </div>
        <div class="mb-1">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <span>If you have an<a href="login.php" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"> account</a></span>
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Signup</button>
    </form>

  </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>

