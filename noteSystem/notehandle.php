<?php

include "connection.php";
include "session.php";

if(isset($_POST['submit'])){
    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $text = $_POST['text'];

    $sqlAddNote = "INSERT INTO notes (title, text, userid) VALUES ('$title','$text','$userid')";
    $resultSqlNote = mysqli_query($connection, $sqlAddNote);

    if($resultSqlNote){
        header('Location: notes.php');
    }

}


if(isset($_POST['update'])){
    $noteid = $_POST['noteid'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $text = trim($text, '"');

    $sqlUpdateNote = "UPDATE notes SET title = '$title', text = '$text' WHERE noteid = '$noteid'";
    $resultSqlNote = mysqli_query($connection, $sqlUpdateNote);

    if($resultSqlNote){
        header('Location: notes.php');
    }

}



if(isset($_POST['delete'])){
    $noteid = $_POST['noteid'];

    $sqlDeleteNote = "DELETE FROM notes WHERE noteid = '$noteid'";
    $resultSqlNote = mysqli_query($connection, $sqlDeleteNote);

    if($resultSqlNote){
        header('Location: notes.php');
    }

}


?>