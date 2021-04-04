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
</head>
<body>
	<?php 
		include("menu.php"); 
		if(!isset($conn)){
			require 'XuLy_form/Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
		$id_tintuc = $_GET['id_tintuc'] ; 
		$bang_tin_tuc = new bang($conn  , "tin_tuc") ;
		$bang_tin_tuc->setResult_select(" * " , " id = $id_tintuc " , "id DESC ") ; 
		$row_tintuc =  mysqli_fetch_assoc($bang_tin_tuc->getResult_select()) ;

	?>
		
	<div style="margin-top:100px"></div>
	<div class="container">
		<div class="col-sm-8">
			<h2 style="font-weight: bold; "><?php echo $row_tintuc['ten_tin_tuc'] ; ?></h2>
			<p style="float:right; display: inline-block; color:#9a9a9a;"><?php echo $row_tintuc['ngay_dang'] ; ?></p>
			<div style="margin-top:20px ">
				<?php echo $row_tintuc['noi_dung'] ; ?>
			</div>

			<a style="">Nguồn: <?php echo $row_tintuc['nguon'] ; ?></a>

		</div>
		<div class="col-sm-4 " >
			<?php include("tin_tuc_1.php"); ?>	
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>