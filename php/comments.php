<?php
session_start();
include 'connection.php';

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {

    $nameMsg = $_POST["name"];
    $emailMsg = $_POST["email"];
    $textMsg = $_POST["message"];

    $connection = connect();

    $query2 = "SELECT * FROM comment ORDER BY id DESC LIMIT 1";
    $result2 = mysqli_query($connection, $query2) or die("Something went wrong in the query to the database");
    $lastId = mysqli_fetch_array($result2);
    $id = $lastId['id'];
    //echo $id;
    if ($id == '') {
        $id = 0;
    }
    $id++;
    $sql1 = "INSERT INTO comment VALUES('$id','$nameMsg','$emailMsg', current_date, '$textMsg')";
    $rc1 = mysqli_query($connection, $sql1);
    disconnect($connection);
    if ($rc1) {
        echo 'ok';
        $_SESSION["confirmation"] = 'Your Messsage is stored correctly';
        header("Location:../index.php#lcontact");

    } else {
        echo 'nok';
    }
} else {
    echo 'no run';
}
