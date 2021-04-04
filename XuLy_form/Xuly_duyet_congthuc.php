<?php
	$id_monAn = $_POST['id']; 
	if(!isset($conn)){
		require 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
	}
	$bang_monAn = new bang($conn, 'mon_an');
 	$bang_monAn-> setResult_update("trangThai = 1 " , "id = $id_monAn");
?>