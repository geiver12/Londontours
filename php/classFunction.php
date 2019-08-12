<?php

class ClassFunction
{

    public function __construct()
    {
        # code...
    }

    public function userEdit($idUser)
    {

        setcookie("idUser", $idUser, time() + (86400), "/");
        echo "function";

        return true;
    }

    public function userUpdt($email, $address, $phone, $name, $postcode, $password, $passwordC, $idUserU)
    {
        include 'connection.php';
        require '../lib/password.php';
        $connection = connect();

        $pass = $passwordC;
        if ($password != '') {
            $pass = password_hash($password, PASSWORD_DEFAULT);
        }

        $sql = "UPDATE user SET email = '$email', address = '$address', phone = '$phone', name = '$name', postcode = '$postcode', password = '$pass' WHERE id = '$idUserU'";

        $rc = mysqli_query($connection, $sql);

        disconnect($connection);
        if ($rc) {
            return true;
        }

        return false;

    }

    public function userDel($idUserD)
    {

        include 'connection.php';
        require '../lib/password.php';
        $connection = connect();

        $sqlca = "DELETE FROM user WHERE id = '$idUserD'";
        $rcca = mysqli_query($connection, $sqlca);

        disconnect($connection);

        if ($rcca) {

            return true;
        }

        return false;
    }

    //Bookings
    public function bookEdit($idBook)
    {

        setcookie("idBook", $idBook, time() + (86400), "/");

        return true;
    }

    public function bookUpdt($tickets, $state, $date, $user, $tour, $idBookU)
    {
        include 'connection.php';
        $connection = connect();

        $sql = "UPDATE tour_user SET tickets = '$tickets', state = '$state', date = '$date', fk_user = '$user', fk_tour = '$tour' WHERE id = '$idBookU'";

        $rc = mysqli_query($connection, $sql);

        disconnect($connection);
        if ($rc) {
            return true;
        }

        return false;

    }

    public function bookCancel($idBookC)
    {
        include 'connection.php';
        $connection = connect();

        $sql = "UPDATE tour_user SET state = 0 WHERE id = '$idBookC'";

        $rc = mysqli_query($connection, $sql);

        disconnect($connection);
        if ($rc) {
            return true;
        }

        return false;

    }

    public function bookDel($idBookD)
    {

        include 'connection.php';
        $connection = connect();

        $sqlca = "DELETE FROM tour_user WHERE id = '$idBookD'";
        $rcca = mysqli_query($connection, $sqlca);

        disconnect($connection);

        if ($rcca) {

            return true;
        }

        return false;
    }

    public function ctryDel($idCtryD)
    {

        include 'connection.php';
        $connection = connect();

        $sqlca = "DELETE FROM comment WHERE id = '$idCtryD'";
        $rcca = mysqli_query($connection, $sqlca);

        disconnect($connection);

        if ($rcca) {

            return true;
        }

        return false;
    }

}
