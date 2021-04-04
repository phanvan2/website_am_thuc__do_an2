<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm sách nấu ăn</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>
<body>
	<?php include("menu.php"); ?>
	<?php
		if(isset($_GET['them'])){


	?>
	<div class="container-fluid" style="margin-top:100px;">
		<div class="row" >
			<div class="col-sm-12" align="center">
				<h4 class="title-them_congthuc">Thêm Sách</h4>
			</div>
			<div class="col-sm-12" style="margin-top:50px;"></div>
			
			<div class="col-sm-6">
				<img src="image/themhanghoa.png" alt="" width="100%" height="450px">
			</div>			
			<div class="col-sm-6">
				<form action="XuLy_form/Xuly_them_sach.php"  enctype="multipart/form-data" method="POST">
				<div class="form-group">
					<label for="">Tên Sách</label>
					<input class="form-control" type="text" name="ten_sach" placeholder="Nhập tên sách tại đây">
				</div>
				<div class="form-group">
					<label for="">Tác giả:</label>
					<input  class="form-control" type="text" name="ten_tacgia" placeholder="Nhập tên tác giả tại đây">
				</div>
				<div class="Số lượng">
					<label for="">Số lượng</label>
					<input class="form-control" type="number" name="soluong" placeholder="Nhập số lượng sách" min="1" step="1">
				</div>
				<div class="form-group">
					<label for="">Giá: </label>
					<input class="form-control" type="number" name="gia" min="10" step="10" placeholder="Nhập giá tại đây">
				</div>
				<div class="form-group">
					<label for="">Mô tả </label>
					<textarea class="ckeditor "  name="mo_ta" cols="30" rows="10"></textarea>
				</div>
				
				<div class="form-group">
					<label for="">Ảnh minh họa sách: </label>
					<img src="" alt="">
					<input class="form-control" name="img_sach" type="file">
				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Thêm">
				</div>
				</form>
			</div>
		
		</div>
	</div>
	<?php 
		}else if(isset($_GET['capnhat'])){
			if(!isset($conn)){
				require_once '../Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}
			$id_sach = $_GET['id_sach']; 
			$bang_sach = new bang($conn , 'sach');
			$bang_sach->setResult_select(" * " , "id = $id_sach", "id DESC");
			$kq_sach = $bang_sach->getResult_select();
			$row_sach = mysqli_fetch_assoc($kq_sach);
			$ten_sach = $row_sach['ten_sach'];
			$tac_gia = $row_sach['tac_gia'];
			$don_gia = $row_sach['don_gia'];
			$soLuong = $row_sach['soLuong'];
			$mo_ta = $row_sach['mo_ta'];

	?>
	<div class="container-fluid" style="margin-top:100px;">
		<div class="row" >
			<div class="col-sm-12" align="center">
				<h4 class="title-them_congthuc">Cập nhật Sách</h4>
			</div>
			<div class="col-sm-12" style="margin-top:50px;"></div>
			
			<div class="col-sm-6">
				<img src="image/themhanghoa.png" alt="" width="100%" height="450px">
			</div>			
			<div class="col-sm-6">
				<form action="XuLy_form/Xuly_capnhat.php?sach&id_sach=<?php echo $id_sach;?>"  enctype="multipart/form-data" method="POST">
				<div class="form-group">
					<label for="">Tên Sách</label>
					<input class="form-control" type="text" name="ten_sach" placeholder="Nhập tên sách tại đây" value="<?php echo $ten_sach; ?>">
				</div>
				<div class="form-group">
					<label for="">Tác giả:</label>
					<input  class="form-control" type="text" name="ten_tacgia" placeholder="Nhập tên tác giả tại đây" value="<?php echo $tac_gia; ?>">
				</div>
				<div class="Số lượng">
					<label for="">Số lượng</label>
					<input class="form-control" type="number" name="soluong" placeholder="Nhập số lượng sách" min="1" step="1" value="<?php echo $soLuong; ?>">
				</div>
				<div class="form-group">
					<label for="">Giá: </label>
					<input class="form-control" type="number" name="gia" min="10" step="10" placeholder="Nhập giá tại đây" value="<?php echo $don_gia; ?>">
				</div>
				<div class="form-group">
					<label for="">Mô tả </label>
					<textarea class="ckeditor "  name="mo_ta" cols="30" rows="10"><?php echo $mo_ta; ?></textarea>
				</div>
				
				<div class="form-group">
					<label for="">Ảnh minh họa sách: </label><input class="chon-anh" type="checkbox" name="chon_anh" style="margin-left: 10px;"> <label for="">Giữ nguyên ảnh cũ</label>
					<img src="" alt="">
					<input class="form-control" name="img_sach" type="file">
				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Thêm">
				</div>
				</form>
			</div>
		
		</div>
	</div>
	<?php 
		}
	?>
</body>
</html>