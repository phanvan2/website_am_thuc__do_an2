<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
		<script>
			function alert1(noidung , icon1){
				 a = swal({
					title: "Food Recipes",
					text: noidung,
					icon: icon1,
				});
				console.log(a);
			}
			var back = function back(){
				history.back();
			}
			var replace = function replace(){
				location.replace( '../index.php');
			}
		</script>
	</body>
</html>
<?php
	require 'Xuly_ketNoiSQL.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$danhmuc = $_POST['danhmuc'];
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
			if(isset($_FILES['img_danhmuc'])){
				$name_img = $_COOKIE['user'].rand(200,500).$_FILES['img_danhmuc']['name']; 
				if(move_uploaded_file($_FILES['img_danhmuc']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/img_danhmuc/'.$name_img)){
					echo "Tai tap tin thanh cong";
					$bang_danhmuc = new bang($conn , 'danh_muc');
					$bang_danhmuc->setResult_insert("idUser, tenDanhmuc , img" , "$idUser, '$danhmuc' , '$name_img'"); 
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
