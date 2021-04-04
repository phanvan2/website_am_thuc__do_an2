<?php
	require 'Xuly_ketNoiSQL.php';
	if(true) {
		$noidung = $_POST['binhluan'];
		$id_monAn = $_GET['id_monAn'];
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
		$bang_binhluan = new bang($conn , 'binh_luan');
		$bang_binhluan->setResult_insert("idUser,idMon_an , noiDung" , "$idUser, $id_monAn , '$noidung'" ); 
					
				}


?>