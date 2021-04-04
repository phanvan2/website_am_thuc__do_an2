<?php
	if(!isset($conn)){
		require_once 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	}
	if(!isset($_COOKIE['quyen']))
		echo "<script> location.replace('index.php'); </script>";
	$ten_user = $_COOKIE['user']; // laáy tên user
//--------------- Lấy id user 
	$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
	$bang_user->setResult_select(" * " ," ten = '$ten_user'" , "id DESC");
	$ketqua_idUser = $bang_user->getResult_select();
	$row = mysqli_fetch_assoc($ketqua_idUser);
	$idUser  = $row['id'];

	$ten_user = $_POST['ten'] ; 
	$sdt = $_POST['sdt'] ; 
	$ho_ten = $_POST['ho_ten'] ; 
	$gioi_tinh = $_POST['gioi_tinh'] ; 
	$email = $_POST['email']; 
	$dia = $_POST['dia_chi'] ; 
	$fb = $_POST['link_fb'] ; 
	$ytb = $_POST['link_ytb'] ; 
	$about = $_POST['about'] ; 
	
	if(isset($_FILES['file_img'])){
		$name_img = $_COOKIE['user'].rand(200,500).$_FILES['file_img']['name']; 
		if(move_uploaded_file($_FILES['file_img']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/img_user/'.$name_img)){
			echo "Tai tap tin thanh cong";
			
			$list = "ten = '$ten_user' , sdt = '$sdt' , email ='$email' , img_user = '$name_img' , ho_va_ten = '$ho_ten' , about = '$about' , gioi_tinh = '$gioi_tinh' , dia_chi ='$dia'  ";
			
		}else $list = "ten = '$ten_user' , sdt = '$sdt' , email ='$email' , ho_va_ten = '$ho_ten' , about = '$about' , gioi_tinh = '$gioi_tinh', dia_chi ='$dia'   ";
	}else $list = "ten = '$ten_user' , sdt = '$sdt' , email ='$email' , ho_va_ten = '$ho_ten' , about = '$about' , gioi_tinh = '$gioi_tinh', dia_chi ='$dia'   ";
	$bang_user->setResult_update( $list , " id = $idUser");
	header("Location: ../ho_so_user.php"); 
?>