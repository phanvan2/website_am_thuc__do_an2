<?php
session_start(); 
 	if(!isset($conn)){
		require 'Xuly_ketNoiSQL.php'; 
/* */	$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	}
	if(isset($_COOKIE['user'])){
		$ten = $_COOKIE['user'];
		$idSach = $_POST['idSach'];
		$ten_gui = $_POST['ten'];
		$sdt_gui = $_POST['sdt']; 
		$dia_chi = $_POST['diachi'];
		$pt_thanhtoan = $_POST['PT_thanhtoan'];
		$tong_tien = $_GET['tong'];
		$tinh_trang = 0 ; 
//----------------
/* */	$bang_user = new bang($conn , 'user');
		$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row_User = mysqli_fetch_assoc($ketqua_idUser);

		$idUser = $row_User['id'];	

		echo $idUser;
		echo var_dump($idUser);
/* */	$bang_hoadon = new bang($conn , 'hoadon');

		$row_insert = "idSach, idUser , ten_gui , sdt_gui , dia_chi , pt_thanhtoan , tong_tien	 , tinh_trang" ; 
		$value_insert =  "'$idSach', $idUser , '$ten_gui' , '$sdt_gui' , '$dia_chi' , '$pt_thanhtoan', $tong_tien , '$tinh_trang'"; 
		$bang_hoadon->setResult_insert($row_insert , $value_insert); 
		// Lấy thời gian hiện tại -----------------
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ngaydathang = (date("Y-m-d H:i:s"));
		$bang_hoadon->setResult_select("id" ,"idUser = '$idUser' AND ten_gui = '$ten_gui' AND ngay_Dat = '$ngaydathang' " , "id DESC");
		$ketqua_idHoadon = $bang_hoadon->getResult_select(); 
		$row = mysqli_fetch_assoc($ketqua_idHoadon);
		$id_hoadon = $row['id'];
		echo $id_hoadon; 
		// Thêm dữ liệu vào bảng hóa đơn chi tiết 
		$bang_sach = new bang($conn , 'sach'); 
		$bang_sach->setResult_select(" * " , " id in ($idSach) "," id DESC"); 
		$kq_sach = $bang_sach->getResult_select();
		while ($row_sach = mysqli_fetch_assoc($kq_sach)) {
		$row1 = $row_sach['id'];
		$soluong = $_SESSION['cart'][$row1];
		$sl_sach = $row_sach['soLuong'] - $soluong; 
		$bang_sach->setResult_update( "soLuong = $sl_sach" , "id = $row1 ");
/* */	$bang_hoadon_chitiet = new bang($conn , 'hoadon_chitiet'); 
		$bang_hoadon_chitiet->setResult_insert("id_hoadon, id_sach, soluong" , "$id_hoadon, $row1, $soluong");
	} 
		session_destroy(); 
		header("Location: ../hoadon.php?id_hoadon=$id_hoadon");
		
	}else {

			}
	// truy vấn tới bảng hóa đơn
	
?>