<!doctype html>
<html lang="en">

<?php

include "connection.php";
include "session.php";

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sqlUsers = "SELECT * FROM users";
$resultusers = mysqli_query($connection, $sqlUsers);



if(isset($_POST['submit'])){
    $up_username = $_POST['username'];
    $up_password = $_POST['password'];
    $up_userid = $_POST['userid'];

    $old_username = $_SESSION['username'];

    $sqlUpNameExist = "SELECT * FROM users WHERE username = '$up_username'"; 
    $resultUpNameExist = mysqli_query($connection, $sqlUpNameExist);

    if(mysqli_num_rows($resultUpNameExist) > 0 && $up_username !== $old_username){
        echo "<script>alert('This username already taken');</script>";
    }else{
        $sqlUpUser = "UPDATE users SET username = '$up_username', password =  '$up_password' WHERE userid = $up_userid";
        $resultUpUser = mysqli_query($connection, $sqlUpUser);
        if($resultUpUser){
            if($_SESSION['username'] !== $up_username || $_SESSION['password'] !== $up_password){
                echo "<script>alert('Details updated');</script>";
            }
            $_SESSION['username'] = $up_username;
            $_SESSION['password'] = $up_password;
            echo "<script>window.location.href = 'index.php'</script>";
        }else{
            echo "<script>alert('Details could not be updated');</script>";
            exit();
        }
    }
}

if(isset($_POST['deleteAccount'])){
  $userid = $_POST['userid'];

  $sqlDelNotes = "DELETE FROM notes WHERE userid = '$userid'";
  $resultDelNotes = mysqli_query($connection, $sqlDelNotes);

  $sqlDelUser = "DELETE FROM users WHERE userid = '$userid'";
  $resultDelNotes = mysqli_query($connection, $sqlDelUser);

  include "logout.php";

}

?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-white">

  <?php include "nav.php" ?>

    <div class="alert alert-success rounded-4 m-2" style="max-width: 200px;" role="alert">
        Total user count is <?php echo mysqli_num_rows($resultusers);?>
    </div>

  <main class="container">
    <h1>Hello, <?php echo $username?>!</h1>

    <form class=".container-sm mx-auto" style="max-width: 250px;" action="index.php" method="POST">
        <div class="mb-3 mt-5">
           <h4>Quick Profile Editor</h4>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" value="<?php echo $username?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" id="password" value="<?php echo $password?>">
        </div>
        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
        <button type="submit" name="submit" class="btn btn-warning">Update</button>
        <button type="submit" name="deleteAccount" class="btn btn-danger mx-1">Delete Account</button>
    </form>

  </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>