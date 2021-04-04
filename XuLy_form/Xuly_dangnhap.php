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
				location.replace( '../thong_ke.php');
			}
			var index = function index(){
				location.replace('../index.php');
			}
		</script>
<?php
if(!isset($_COOKIE['user'])){
	require 'Xuly_ketNoiSQL.php';
	$ten = $_POST['ten'];
	$pass = md5( $_POST['pass']);

	$conn1 = new connectSQL ;
	$conn1 -> setconnect();
	$conn = $conn1-> getconnect();
	$bang_user = new bang($conn, 'user');
	echo $bang_user->getTenbang();
	$bang_user->setResult_select("id , quyen " ," ten = '$ten' AND password = '$pass'" , "id DESC");
	$ketqua = $bang_user->getResult_select();

	
	if(mysqli_num_rows($ketqua) == 1 ){
		setcookie("user", $ten, time() + 3600 ,'/');
		$row = mysqli_fetch_assoc($ketqua);
		setcookie("quyen" , $row['quyen'] , time() + 3600 , '/');
		if ($row['quyen'] == '2') 
		echo "
			<script> 
				alert1('Đăng nhập thành công' , 'success'); 
				setTimeout( replace, 1000);
			</script> "; 
		else {
				echo "
			<script> 
				alert1('Đăng nhập thành công' , 'success'); 
				setTimeout( index, 1000);
			</script> ";
		}
	}
	else echo "
			<script> 
				alert1('Đăng nhập thât bại ' , 'error'); 
				setTimeout( back, 1000);
			</script> ";
}else echo "
			<script> 
				alert1('Bạn cần đăng xuất ' , 'error'); 
				setTimeout( index, 1000);
			</script> ";
?>
	</body>
</html>	
	
	
	
