<?php

class ClassTour
{
    //Tours
    public function tourCreate($date, $name, $image, $price, $itinerary, $duration, $description)
    {

        include 'connection.php';
        $connection = connect();

        $query2 = "SELECT * FROM tour ORDER BY id DESC LIMIT 1";
        $result2 = mysqli_query($connection, $query2) or die("Something went wrong in the query to the database");
        $lastId = mysqli_fetch_array($result2);
        $id = $lastId['id'];

        if ($id == '') {
            $id = 0;
        }
        $id++;

        $sql1 = "INSERT INTO tour VALUES('$id', '$name','$description','$date', '$duration','$price', '$itinerary', '$image')";
        $rc1 = mysqli_query($connection, $sql1);
        disconnect($connection);
        if ($rc1) {
            return true;
        }

        return false;
    }

    public function tourEdit($idTour)
    {
        setcookie("idTour", $idTour, time() + (86400), "/");
        echo "function";
        return true;
    }

    public function tourUpdt($date, $name, $image, $price, $itinerary, $duration, $description, $idTourU)
    {
        include 'connection.php';
        $connection = connect();

        $sql = "UPDATE tour SET date = '$date', name = '$name', image = '$image', price = '$price', itinerary = '$itinerary', duration = '$duration', description = '$description' WHERE id = '$idTourU'";

        $rc = mysqli_query($connection, $sql);

        disconnect($connection);
        if ($rc) {
            return true;
        }

        return false;

    }

    public function tourDel($idTourD)
    {

        include 'connection.php';
        $connection = connect();

        $sqlca = "DELETE FROM tour WHERE id = '$idTourD'";
        $rcca = mysqli_query($connection, $sqlca);

        disconnect($connection);

        if ($rcca) {
            return true;
        }

        return false;
    }
}
