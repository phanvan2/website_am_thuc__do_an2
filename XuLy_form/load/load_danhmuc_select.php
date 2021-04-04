<?php
	
	if(!isset($conn)){
		require 'XuLy_form/Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
	}
	$bang_danhmuc = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
	$bang_danhmuc->setResult_select("id, tenDanhmuc " ,"1 " , "id DESC");
	$ketqua_danhmuc = $bang_danhmuc->getResult_select();
	while($row_danhmuc = mysqli_fetch_assoc($ketqua_danhmuc)){
		$value = $row_danhmuc['id'];
		$ten_danhmuc = $row_danhmuc['tenDanhmuc'];
		echo "<option value= '$value'> $ten_danhmuc</option>" ; 
	} 

?>
