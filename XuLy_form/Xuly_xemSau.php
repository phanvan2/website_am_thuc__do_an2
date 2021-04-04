<?php
	require 'Xuly_ketNoiSQL.php';
		$ten_user = $_COOKIE['user']; // laáy tên user
//--------------- Lấy id user 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();

		$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
		$bang_user->setResult_select("id" ," ten = '$ten_user'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row = mysqli_fetch_assoc($ketqua_idUser);
		$idUser  = $row['id'];
//--------------------------------
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$idMon_an  = $_POST['id'];
		$bang_xem_sau = new bang($conn , 'xem_sau');
		if($_GET['dk'] == 1){

			
			
		// ---------- thêm vào bảng xem sau ---------------
			
			$bang_xem_sau->setResult_insert("idMon_an, idUser" , "$idMon_an , $idUser");
		}
		if($_GET['dk'] == 12){
			
		// ------------Xóa dữ liệu trong bảng xem sau ---------------
		
			$bang_xem_sau->setResult_delete("idMon_an = $idMon_an AND idUser = $idUser");
		}
		
	}
?>