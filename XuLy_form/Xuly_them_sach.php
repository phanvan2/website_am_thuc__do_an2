<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="../js/create_alert.js"></script>
	</head>
	<body>
		<?php
	require 'Xuly_ketNoiSQL.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$ten_sach = $_POST['ten_sach'];
		$tac_gia = $_POST['ten_tacgia'];
		$soluong = $_POST['soluong'];
		$mota = $_POST['mo_ta'];
		$gia = $_POST['gia'];

		$conn1 = new connectSQL ;
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
		$bang_user = new bang($conn, 'user');
		$ten = $_COOKIE['user'];
//----------------
		$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();

		$row = mysqli_fetch_assoc($ketqua_idUser);
		$idUser  = $row['id'];
		if(isset($_FILES['img_sach'])){
				$name_img = $_COOKIE['user'].rand(10,200).$_FILES['img_sach']['name']; 
				if(move_uploaded_file($_FILES['img_sach']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/sach/'.$name_img)){
					echo "Tai tap tin thanh cong";
					$bang_sach = new bang($conn , 'sach');
					$bang_sach->setResult_insert("id_User, ten_sach , tac_gia, don_gia, soLuong ,img_sach, mo_ta" , "$idUser, '$ten_sach', '$tac_gia', $gia  , $soluong, '$name_img' , '$mota'"); 
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

