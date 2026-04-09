<?php
session_start();

include "./connection.php";
//data collecing

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['number'];
$gender = $_POST['gender'];




if( !isset($name) || empty($name)) {
        $_SESSION['name_error'] = "Name field is required";
        header("Location: student.php");
        exit;
    }
if( !isset($emali) || empty($emali)) {
        $_SESSION['email_error'] = "Email field is required";
        header("Location: student.php");
        exit;
    }
if( !isset($phone) || empty($phone)) {
        $_SESSION['phone_error'] = "Phone field is required";
        header("Location: student.php");
        exit;
    }

$sql = "INSERT INTO studdata (name, email, phone,gender) VALUES
('$name', '$email', '$phone','$gender')";
mysqli_query($con,$sql);
header("Location: student.php");
exit();

?>