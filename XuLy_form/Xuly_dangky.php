<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
			<script>
				function alert1(noidung , icon1){
					swal({
					  title: "Food Recipes",
					  text: noidung,
					  icon: icon1,
					});
				}
				var back = function back(){
					history.back();
				}
				var replace = function replace(){
					location.replace( '../dangnhap.php');
				}
			</script>
<?php 
	require 'Xuly_ketNoiSQL.php';
	$conn1 = new connectSQL ;
	$conn1 -> setconnect();
	$conn = $conn1-> getconnect();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$ten = $_POST['ten'];
		$pass = md5($_POST['pass']);
		$repass = md5($_POST['repass']);
		$email = $_POST['email'];
		$quyen = $_POST['quyen'];
		$bang_user = new bang($conn, 'user');
		
		$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
		$ketqua1 = $bang_user->getResult_select();

		if($pass == $repass && mysqli_num_rows($ketqua1) == 0){
			$bang_user->setResult_insert("ten, password, email, quyen" , "'$ten', '$pass' , '$email' , $quyen");
			$ketqua = $bang_user->getResult_insert();
			
			echo "<script> 
					alert1('Đăng Ký thành công' , 'success');
					setTimeout( replace, 1000);

				</script>"; 
		}else echo "<script> 
					alert1('Đăng Ký thất bại !', 'error'); 
					setTimeout( back, 1000);
				</script>";

	
	}
	
?>
	</body>
</html>
		
