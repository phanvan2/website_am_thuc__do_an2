<?php
	if(isset($_COOKIE['user'])){
		$ten = $_COOKIE['user'];
		$danh_gia = $_POST['rating'];
		$id_monAn = $_GET['id_monAn'];
		if(!isset($conn)){
			require_once 'Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		}
//---- Lấy  id của user ===========
		$bang_user = new bang($conn , 'user');
		$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row_User = mysqli_fetch_assoc($ketqua_idUser);

		$idUser = $row_User['id'];	

		$bang_danhGia = new bang( $conn , "danh_gia");
		$bang_danhGia-> setResult_select(" id " , " idMon_an = $id_monAn AND idUser = $idUser " , " id DESC"); 
		$kq_danhgia = $bang_danhGia-> getResult_select();
		if( mysqli_num_rows($kq_danhgia) <= 0 ){
			if( $danh_gia <= 0 ) {
			

			}else {
				$bang_danhGia->setResult_insert(" idMon_an , idUser ,kq_danh_gia " , "$id_monAn, $idUser, $danh_gia "); 
			}
		}else {

			if( $danh_gia > 0){
				$bang_danhGia->setResult_update(" kq_danh_gia = $danh_gia " , " idMon_an = $id_monAn AND idUser = $idUser "); 
			}
			else $bang_danhGia-> setResult_delete(" (idMon_an = $id_monAn) AND (idUser = $idUser)");
		}
		
		
	}

?>