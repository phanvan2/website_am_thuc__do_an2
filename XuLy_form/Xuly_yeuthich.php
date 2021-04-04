<?php
	if(!isset($conn)){
		require_once 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	}
	if(isset($_GET['id_monAn'])){
		$id_monAn = $_GET['id_monAn'] ; 

// lấy id User =-----------------
		if ( isset($_COOKIE['user'])){
			$ten_user = $_COOKIE['user']; // laáy tên user
//--------------- Lấy id user 
			$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
			$bang_user->setResult_select(" * " ," ten = '$ten_user'" , "id DESC");
			$ketqua_idUser = $bang_user->getResult_select();
			$row = mysqli_fetch_assoc($ketqua_idUser);
			$idUser  = $row['id'];

// kiểm tra xem trong danh sách yêu thích có công thucws
			$bang_yeu_thich = new bang($conn , 'yeu_thich') ; 
			$bang_yeu_thich-> setResult_select(" id " , " idUser = $idUser AND idMon_an = $id_monAn " , " id DESC")  ; 
			if( mysqli_num_rows($bang_yeu_thich->getResult_select()) <= 0 ){
				$bang_yeu_thich-> setResult_insert("idUser , idMon_an" , "$idUser , $id_monAn ") ;
			} else 
				$bang_yeu_thich->setResult_delete("idUser = $idUser AND idMon_an = $id_monAn ") ;

		}
		
	} 
?>