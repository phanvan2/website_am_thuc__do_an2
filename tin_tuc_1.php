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
	<link rel="stylesheet" href="css/tintuc_index.css">

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
		$bang_tintuc-> setResult_select("id , ten_tin_tuc , DATE(ngay_dang) as date " , " 1" , " id ASC LIMIT 0 , 3 ") ; 

	?> 
	<div class="">
			<h4>Tin Tức Mới nhất</h4>
			<hr  width="70%">
		<?php 
		$i = 3 ;
			while ($row_tintuc = mysqli_fetch_assoc($bang_tintuc->getResult_select())){
				 $id_tintuc = $row_tintuc['id'] ;
				 $c = $row_tintuc['ten_tin_tuc'];
				 $i ++ ;
				 // xu lý chuoi 
				 $length =  strlen($c)  ; 
				 if ($length > 60 ) {
				 	$c = substr( $c,  0, 50 )."..." ; 
				 	$k = strripos($c, ' ') ; 
					$c  = substr( $c,  0, $k )."..." ; 
				 }
				 	

		?>
			<div class="col-sm-12" style="margin-top: 30px;">
				<div class="tintuc_card">
					<div class="col-sm-5" style="height: 100%">
						<div class="img-tintuc">
							<img src="image/img_tintuc/tin_tuc<?php echo $i ; ?>.jpeg" alt="" width="100%" height="100%">
						</div>
					</div>
					<div class="col-sm-7" style="height: 100%;">
						<div class="detail-tintuc">

							<a href="tintuc.php?id_tintuc=<?php echo $id_tintuc ; ?>" class="col-sm-12 title-tintuc" style= "text-decoration: none ; "><?php echo $c;  ?></a>
							<p class="col-sm-12" style="margin-top: 10px"><hr width="150px"></p>
							<p class="col-sm-12" align="right"><?php echo $row_tintuc['date']  ; ?></p>
						</div>	
					</div>
				</div>
			</div>
		<?php 
			}
		?>
			
		</div>

	</div>

</body>
</html>