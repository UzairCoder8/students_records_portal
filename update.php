<?php
include "./connection.php";
//data collecing

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['number'];
$gender = $_POST['gender'];

$sql = "UPDATE studdata SET name='$name',email='$email',phone='$phone',gender='$gender' WHERE id=$id";
mysqli_query($con,$sql);

header("Location: index.php");
exit();
?>