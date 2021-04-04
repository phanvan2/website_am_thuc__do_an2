<span>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$ten = $_GET['ten'];
	$conn = mysqli_connect("localhost", "root", "" , "amthuc_webcuoiky3"); 
	$sql = "SELECT id FROM user WHERE ten = '$ten'";
	$ketqua = mysqli_query($conn , $sql);
	if( mysqli_num_rows($ketqua) >  0  ){
		echo "<span>Tên đã được dùng !! </span>";
	}else echo "<span> </span>";
}
	
?>
</span>