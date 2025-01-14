<!doctype html>
<html lang="en">

<?php

include "connection.php";

if(isset($_POST['submit'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $checkExistQuery = "SELECT * FROM users WHERE username = '$uname'";
    $resultExist = mysqli_query($connection, $checkExistQuery);

    if(mysqli_num_rows($resultExist) == 1){

        $userRow = mysqli_fetch_assoc($resultExist);
        $passwordInDb = $userRow['password'];
        if($passwordInDb == $pass){
            session_start();
            $_SESSION['userid'] = $userRow['userid'];
            $_SESSION['username'] = $userRow['username'];
            $_SESSION['password'] = $userRow['password'];
            $_SESSION["loggedin"] = true;
            
            header('Location: index.php');

        }else{
            echo "<script>alert('Incorrect Password');</script>";
        }

    }else{
        echo "<script>alert('This username is not valid');</script>";
    }
}


?>


  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-white">

  <main class="container mt-5">
    <h1>Login to note!</h1>

    <form class=".container-sm mx-auto" style="max-width: 250px;" action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
        </div>
        <div class="mb-1">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <span>If you do not have an<a href="signup.php" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"> account</a></span>
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Login</button>
    </form>

  </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>