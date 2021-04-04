<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Nội dung</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
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
	<script type="text/javascript"></script>
	<div class="" style="margin-top: 50px;">
		<?php include_once("tintuc_index.php"); ?>
	</div>
	<div class="container" style="margin-top: 50px;" id="moinhat">
		<div class="col-sm-12" align="left">
				<h4>MỚI NHẤT</h4>
				<hr  style="" width="50%"  >
		</div>
		<?php


			if(isset($_COOKIE['user'])){
				$ten_user = $_COOKIE['user']; // laáy tên user
				//--------------- Lấy id user 
				$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
				$bang_user->setResult_select("id" ," ten = '$ten_user'" , "id DESC");
				$ketqua_idUser = $bang_user->getResult_select();
				$row = mysqli_fetch_assoc($ketqua_idUser);
				$idUser  = $row['id'];
			}else $idUser = -1; 

				
				$bang_monAn = new bang($conn, 'mon_an');
				$bang_monAn->setResult_select("*" ," trangThai = '1' " , "id DESC LIMIT 0 , 12");
				$ketqua_monAn_9 = $bang_monAn->getResult_select();
				while($row = mysqli_fetch_assoc($ketqua_monAn_9)){
					$bang_xem_sau = new bang($conn, 'xem_sau');
					$display_xem = "none";
					$display_boxem = "none";
					$check_yeuthich = " " ; 
					$mota = $row['moTa'] ; 
					$length =  strlen($mota)  ; 
					$k = "" ;
					if( $length > 160 ) {
						$mota  = substr( $mota,  0, 160 )."..." ; 
						$k = strripos($mota, ' ') ; 
						$mota  = substr( $mota,  0, $k )."..." ; 
					}

						
					if(isset( $_COOKIE['user'])){
					$bang_xem_sau->setResult_select("id" , "idMon_an=".$row['id']." AND idUser= $idUser", "id DESC");
					$ketqua_xemsau = $bang_xem_sau->getResult_select();
					
						if(mysqli_num_rows($ketqua_xemsau) >0 ){
							$display_boxem = "inline-block";
						}else if(mysqli_num_rows($ketqua_xemsau) == 0 ) $display_xem = "inline-block";
						$bang_yeu_thich = new bang($conn , 'yeu_thich') ; 
						$bang_yeu_thich-> setResult_select(" id " , " idUser = $idUser AND idMon_an=".$row['id']." " , " id DESC")  ; 
						if( mysqli_num_rows($bang_yeu_thich->getResult_select()) > 0 )
								$check_yeuthich = "checked" ; 
					
						
					}
					
		?>
		<div class="col-sm-4">
			<div class=" card-sp">
				<div class="card-img-sp" style="width: 100%; height: 100%;">			
					<?php echo "<img class='card-img-sp' src='image/img_monAn/".$row['img']."' alt='' width='100%' height='100%'>"; ?>

				</div>
				<div class="card-detail-sp" align="center">
					<p class="card-name-sp"><?php echo $row['ten_monAn']; ?></p>
					<p><?php echo $mota ; ?></p>
				</div>
				<div class="card-footer-sp">
					<a <?php echo "href='sanpham.php?id=".$row['id']."'";  ?> >
						<button <?php echo "id='xemthem".$row['id']."'"; ?> >
							Xem thêm	
						</button>
					</a>
					<button onclick="btn_xemsau(<?php echo $row['id']; ?>) " style="display:<?php echo  $display_xem; ?> ;  margin-left:5px;" <?php echo "id='btn1".$row['id']."'"; ?> >
						Xem sau
					</button>
					<button onclick="btn_bo_xemsau(<?php echo $row['id'] ; ?>)" <?php echo "id='btn12".$row['id']."'" ; ?>  style="display:<?php echo  $display_boxem; ?> ;  margin-left:5px;" >
						Bỏ xem
					</button>
					<div class="mt-heart-indigo" style="font-size: 8px; float: right"> 

    					<input <?php echo "id='".$row['id']."'"; ?>name="check" type="checkbox"  <?php echo $check_yeuthich ; ?> onclick="yeu_thich(<?php echo $row['id'] ; ?>) " />
    					<label <?php echo "for='".$row['id']."'"; ?> ></label>  
    				</div>
				</div>
				<div style="height: 10px;">
					
				</div>
			</div>
		</div>
		<?php
			}
		?>
		
	</div>


