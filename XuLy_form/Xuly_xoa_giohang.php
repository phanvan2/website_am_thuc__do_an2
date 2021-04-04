<?php 
	session_start();
	$id = $_GET['id'];
	$i = $_SESSION['cart'][$id];
	unset($_SESSION['cart'][$id]);
	$_SESSION['tong']  -= $i;
	if($_SESSION['tong'] == 0 ) session_destroy(); 
	echo "<script>
			location.replace('../giohang.php');
			</script>";
	
?>