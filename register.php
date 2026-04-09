<?php session_start();
require ("./connection.php");

// echo "<pre>";

// print_r ($_POST);

// echo "</pre>";

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];




if (!isset($name) || empty($name)) {
    $_SESSION['name_error'] = "Name field is required";
    header("Location: register-form.php");
    exit;
}

if (!isset($username) || empty($username)) {
    $_SESSION['username_error'] = "Username field is required";
    header("Location: register-form.php");
    exit;
}

if (!isset($password) ||empty($password)) {
    $_SESSION['password_error'] = "Password field is required";
    header("Location: register-form.php");
    exit;
} 

if (strlen($password) < 6) {
    $_SESSION['password_error'] = "Password lenght should be atleast 6 characters";
    header("Location: register-form.php");
    exit;
}


// check username should be unique
// 1. select record from users table to confrim with this username a user is already registered or not?
$usr_sql = "SELECT * FROM users WHERE username='$username' ";
$sel_result = mysqli_query($con, $usr_sql);
if (mysqli_num_rows($sel_result) > 0) {
    $_SESSION['username_error'] = "Username already registered.";
    header("Location: register-form.php");
    exit;
}

// hashing password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (name, username,password) VALUES ('$name', '$username', '$$hashed_password')";
mysqli_query($con,$sql);
header("Location: login-form.php");
exit();


?>
