<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="../js/create_alert.js"></script>
	</head>
	<body>
		<?php
		require 'Xuly_ketNoiSQL.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$ten = $_POST['ten_mon_an'];
		$mota = $_POST['mo_ta'];
		$nguyenlieu = $_POST['nguyen_lieu'];
		$huongdan = $_POST['huong_dan'];
		$idDanhmuc = $_POST['danhmuc'];
		
		$trangthai = 0; 

		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();;

		$ten_user = $_COOKIE['user']; // laáy tên user
//--------------- Lấy id user 
		$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
		$bang_user->setResult_select("id, quyen" ," ten = '$ten_user'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row = mysqli_fetch_assoc($ketqua_idUser);
		$idUser  = $row['id'];
		$quyen = $row['quyen'];
		if($quyen == 2 ){
			$trangthai = 1; 
		}
//----------------
		
			if(isset($_FILES['img_mon_an'])){
				$name_img = $_COOKIE['user'].rand(10,200).$_FILES['img_mon_an']['name']; 
				if(move_uploaded_file($_FILES['img_mon_an']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/img_monAn/'.$name_img)){

					echo "Tai tap tin thanh cong";
// chèn dữ liệu vào bảng món ăn --------------------
					$bang_monAn = new bang($conn , 'mon_an');
					$bang_monAn->setResult_insert("idDanhmuc, idUser,ten_monAn, moTa, img , step, nguyenlieu, trangThai" , "$idDanhmuc , $idUser, '$ten' , '$mota', '$name_img' , '$huongdan' , '$nguyenlieu' , $trangthai");
// ------------------------------- 
					echo "
					<script> 
						alert1('Thêm thành công' , 'success'); 
						setTimeout( replace, 1000);
					</script> ";
				 }else echo "<script> 
						alert1('Thêm thất bại' , 'success'); 
						setTimeout( back, 1000);
					</script> ";
			}

	}
?>

	</body>
</html>
