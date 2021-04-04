
<?php
	$timkiem = $_GET['timkiem'] ; 
	require 'Xuly_ketNoiSQL.php'; 
	$conn1 = new connectSQL ; // kết nối đến sql
	$conn1 -> setconnect();
	$conn = $conn1-> getconnect();
	$bang_monAn = new bang($conn, 'mon_an');
	$bang_monAn->setResult_select("*" ,"ten_monAn LIKE '%$timkiem%'" , "id DESC");
	$ketqua_monAn_9 = $bang_monAn->getResult_select();
	$send_id = []; 
	while($row_monAn = mysqli_fetch_assoc($ketqua_monAn_9)){
		array_push($send_id, $row_monAn['id']);

	}
	$str = implode(",", $send_id);

	echo var_dump($send_id);
	header("location: ../index.php?txt_tim=".$timkiem);
		?>