<!--- 22222222222222222222222222222222222222-->	
	<div class="container" style="margin-top: 50px;" id="yeuthich">
		<div class="col-sm-12" align="left">
				<h4>YÊU THÍCH NHIỀU NHẤT </h4>
				<hr  style="" width="50%"  >
		</div>
		<?php
		$bang_yeu_thich1 = new bang($conn , 'yeu_thich') ; 

//  SELECT idMon_an, COUNT(1) FROM yeu_thich WHERE 1 GROUP BY idMon_an HAVING COUNT(1) > 1 ORDER BY COUNT(1) DESC LIMIT 0 , 6 
		$bang_yeu_thich1->setResult_select("idMon_an,  COUNT(1) " , " 1 GROUP BY idMon_an HAVING COUNT(1) > 1 " , " COUNT(1) DESC LIMIT 0 , 6 ") ; 
		while ($row_yeu_thich = mysqli_fetch_assoc($bang_yeu_thich1->getResult_select())){
			$id_monAn = $row_yeu_thich['idMon_an'] ; 

				$bang_monAn = new bang($conn, 'mon_an');
				$bang_monAn->setResult_select("*" ," trangThai = '1' AND id = $id_monAn  " , "id DESC ");
				$ketqua_monAn_9 = $bang_monAn->getResult_select();
				$row = mysqli_fetch_assoc($ketqua_monAn_9); 
					$bang_xem_sau = new bang($conn, 'xem_sau');
					$display_xem = "none";
					$display_boxem = "none";
					$check_yeuthich = " " ; 
					if(isset( $_COOKIE['user'])){
					$bang_xem_sau->setResult_select("id" , "idMon_an=".$row['id']." AND idUser= $idUser", "id DESC");
					$ketqua_xemsau = $bang_xem_sau->getResult_select();
					
						if(mysqli_num_rows($ketqua_xemsau) >0 ){
							$display_boxem = "inline-block";
						}else if(mysqli_num_rows($ketqua_xemsau) == 0 ) $display_xem = "inline-block";
						$bang_yeu_thich = new bang($conn , 'yeu_thich') ; 
						$bang_yeu_thich-> setResult_select(" id " , " idUser = $idUser AND idMon_an=".$row['id']." " , " id DESC")  ; 
						if( mysqli_num_rows($bang_yeu_thich->getResult_select()) > 0 )
								$check_yeuthich = "checked" ; 
					
						
					}
					
		?>
		<div class="col-sm-4">
			<div class=" card-sp">
				<div class="card-img-sp" style="width: 100%; height: 100%;">			
					<?php echo "<img class='card-img-sp' src='image/img_monAn/".$row['img']."' alt='' width='100%' height='100%'>"; ?>

				</div>
				<div class="card-detail-sp" align="center">
					<p class="card-name-sp"><?php echo $row['ten_monAn']; ?></p>
					<p><?php echo $row['moTa']; ?></p>
				</div>
				<div class="card-footer-sp">
					<a <?php echo "href='sanpham.php?id=".$row['id']."'";  ?> >
						<button <?php echo "id='xemthem".$row['id']."'"; ?> >
							Xem thêm	
						</button>
					</a>
					<button onclick="btn_xemsau(<?php echo $row['id']; ?>) " style="display:<?php echo  $display_xem; ?> ;  margin-left:5px;" <?php echo "id='btn1".$row['id']."'"; ?> >
						Xem sau
					</button>
					<button onclick="btn_bo_xemsau(<?php echo $row['id'] ; ?>)" <?php echo "id='btn12".$row['id']."'" ; ?>  style="display:<?php echo  $display_boxem; ?> ;  margin-left:5px;" >
						Bỏ xem
					</button>
					<div class="mt-heart-indigo" style="font-size: 8px; float: right"> 

    					<input <?php echo "id='".$row['id']."'"; ?>name="check" type="checkbox"  <?php echo $check_yeuthich ; ?> onclick="yeu_thich(<?php echo $row['id'] ; ?>) " />
    					<label <?php echo "for='".$row['id']."'"; ?> ></label>  
    				</div>
				</div>
				<div style="height: 10px;">
					
				</div>
			</div>
		</div>
		<?php
			}
		?>
		
	</div>
</body>
</html>