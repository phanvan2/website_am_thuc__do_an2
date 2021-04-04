<?php
		if($_COOKIE['quyen'] !=  2)  echo "<script>
			location.replace('index.php');
			</script>"; // ngươi quản trị
	if(isset($_COOKIE['quyen'])){
		if( $_COOKIE['quyen'] == 2 ){
			echo $_COOKIE['quyen'] ; 
			$user = $_COOKIE['user'] ; 
		}else
		echo "okk đéo cho them nha"  ; 

	}
	if(!isset($conn)){
		require 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	} 
	$ten_tintuc = $_POST['ten_tin_tuc']; 
	$tac_gia = $_POST['tac_gia'] ; 
	$nguon = $_POST['nguon'] ; 
	$noi_dung = $_POST['noi_dung'] ; 
	echo $ten_tintuc ; 
	echo $tac_gia ; 
	echo $nguon ; 
	$bang_tin_tuc = new bang($conn  , "tin_tuc") ;
	if(isset($_GET['them'])){
		$bang_tin_tuc->setResult_insert(" ten_tin_tuc , tac_gia , nguon , noi_dung , nguoi_dang  " ," '$ten_tintuc' , '$tac_gia' , '$nguon' , '$noi_dung', '$user' ") ; 
		// $bang_tin_tuc->setResult_insert(" ten_tin_tuc, tac_gia, nguon ,noi_dung,nguoi_dang " ," '$ten_tintuc' ,'$tac_gia' , '$nguon', '$noi_dung' , '$user' ") ; 
		echo 'hêleljfládjf'; 
	}else if(isset($_GET['update'])){
		$nguoi_dang = $_POST['nguoi_dang'] ;
		$id = $_POST['id_tintuc'] ; 
		echo $nguoi_dang ; 
		$bang_tin_tuc->setResult_update(" ten_tin_tuc = '$ten_tintuc' , tac_gia = '$tac_gia' , nguon = '$nguon' , noi_dung = '$noi_dung' " , "  id = $id ") ; 
	}
	header("location: ../thong_ke.php");
?>