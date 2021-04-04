<?php
	if(!isset($conn)){
		require 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	}
	$idUser = $_GET['idUser'];	
	$bang_user = new bang($conn, 'user');
	$bang_hoadon->setResult_update(" trangthai = '1' ", " id = $idUser");  
?>