<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
	<style>
		body{
			background-image:url('image/tintuc.jpg');
			background-repeat:no-repeat;
			background-attachment: scroll;
		}
		.card-them_tintuc{
			margin-top:100px;
			background-color: #ffffff;
			border-radius: 10px;
		}
		.card-them_tintuc h3{
			font-weight:bold;
			font-size: 24px;
			
		}
		input[ type = submit]{
			background-color: #28adc6;
			color:#ffffff;
			border-radius: 5px;
			border-style: none;
			width: 10%; 
			height: 30px; 
		}
	</style>
</head>
<body>
	<?php 
		include("menu.php");
		if($_COOKIE['quyen'] != 2)  echo "<script>
			location.replace('index.php');
			</script>"; // ngươi quản trị 
	?>
	<div class="container" style=" ">
		<div class="col-sm-8 col-sm-offset-2 card-them_tintuc" style="">
			<?php
				if( isset($_GET['them'])){
			?>
			<form action="XuLy_form/them_tin_tuc.php?them" method="post">
				<h3 class="col-sm-12" align="center">Thêm tin tức ẩm thực</h3>
				<div class="form-group">
					<label for="">Tên tin tức ẩm thực</label>
					<input class="form-control" type="text" placeholder="Nhập tên của tin tức ẩm thực" name="ten_tin_tuc">
				</div>
				<div class="form-group">
					<label for="">Người Viết</label>
					<input class="form-control" type="text" name="tac_gia" placeholder="Nhập tên của người viết">
				</div>
				<div class="form-group">
					<label for="">Nguồn</label>
					<input class="form-control" type="text" name="nguon" placeholder="Nhập nguồn tin tức">
				</div>
				<div class="form-group">
					<label for="">Nội dung</label> 
					<textarea class="ckeditor" name="noi_dung" name="noi_dung" id="" cols="100%" rows="10"></textarea>
				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Thêm" id="them_tin_tuc">
				</div>
				<div style="height: 30px">
					
				</div>
			</form>
			<?php
				}else if( isset($_GET['update'])){
					$id_tintuc = $_GET['id_tintuc'] ;
					$bang_tin_tuc  = new bang($conn , "tin_tuc")  ; 
					$bang_tin_tuc-> setResult_select("* " , " id = $id_tintuc " , "id DESC") ; 
					$row_tin_tuc = mysqli_fetch_assoc($bang_tin_tuc-> getResult_select()) ; 
					$tieu_de =  $row_tin_tuc['ten_tin_tuc'] ; 
					$ngay_dang = $row_tin_tuc['ngay_dang'] ; 
					$tac_gia = $row_tin_tuc['tac_gia'] ; 
					$nguon = $row_tin_tuc['nguon']  ; 
					$noi_dung =$row_tin_tuc['noi_dung']  ; 
					$nguoi_dang = $row_tin_tuc['nguoi_dang'] ; 

			?>
			<form action="XuLy_form/them_tin_tuc.php?update" method="post">
				<h3 class="col-sm-12" align="center">Thêm tin tức ẩm thực</h3>
				<div class="form-group">
					<label for="">Tiêu đề tin tức ẩm thực</label>
					<input class="form-control" type="text" placeholder="Nhập tên của tin tức ẩm thực" name="ten_tin_tuc" value="<?php echo $tieu_de ; ?>">
				</div>
				<div class="form-group">
					<label for="">Người Viết</label>
					<input class="form-control" type="text" name="tac_gia" placeholder="Nhập tên của người viết" value="<?php echo $tac_gia;  ?>">
				</div>
				<div class="form-group">
					<label for="">Nguồn</label>
					<input class="form-control" type="text" name="nguon" placeholder="Nhập nguồn tin tức" value="<?php echo $nguon ;?>">
					<input type="text" value="<?php echo $nguoi_dang ;?>" style= "display: none ;" name="nguoi_dang">
					<input type="text" name="id_tintuc" value="<?php echo $id_tintuc; ?>" style="display: none; ">	

				</div>
				<div class="form-group">
					<label for="">Nội dung</label> 
					<textarea class="ckeditor" name="noi_dung" name="noi_dung" id="" cols="100%" rows="10"><?php echo $noi_dung; ?></textarea>
				</div>
				<div class="form-group" align="center">
					<input type="submit" value="Cập nhật" id="cap_nhat_tintuc">
				</div>
				<div style="height: 30px">
					
				</div>
			</form>

			<?php
				} 
			?>
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>