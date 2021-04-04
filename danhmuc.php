<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh mục</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="css/danhmuc.css">
    <link rel="stylesheet" href="css/Noidung_chinh_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/JNKKKK/MoreToggles.css@0.2.1/output/moretoggles.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    
    </style>
</head>
<body>
	<script>
		function btn_xemsau(id_sanpham){
			
			$('#btn1'+id_sanpham).css({
				display: 'none'
			});	
			$('#btn12'+id_sanpham).css({
					display: 'inline-block'
			});
			$.post("XuLy_form/Xuly_xemSau.php?dk=1", {id : id_sanpham}, function(result){
				
			});
			
		}
		function btn_bo_xemsau(id_sanpham){
			
			$('#btn12'+id_sanpham).css({
				display: 'none'
			});	
			$('#btn1'+id_sanpham).css({
				display: 'inline-block'
			});
			$.post("XuLy_form/Xuly_xemSau.php?dk=12", {id : id_sanpham}, function(result){
				
			});
			
		}
		function yeu_thich(id){
			$.get("XuLy_form/Xuly_yeuthich.php?dk=12", {id_monAn : id}, function(result){
				
			});
		}
	</script>
	<div class="container-fluid" style="width: 60%" id="danhmuc">
		<div class="row"  >
			<div class="col-sm-12" align="left" style="margin-top: 30px;">
				<h5>DANH MỤC</h5>
				<hr  style="" width="50%"  >
			</div>
		</div>
		
		<div class="row" align="left">
			<?php
			if(!isset($conn)){

				require("XuLy_form/Xuly_ketNoiSQL.php");
				$conn1 = new connectSQL ;
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}
				$bang_danhmuc = new bang($conn, 'danh_muc');
				$bang_danhmuc->setResult_select("*" ," 1" , "id DESC");
				$ketqua_danhmuc_All = $bang_danhmuc->getResult_select();
				while($row = mysqli_fetch_assoc($ketqua_danhmuc_All)){
					$id_danhmuc = $row['id'];
			?>
				
			
			<div class=" carddanhmuc " align="center"  >
				<div  class="card-danhmuc"  align="center">
					<a href="danhmuc_index.php?id_danhmuc=<?php echo $row['id']; ?> ">
						<div class="card-img-danhmuc" align="center">
							<?php echo "<img src='image/img_danhmuc/".$row['img']."' alt='' width='70%' height='40%'>"; ?>
						</div>
						<div class="card-detail-danhmuc">
							<p><?php echo $row['tenDanhmuc']; ?></p>
						</div>
					</a>
				</div>
			</div>
			<?php 

				}

			?>
			
		</div>
	</div>
	<div class="container">
		<div class="col-sm-12">
				
			
			<?php 
				if(isset($_GET['id_danhmuc'])){
					include("danhmuc_sanpham.php");
				}
				 
			?>
			</div>
	</div>
</body>
</html>