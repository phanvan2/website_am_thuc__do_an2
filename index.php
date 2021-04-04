<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="">
	<style>
		
	</style>
</head>
<body>
	<?php include_once('menu.php'); ?>
	<?php include_once('banner.php'); ?>
	
	<?php 
		 include_once("timkiem.php") ;
	?>
	<div class="container-fluid" style="height: 50px"></div>
			<?php
			 include_once('danhmuc.php');
		?>
			<?php include_once('Noidung_chinh_index.php'); ?>
		
		

	<div class="">
		<?php include_once('footer.php'); ?>
	</div>
	

</body>
</html>