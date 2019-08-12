<?php

include_once 'classFunction.php';
include_once 'classTour.php';
session_start();
include_once 'csrf.php';

if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){
    if ($_POST) {
        if (isset($_POST["idUser"])) {

            $class = new classFunction();
            $idUser = $_POST["idUser"];
            echo "post";

            if ($class->userEdit($idUser)) {
                //echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["email"]) && isset($_POST["address"]) && isset($_POST["phone"])) {

            $class = new classFunction();

            $email = $_POST["email"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $name = $_POST["name"];
            $postcode = $_POST["postcode"];
            $password = $_POST["password"];
            $passwordC = $_POST["passwordC"];
            $idUserU = $_POST["idUserU"];

            $bool = $class->userUpdt($email, $address, $phone, $name, $postcode, $password, $passwordC, $idUserU);

            if ($bool) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["idUserD"])) {

            $class = new classFunction();
            $idUserD = $_POST["idUserD"];
            if ($class->userDel($idUserD)) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        //Bookings
        if (isset($_POST["idBook"])) {

            $class = new classFunction();
            $idBook = $_POST["idBook"];

            if ($class->bookEdit($idBook)) {
                //echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["tickets"]) && isset($_POST["state"]) && isset($_POST["idBookU"])) {

            $class = new classFunction();

            $date = $_POST["date"];
            $state = $_POST["state"];
            $user = $_POST["user"];
            $tour = $_POST["tour"];
            $tickets = $_POST["tickets"];
            $idBookU = $_POST["idBookU"];

            $bool = $class->bookUpdt($tickets, $state, $date, $user, $tour, $idBookU);

            if ($bool) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["idBookC"])) {

            $class = new classFunction();

            $idBookC = $_POST["idBookC"];

            $bool = $class->bookCancel($idBookC);

            if ($bool) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["idBookD"])) {

            $class = new classFunction();
            $idBookD = $_POST["idBookD"];
            if ($class->bookDel($idBookD)) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }
        //delete comment
        if (isset($_POST["idCtryD"])) {

            $class = new classFunction();
            $idCtryD = $_POST["idCtryD"];
            if ($class->ctryDel($idCtryD)) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        //Tours
        if (isset($_POST["date"]) && isset($_POST["name"]) && isset($_POST["image"]) && isset($_POST["price"]) && !(isset($_POST["idTourU"]))) {

            $class = new classTour();

            $date = $_POST["date"];
            $name = $_POST["name"];
            // $image = $_POST["image"];
            $price = $_POST["price"];
            $itinerary = $_POST["itinerary"];
            $duration = $_POST["duration"];
            $description = $_POST["description"];

            $img = "";
            if ($_FILES) {
                if ($_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {
                    $imgName = $_FILES['image']['name'];
                    $divide = explode(".", $imgName);
                    $extension = end($divide);
                    $allowed_type = array("jpg", "jpeg", "png", "gif");
                    if (in_array($extension, $allowed_type)) {
                        $img = $_FILES['image']['name'];
                        $path = "images/" . $img;
                        if (!file_exists("../" . $path)) {
                            move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path);
                        } else {
                            $img = rand() . $_FILES['image']['name'];
                            $path = "images/" . $img;
                            move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path);
                        }
                    }
                }
            }

                $bool = $class->tourCreate($date, $name, $img, $price, $itinerary, $duration, $description);

            if ($bool) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["idTour"])) {

            $class = new classTour();
            $idTour = $_POST["idTour"];
            echo "post";

            if ($class->tourEdit($idTour)) {
                //echo 'ok';
            } else {
                echo 'nok';
            }

        }

        if (isset($_POST["idTourU"]) && isset($_POST["name"]) && isset($_POST["price"])) {

            $class = new classTour();

            $date = $_POST["date"];
            $name = $_POST["name"];
            $price = $_POST["price"];
            $itinerary = $_POST["itinerary"];
            $duration = $_POST["duration"];
            $description = $_POST["description"];
            $idTourU = $_POST["idTourU"];
            //$image = $_POST["image"];

            $img = "";
            if ($_FILES) {
                if ($_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {
                    $imgName = $_FILES['image']['name'];
                    $divide = explode(".", $imgName);
                    $extension = end($divide);
                    $allowed_type = array("jpg", "jpeg", "png", "gif");
                    if (in_array($extension, $allowed_type)) {
                        $img = $_FILES['image']['name'];
                        $path = "images/" . $img;
                        if (!file_exists("../" . $path)) {
                            move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path);
                        } else {
                            $img = rand() . $_FILES['image']['name'];
                            $path = "images/" . $img;
                            move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path);
                        }
                    }
                }
            }

            $bool = $class->tourUpdt($date, $name, $img, $price, $itinerary, $duration, $description, $idTourU);

            if ($bool) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }

        if (isset($_POST["idTourD"])) {

            $class = new classTour();
            $idTourD = $_POST["idTourD"];
            if ($class->tourDel($idTourD)) {
                echo 'ok';
            } else {
                echo 'nok';
            }
        }
    }
}else{
    header('index.php');
}