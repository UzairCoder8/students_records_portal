<?php
session_start();

include "./connection.php";
//data collecing

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['number'];
$gender = $_POST['gender'];




if( !isset($name) || empty($name)) {
        $_SESSION['name-error'] = "Name field is required";
        header("Location: add.php");
        exit;
    }
if( !isset($email) || empty($email)) {
        $_SESSION['email-error'] = "Email field is required";
        header("Location: add.php");
        exit;
    }
if( !isset($phone) || empty($phone)) {
        $_SESSION['phone-error'] = "Phone field is required";
        header("Location: add.php");
        exit;
    }
if( !isset($gender) || empty($gender)) {
        $_SESSION['gender-error'] = "Gender field is required";
        header("Location: add.php");
        exit;
    }

$sql = "INSERT INTO studdata (name, email, phone,gender) VALUES
('$name', '$email', '$phone','$gender')";
mysqli_query($con,$sql);
header("Location: index.php");
exit();

?>