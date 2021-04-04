<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sách ngon</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<link rel="stylesheet" href="css/chitiet_sach.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>

	</style>
</head>
<body>
	<script>
		$(document).ready(function(){
			$("#them_gio_hang").click(function(){
				var url_string = window.location.href;
				var url = new URL(url_string);
				var id_sach = url.searchParams.get("id_sach");
				alert(id_sach);
				$.get("XuLy_form/Xuly_themgiohang.php" , {id: id_sach}, function(result){
					var s = document.getElementById('tong_cart').innerHTML;
					var s1 = parseInt(s, 10);
					document.getElementById('tong_cart').innerHTML = (s1 + 1);
				});
			});
		});
	</script>
	<?php include("menu.php"); ?>
	<div class="container" style="margin-top:100px;">
		<div  class="row">
			<div class="col-sm-12">
				<?php
				$id_sach = $_GET['id_sach'];
				if(!isset($conn)){
					require 'XuLy_form/Xuly_ketNoiSQL.php'; 
					$conn1 = new connectSQL ; // kết nối đến sql
					$conn1 -> setconnect();
					$conn = $conn1-> getconnect();
				}
				
				$bang_sach = new bang($conn , 'sach');
				$bang_sach->setResult_select("*" ," id = $id_sach " , "ngay_dang DESC");
				$ketqua_sach = $bang_sach->getResult_select(); 
				if(mysqli_num_rows($ketqua_sach) > 0){
					$row_sach = mysqli_fetch_assoc($ketqua_sach); 
				
			?>
				<div class="chitiet-sach">
				
					<div class="chitiet-img-sach" >
						<img src="image/sach/<?php echo $row_sach['img_sach']; ?>" alt="" width="100%" height="100%">
					</div>
				
					<div class="detail-img-sach">
						<h4><?php echo $row_sach['ten_sach']; ?></h4>
						<p><b>Tác giả:</b> <?php echo $row_sach['tac_gia']; ?> </p>
					
						<p><b>Nhà xuất bản:</b>NXB Thanh Niên</p>
						<p><b>Nhà phát hành:</b> 1980Books</p>
						<p><b>Số lượng sách còn lại: </b><?php echo $row_sach['soLuong']; ?></p>
						<p class="chitiet-gia-sach"><b>Đơn giá:</b> <?php echo number_format($row_sach['don_gia']); ?> <sub>đ</sub></p>
						<p><button id="them_gio_hang"> Thêm vào giỏ hàng</button></p>

					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<hr>
				<h3>Giới thiệu sách</h3>
				<p class="chitiet-gioi_thieu">
					<?php echo $row_sach['mo_ta']; 
						
					?>
				</p>	
			</div>
		</div>
		
	</div>
	<?php } include("footer.php"); ?>
</body>
</html>