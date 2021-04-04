<?php
	$timkiem = $_GET['timkiem'] ; 
	require 'Xuly_ketNoiSQL.php'; 
	$conn1 = new connectSQL ; // kết nối đến sql
	$conn1 -> setconnect();
	$conn = $conn1-> getconnect();
	$bang_sach = new bang($conn, 'sach');
	$bang_sach->setResult_select("*" ,"ten_sach LIKE '%$timkiem%' OR don_gia LIKE '%$timkiem%'" , "id DESC");
	$ketqua_sach = $bang_sach->getResult_select();
	$send_id = []; 
	while($row_sach = mysqli_fetch_assoc($ketqua_sach)){
		array_push($send_id, $row_sach['id']);

	}
	$str = implode(",", $send_id);
	echo $str; 
	echo var_dump($send_id);
	header("location: ../bansach.php?txt_tim=".$timkiem);
		?>