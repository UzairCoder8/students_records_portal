<?php session_start();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;


// incude database connection
require "./connection.php";

// 2. collect data and validate data
$username = $_POST['username'];
$password  = $_POST['password'];

if (!isset($username) || empty($username)) {
    $_SESSION['username_error'] = "Username field is required";
    header("Location: login-form.php");
    exit;
}
if (!isset($password) || empty($password)) {
    $_SESSION['password_error'] = "Password field is required";
    header("Location: login-form.php");
    exit;
}


// 1. check user is registered or not
$usr_sql = " SELECT * FROM users WHERE username='$username' ";
$usr_result = mysqli_query($con, $usr_sql);
if (mysqli_num_rows($usr_result) == 0) {
    $_SESSION['notregister_error'] = "Username or Password is incorrect";
    header("Location: login-form.php");
    exit;
}

// 2.  get registerd user
$usr = mysqli_fetch_row($usr_result);

// 3. verify password is correct
if (password_verify($password, $usr['password'])) {
    $_SESSION['is_login'] = true;
    $_SESSION['name'] = $usr['name'];
    header("Location: student.php");
    exit;
} else {
    $_SESSION['notregister_error'] = "Username or Password is incorrect";
    header("Location: login-form.php");
    exit;
}
