<?php
	$id_user = $_POST['id_user'];
	if(!isset($conn)){
	require 'Xuly_ketNoiSQL.php'; 
	$conn1 = new connectSQL ; // kết nối đến sql
	$conn1 -> setconnect();
	$conn = $conn1-> getconnect(); 
	}
	$bang_user = new bang($conn , "user") ; 
	$bang_user-> setResult_select(" id " , " id = $id_user AND trangthai = 0 " , "id DESC") ; 
	if ( mysqli_num_rows($bang_user->getResult_select()) > 0 )
		$bang_user->setResult_update("trangthai = 1 " , " id = $id_user ") ; 
	else $bang_user->setResult_update("trangthai = 0 " , " id = $id_user ") ;  
?>