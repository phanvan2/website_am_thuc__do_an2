<?php
	require 'Xuly_ketNoiSQL.php';
	if(true) {
		$noidung = $_POST['binhluan'];
		$id_binhluan = $_POST['id_binhluan'];
		$conn1 = new connectSQL ;
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
		$bang_user = new bang($conn, 'user');
		$ten = $_COOKIE['user'];
//----------------
		$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();

		$row = mysqli_fetch_assoc($ketqua_idUser);
		$idUser  = $row['id'];
		$bang_traloi_binhluan = new bang($conn , 'tra_loi_binh_luan');
		$bang_traloi_binhluan->setResult_insert("idBinh_luan , idUser, noiDung" , "$id_binhluan ,$idUser, '$noidung'" ); 
		}


?>