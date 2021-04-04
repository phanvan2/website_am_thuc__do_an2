<?php 
	session_start();
	$id = $_GET['id'];
	$_SESSION['cart'][$id] = $_GET['soluong'];
	echo "<script> location.replace('index.php')</script>";
?>