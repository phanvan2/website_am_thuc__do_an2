<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Name sản phẩm</title>
	<link rel="stylesheet" href="">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/sanpham.css">
	<script src="js/create_toggle.js"></script>
	<script src="rateStart/build/bootstrap-rating-input.min.js"></script>

<style>
		.card-start{
			background-color: red; 
			color:blue; 
		}
	</style>
</head>
<body>
	<script>
		// $(document).ready(function(){
		// 	$('#down').click(function(){  
		// 		$('#traloi1').slideToggle('slow');
		// 	});
		// }); 
		
		
	</script>
	<?php include('menu.php');
	
		$id_monAn = $_GET['id'];
	// ---------- kết nối tới cơ sở dữ liệu ------------------
		
	if(!isset($conn)){
				require_once 'XuLy_form/Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}
	
	// -----------lấy dữ liệu món ăn cần lấy -----------------
		$bang_monAn = new bang($conn, 'mon_an');
		$bang_monAn->setResult_select("*" ,"id='$id_monAn'" , "id DESC");
		$ketqua_monAn = $bang_monAn->getResult_select();
		$row = mysqli_fetch_assoc($ketqua_monAn);
		$value_danhgia  = "0"; 

		// lấy iduser _---------
		if(isset($_COOKIE['user'])){
			$ten = $_COOKIE['user'];
			$bang_user = new bang($conn , 'user');
			$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
			$ketqua_idUser = $bang_user->getResult_select();
			$row_User = mysqli_fetch_assoc($ketqua_idUser);

			$idUser = $row_User['id'];	


			$bang_danhGia = new bang( $conn , "danh_gia");
			$bang_danhGia-> setResult_select(" kq_danh_gia " , " idMon_an = $id_monAn AND idUser = $idUser " , " id DESC"); 
			$kq_danhgia = $bang_danhGia-> getResult_select(); 
			$row1 = mysqli_fetch_assoc($kq_danhgia);
			$value_danhgia = $row1['kq_danh_gia']; 
		}


	?>
	<div class="container" style="margin-top:100px;">
		<div class="row">
			<p class="duong-dan"> <a href="index.php">Trangchủ</a> /<a><?php echo $row['ten_monAn']; ?></a></p>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<div class="congthuc">
					<div class="ten-congthuc">
						<h4>Công thức làm <?php echo $row['ten_monAn']; ?></h4>
					</div>
					<div class="mota-congthuc" align="left">
						<h4 id="mo1">Mô tả Món ăn: </h4>
						<hr>
						<div class="mota-chitiet-congthuc">
							<?php echo $row['moTa']; ?>
						</div>
						<div class="img-congthuc" >
							<?php echo "<img src='image/img_monAn/".$row['img']."' alt='' width='100%' height='400px'>" ; ?>
						</div>
						<div class="thanhPhan-congthuc">
							<h5>Nguyên liệu: </h5>
							<hr>
							<?php echo $row['nguyenLieu']; ?>
						</div>
						<h5>Hướng dẫn thực hiện : </h5>
						<div class="chitiet-congthuc">
							<?php
								echo $row['step'];  
							?>
						</div>
						<h5>Video hướng dẫn: </h5>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/8w0psAnY6nE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row danh-gia">
			<h4>ĐÁNH GIÁ</h4>
			<div class="stars">
				
					<p class="card-start" style="font-size: 30px ; background-color: #ffffff; color:yellow ;" onclick="danh_giaa()">
						<input type="number" name="rating" id="ok" value="<?php echo $value_danhgia ; ?>"  class="rating"  data-clearable/>
					</p>
				
			  	</form>
			</div>
		</div>
		<script>
			function danh_giaa(){
			   var s  = $(".rating").val() ; 
			   		$.post("XuLy_form/Xuly_danh_gia.php?id_monAn=<?php echo $id_monAn; ?>", {rating : s}, function(result){
					
				});
			}
		</script>
		<?php
			include("binhluan.php"); 
		?>
	</div>

	<?php include('footer.php'); ?>
</body>
</html>