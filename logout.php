<?php session_start();

unset($_SESSION['is_login']);
unset($_SESSION['name']);
session_destroy();

header("Location: login-form.php");
exit;

?>