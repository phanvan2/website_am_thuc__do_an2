<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hóa đơn</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<link rel="stylesheet" href="css/hoadon.css">
	<style>
		
	</style>
</head>
<body>
	<?php include("menu.php"); ?>
	<?php
		if(isset($_GET['id_hoadon'])){
			$id_hoadon = $_GET['id_hoadon']; 
		}else if(isset($_GET['id_hoadon1']))
			$id_hoadon = $_GET['id_hoadon1']; 
		if(!isset($conn)){
			require 'Xuly_ketNoiSQL.php'; 
/* */		$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		}
/* */	$bang_hoadon = new bang($conn , 'hoadon');
		$bang_hoadon->setResult_select(" * " ,"id = $id_hoadon " , "id DESC");
		$ketqua_hoadon = $bang_hoadon->getResult_select(); 
		$row_hoadon = mysqli_fetch_assoc($ketqua_hoadon); 

		$ten = $row_hoadon['ten_gui'] ;
		$diachi = $row_hoadon['dia_chi'];
		$sdt = $row_hoadon['sdt_gui'];
		$tong_tien = $row_hoadon['tong_tien'];
		if($row_hoadon['pt_thanhtoan'] == 1 ){
			$pt_thanhtoan = "Tiền mặt "; 
		}else $pt_thanhtoan = "thẻ";
	?>
	<div class="container" align="center" style="height: 100%;">
		<div class="row" >
			<div class="col-sm-8 col-lg-offset-2 card-hoadon" align="center">
				<h3>Thông tin hóa đơn</h3>
				<hr style="width:80%; color: #dcdcdc; border-width: 1.2px;">
				<div class="" style="margin-top:20px;">
					<div class="col-sm-6" >
						<div class="thongtin-hoadon" align="left">
							<p><label for="">Người nhận:</label> <?php echo $ten ; ?></p>
							<p><label for="">Số điện thoại:</label><?php echo $sdt ;?></p>
							<p><label for="">Địa chỉ người nhận: </label> <?php echo $diachi; ?></p>
							<p><label for="">Hình thức thanh toán</label> <?php echo $pt_thanhtoan; ?></p>
							<p><label for="">Tổng Giá: </label><?php echo $tong_tien; ?></p>
						</div>
					</div>
					<div class="col-sm-6">
						<img src="image/hoadon.png" alt="">
					</div>	
				</div>
				<hr style="width:80%; color: #dcdcdc;">
				<div class="col-sm-12 ">
					
					<h5 style="font-weight: bold">Chi tiết hóa đơn </h5>
			<?php
/* */			$bang_hoadon_chitiet = new bang($conn , "hoadon_chitiet");
				$bang_hoadon_chitiet->setResult_select(" id_sach , soluong "," id_hoadon = $id_hoadon " , "id DESC " );
				$kq_hoadon_chitiet = $bang_hoadon_chitiet->getResult_select();
/* */			$bang_sach = new bang($conn , 'sach'); 

				while ($row_hd_chitiet = mysqli_fetch_assoc($kq_hoadon_chitiet)){
					$id_sach = $row_hd_chitiet['id_sach'];
					$soluong = $row_hd_chitiet['soluong'];

/* */				$bang_sach = new bang($conn , 'sach'); 
					$bang_sach->setResult_select(" * " , " id = $id_sach "," id DESC"); 
					$kq_sach = $bang_sach->getResult_select();
					$row_sach = mysqli_fetch_assoc($kq_sach); 
					$ten_sach = $row_sach['ten_sach'];
					$don_gia = $row_sach['don_gia'];
					$img = $row_sach['img_sach'];
					$thanh_tien = ($don_gia * $soluong);

			?>
			
					<div class="col-sm-12 card-chitiet-hoadon">
						<div class="col-sm-6">
							<h5><?php echo $ten_sach ; ?></h5>
							<p><label for="">Đơn giá: </label><?php echo number_format($don_gia); ?> </p>
							<p><label for="">Số lượng: </label><?php echo $soluong; ?></p>
							<p><label for="">Thành tiền</label><?php echo number_format($thanh_tien); ?></p>
						</div>
						<div class="col-sm-6">
							<img src="image/sach/<?php echo $img ; ?>" alt="" width="150px" height="200px">
						</div>
					</div>
			<?php 
				} 
			?>
				</div>
				<a href="index.php"><button class="btn-hoadon">Tiếp tục</button></a>
				<div style="height: 30px"></div>
			</div>
			<div class="col-sm-12" style="height: 50px;">
				
			</div>
		</div>
	</div>
	
</body>
</html>