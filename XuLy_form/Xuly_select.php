<?php
	$disable_select = false;
	if(isset($_COOKIE['user'])){
		$ten_user = $_COOKIE['user'] ; 

		if(!isset($conn)){
			require 'XuLy_form/Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect(); 
		}
		$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
		$bang_user->setResult_select("quyen" ," ten = '$ten_user'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row = mysqli_fetch_assoc($ketqua_idUser);
		$quyen_user  = $row['quyen'];
		if($quyen_user == 2 ){
			$disable_select = true;
		}
	}
?>