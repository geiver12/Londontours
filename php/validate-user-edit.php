<?php
session_start();
include_once 'csrf.php';
include "../php/connection.php";
if (isset($_GET['tour_id'])) {
    $tour_id = $_GET['tour_id'];
    $connection = connect();
    $query = "UPDATE t_user_tour  SET state = 0 where id=" . $tour_id . "";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "Update";

        unset($_GET['tour_id']);
        header("Location:../user/mybookings.php");
    } else {
        echo "Cant update";
    }
    disconnect($connection);
}
