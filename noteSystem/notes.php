<!doctype html>
<html lang="en">

<?php

include "connection.php";
include "session.php";

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sqlUsers = "SELECT * FROM users";
$resultusers = mysqli_query($connection, $sqlUsers);

$sqlUserNotes = "SELECT * FROM notes WHERE userid = '$userid'";
$resultUserNotes = mysqli_query($connection, $sqlUserNotes);


?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note | Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-white">

    <?php include "nav.php"; ?>

    <div class="alert alert-success rounded-4 m-2" style="max-width: 200px;" role="alert">
        Your total note count:  <?php echo mysqli_num_rows($resultusers);?>
    </div>

  <main class="container">

    <form class=".container-sm mx-auto" style="max-width: 250px;" action="notehandle.php" method="POST">
        <h3>Add Note Form</h3>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title" value="<?php ?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea name="text" class="form-control" id="text" rows="3"><?php echo "" ?></textarea>
        </div>
        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>">
        <button type="submit" name="submit" class="btn btn-success">Add</button>
    </form>

    <div class="container p-2">
    <h3>Your Notes</h3>
        <div class="row p-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        <?php 
            while ($notesRow = mysqli_fetch_assoc($resultUserNotes)) {
            echo "<form class=\".container-sm \" style=\"max-width: 250px;\" action=\"notehandle.php\" method=\"POST\">
                    <div class=\"mb-3\">
                        <label for=\"title\" class=\"form-label\">Title</label>
                        <input type=\"text\" name=\"title\" class=\"form-control\" id=\"title\" aria-describedby=\"title\" value=\"". $notesRow['title']. "\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"text\" class=\"form-label\">Text</label>
                        <textarea name=\"text\" class=\"form-control\" id=\"text\" rows=\"3\">\"". $notesRow['text']. "\"</textarea>
                    </div>
                    <input type=\"hidden\" name=\"noteid\" value=\" ".$notesRow['noteid']." \">
                    <button type=\"submit\" name=\"update\" class=\"btn btn-warning\">Update</button>
                    <button type=\"submit\" name=\"delete\" class=\"btn btn-danger\">Delete</button>
                </form>";
            }
        ?>
        </div>
</div>

  </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>