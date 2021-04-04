<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm công thức</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
	<style>
		.title-them_congthuc{
			font-weight: bold; 
			font-size: 30px;
			font-family: sans-serif;
		}
		input[type="submit"]{
			background-color:#28adc6;
			color:#ffffff;
			width: 100px;
			height: 30px;
			border-style:none;
			border-radius:5px;
		}
	</style>
</head>
<body>
	<?php include("menu.php"); ?>
	<?php
		if(isset($_GET['them'])){
	?>
	<div class="container-fluid" style="margin-top:100px;">
		<div class="row" >
			<div class="col-sm-12" align="center">
				<h4 class="title-them_congthuc">Thêm Công thức</h4>
			</div>
			<div class="col-sm-12" style="margin-top:50px;"></div>
			<form action="XuLy_form/Xuly_them_congthuc.php" 	 enctype="multipart/form-data" method="POST">
			<div class="col-sm-6">
				<img src="image/themhanghoa.png" alt="" width="100%" height="450px">
			</div>			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="">Tên món ăn</label>
					<input class="form-control" type="text" name="ten_mon_an" placeholder="Nhập tên món ăn tại đây">
				</div>
				<div class="form-group">
					<label for="">Danh mục</label>
					<select class="form-control" name="danhmuc">
						 <?php
							$bang_danhmuc = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
							$bang_danhmuc->setResult_select(" id, tenDanhmuc " ," 1 " , "id DESC");
							$ketqua_danhmuc = $bang_danhmuc->getResult_select();
							$select = "";
							while($row_danhmuc = mysqli_fetch_assoc($ketqua_danhmuc)){
								$value = $row_danhmuc['id'];
								if($id_danhmuc == $value){
									$select = "selected";
								}else $select = "";
								$ten_danhmuc = $row_danhmuc['tenDanhmuc'];
								echo "<option value= '$value' $select > $ten_danhmuc</option>" ; 
							}  
						 ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					<input class="form-control" type="textarea" name="mo_ta" placeholder="Nhập mô tả món ăn tại đây">
				</div>
				<div class="form-group">
					<label for="">Nguyên liệu</label>
					<textarea class="ckeditor form-control" name="nguyen_lieu" id="" cols="30" rows="10">
						<ul>
							<li></li>
						</ul>
					</textarea>
				</div>
				<div class="form-group">
					<label for="">Hướng dẫn cách làm </label>
					<textarea class="ckeditor " name="huong_dan" cols="30" rows="10"></textarea>
				</div>
				<div class="form-group">
					<label for="">Ảnh món ăn </label>
					<img src="" alt="">
					<input class="form-control" name="img_mon_an" type="file">

				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Thêm">
				</div>
			</div>
		</form>
		</div>
	</div>
	<div class="col-sm-12" style="margin-top: 100px;">
		
	</div>
	<?php 
		}
		else if(isset($_GET['capnhat'])){
			if(!isset($conn)){
				require_once '../Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}
			$id_monAn = $_GET['id_monAn'];
			$bang_monAn = new bang($conn , 'mon_an');
			$bang_monAn->setResult_select(" * " ," id = $id_monAn" , "id DESC"); 
			$kq_monAn = $bang_monAn->getResult_select();
			$row_monAn = mysqli_fetch_assoc($kq_monAn); 
			$ten_monan = $row_monAn['ten_monAn'];
			$mota = $row_monAn['moTa'];
			$step = $row_monAn['step'];
			$nguyen_lieu = $row_monAn['nguyenLieu']; 
			$img  = $row_monAn['img'];
			$id_danhmuc = $row_monAn['idDanhmuc'];

	?>
	<div class="container-fluid" style="margin-top:100px;">
		<div class="row" >
			<div class="col-sm-12" align="center">
				<h4 class="title-them_congthuc">Cập nhật Công thức</h4>
			</div>
			<div class="col-sm-12" style="margin-top:50px;"></div>
			<form action="XuLy_form/Xuly_capnhat.php?congthuc&id=<?php echo $id_monAn; ?>"  enctype="multipart/form-data" method="POST">
			<div class="col-sm-6">
				<img src="image/themhanghoa.png" alt="" width="100%" height="450px">
			</div>			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="">Tên món ăn</label>
					<input class="form-control" type="text" name="ten_mon_an" value="<?php echo $ten_monan; ?> " placeholder="Nhập tên món ăn tại đây">
				</div>
				<div class="form-group">
					<label for="">Danh mục</label>
					<select class="form-control" name="danhmuc">
						 <?php
							$bang_danhmuc = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
							$bang_danhmuc->setResult_select(" id, tenDanhmuc " ," 1 " , "id DESC");
							$ketqua_danhmuc = $bang_danhmuc->getResult_select();
							$select = "";
							while($row_danhmuc = mysqli_fetch_assoc($ketqua_danhmuc)){
								$value = $row_danhmuc['id'];
								if($id_danhmuc == $value){
									$select = "selected";
								}else $select = "";
								$ten_danhmuc = $row_danhmuc['tenDanhmuc'];
								echo "<option value= '$value' $select > $ten_danhmuc</option>" ; 
							}  
						 ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Mô tả</label>
					<input class="form-control" type="textarea" name="mo_ta" placeholder="Nhập mô tả món ăn tại đây" value="<?php echo $mota; ?>">
				</div>
				<div class="form-group">
					<label for="">Nguyên liệu</label>
					<textarea class="ckeditor form-control" name="nguyen_lieu" id="" cols="30" rows="10">
						<?php echo $nguyen_lieu; ?>

					</textarea>
				</div>
				<div class="form-group">
					<label for="">Hướng dẫn cách làm </label>
					<textarea class="ckeditor " name="huong_dan" cols="30" rows="10"><?php echo $step; ?></textarea>
				</div>
				<div class="form-group">
					<label for="">Ảnh món ăn </label> <input class="chon-anh" type="checkbox" name="chon_anh" style="margin-left: 10px;"> <label for="">Giữ nguyên ảnh cũ</label>
					<img src="" alt="">
					<input class="form-control" name="img_mon_an" type="file">

				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Thêm">
				</div>
			</div>
		</form>
		</div>
	</div>
	<?php
		}
	?>
</body>
</html>