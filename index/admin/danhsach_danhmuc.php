<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh sách người dùng</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="css/phan_trang.css">
	<link rel="stylesheet" href="css/Noidung_chinh_index.css">
	<script src="js/create_toggle.js"></script>
	<!-- //<script src="js/loadAjaxBinhluan.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>	
		table thead{
			background-color:#ffcc00;
		}
	</style>
</head><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh sách người dùng</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="css/bang.css">
	<link rel="stylesheet" href="css/Noidung_chinh_index.css">
	<script src="js/create_toggle.js"></script>
	<!-- //<script src="js/loadAjaxBinhluan.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>	
		table thead{
			background-color:#ffcc00;
		}
	</style>
</head>
<body>
	<?php include('menu.php');?>
	<?php
		if(!isset($conn)){

			require("XuLy_form/Xuly_ketNoiSQL.php");
			$conn1 = new connectSQL ;
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
	?>
	<?php 

			$bang_danhmuc = new bang($conn , "danh_muc");
			$bang_danhmuc->setResult_select("*" ," 1 " , "id DESC");
			$kq_danhmuc = $bang_danhmuc->getResult_select();
			
			
	?>
	<div class="container" style="margin-top:100px">
		<h3>Quản lý danh mục sản phẩm </h3>
		<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên danh mục</th>
					<th>Ảnh</th>
					<th></th>
					<th></th>
						
				</tr>
			</thead>
			<tbody>	
	<?php
		$stt = 0 ; 
		 while ($row_danhmuc = mysqli_fetch_assoc($kq_danhmuc)){
			$stt ++ ; 
			$id_danhmuc = $row_danhmuc['id'];
			$ten_danhmuc = $row_danhmuc['tenDanhmuc'];
			$img_danhmuc = $row_danhmuc['img'];

	?>
				<tr>
					<td><?php echo $stt ; ?></td>
					<td><?php echo $ten_danhmuc ; ?></td>
					<td style="width: 80px ; height: 50px;"><img src="image/img_danhmuc/<?php echo $img_danhmuc ; ?>" alt="" width="100%" height="100%" ></td>
					<td align="center">
						<a href="them_danhmuc.php?capnhat&id_danhmuc=<?php echo $id_danhmuc ; ?>"><button>Cập nhật</button></a>
					</td>
					<td align="center">
						<a href="XuLy_form/Xuly_xoa_congthuc.php?danhmuc&id=<?php echo $id_danhmuc;?>"><button>Xóa</button></a>
					</td>

				</tr>
	<?php 
		}
	?>
			</tbody>
			<tfoot>
				
			</tfoot>
		</table>
		<div class="col-sm-12" align="center" style="margin-top:20px;">
			<a href="them_danhmuc.php?them"><button>Thêm danh mục</button></a>
		</div>
		
	</div>	
</body>
</html>