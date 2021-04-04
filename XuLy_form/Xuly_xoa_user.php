<?php
	if(!isset($conn)){
			require 'Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect(); 
		}
	 if(isset($_POST['id_User'])){
		$id_user = $_POST['id_User']; 
		
		$bang_user = new bang($conn, 'user');
	 	$bang_user-> setResult_delete(" id = $id_user");
	 	header("Location: ../danh_sach_user.php");
	} 
?>