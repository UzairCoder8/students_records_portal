<?php
// geting data form index page to do something
$id = $_GET['id'];

include "./connection.php";


$qry = "DELETE FROM studdata WHERE id=$id";

mysqli_query($con,$qry);
header("Location: index.php");
exit();

?>
