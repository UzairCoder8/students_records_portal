<?php session_start();

unset($_SESSION['is-login']);
unset($_SESSION['name']);
session_destroy();

header("Location: login-form.php");
exit;

?>