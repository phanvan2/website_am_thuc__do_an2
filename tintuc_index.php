<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tin tức</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<link rel="stylesheet" href="css/tintuc_index.css">
	<style>
		
	</style>
</head>
<body>
	<?php 
		if(!isset($conn)){
			require 'XuLy_form/Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
		$bang_tintuc = new bang($conn , "tin_tuc") ;
		$bang_tintuc-> setResult_select(" * " , " 1" , " id DESC LIMIT 0 , 2 ") ; 

	?> 
	<div class=" container_angihomnay" style="margin-top: 10px; background-image: url(image/back.jpg);" id="tintuc">
		<div class="container">
		<div class="col-sm-7" align="left">
			<h4 class="col-sm-12">Tin tức nổi bật</h4>
			<hr   style="" width="50%">
			<div class="col-sm-12">
				
			</div>
			<div class="col-sm-12" >
		<?php
			$i = 1  ; 
			while ($row_tintuc = mysqli_fetch_assoc($bang_tintuc->getResult_select())) {
				$id_tintuc = $row_tintuc['id']  ; 
				$i ++ ; 
		?>
				<div class="col-sm-6">
					<a href="tintuc.php?id_tintuc=<?php echo $id_tintuc ; ?>" style="color:#ffffff ; text-decoration: none ; ">
						<div class="card-tintuc-today" style="background-repeat:no-repeat; background-size: 100% , 100%; background-image: url('image/img_tintuc/tintuc<?php echo $i; ?>.jpg');">
							<div class="card-text-today">
								<span><?php echo $row_tintuc['ten_tin_tuc'] ; ?></span>
								<p><a href="tintuc.php?id_tintuc=<?php echo $id_tintuc ; ?> " style="color:#ffffff; text-decoration: none ; "><button>Xem thêm</button></a></p>
							</div>
						</div>
					</a>
				</div>
		<?php
			}
			$bang_tintuc = new bang($conn , "tin_tuc") ;
			$bang_tintuc-> setResult_select(" * " , " 1" , " id DESC LIMIT 2 , 3 ") ;  
			$row_tintuc = mysqli_fetch_assoc($bang_tintuc->getResult_select()) ; 
			$id_tintuc = $row_tintuc['id'] ; 
		?>

				<div class="col-sm-12 col-sm-12" >
					<div class="cardtest" style="height:400px; background-image:url('image/img_tintuc/amthuc1.jpg'); ;margin-top: 10%; width:100% ; background-repeat:no-repeat; background-size: 100% , 100%;position: relative; ">
						<a href="tintuc.php?id_tintuc=<?php echo $id_tintuc ; ?> " style= "text-decoration: none ; "><button style=" margin-top: -100px;">Xem thêm</button></a>
						
						<div class="card-detail" style="margin-top: -400px; color:#ffffff; padding: 20px ; " align="center">
							<h2 ><?php echo $row_tintuc['ten_tin_tuc'] ; ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-5">
			<div class="" style="width: 100%;">
				<?php include("tin_tuc_1.php"); ?>
			</div>
		</div>
	</div>
	
</body>
</html>