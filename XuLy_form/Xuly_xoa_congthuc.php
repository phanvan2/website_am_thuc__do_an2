<?php
	if(!isset($conn)){
			require 'Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect(); 
		}
	if(isset($_GET['congthuc'])){
		$id_monAn = $_GET['id']; 
		
		$bang_monAn = new bang($conn, 'mon_an');
	 	$bang_monAn-> setResult_delete("id = $id_monAn");
	 	header("Location: ../danhsach_congthuc.php");
	}
	else if(isset($_GET['danhmuc'])){
			$id_danhmuc = $_GET['id']; 
			
			$bang_danhmuc = new bang($conn, 'danh_muc');
		 	$bang_danhmuc-> setResult_delete("id = $id_danhmuc");
		 	header("Location: ../danhsach_danhmuc.php");
	}
	else if(isset($_GET['sach'])){
		$id_sach = $_GET['id']; 
		
		$bang_sach = new bang($conn, 'sach');
	 	$bang_sach-> setResult_delete("id = $id_sach");
	 	header("Location: ../danh_sach.php?sach");
	}
	else if(isset($_GET['user'])){
		$id_user = $_GET['id']; 
		
		$bang_user = new bang($conn, 'user');
	 	$bang_user-> setResult_delete("id = $id_user");
	 	header("Location: ../danh_sach_user.php");
	}
	
?>