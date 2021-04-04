<?php  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Những quyển sách nấu ăn hay</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bansach.css">
	<script src="js/Xuly_them_giohang.js"></script>
	<link rel="stylesheet" href="css/phan_trang.css">

	<style>
		.button-search{
			width: 80px; 
			background-color: #288ad6;
			border-style: solid;
			color:#ffffff;
			border-color:#288ad6;
			margin-left: 5px;
			/**/
		}
		.button-search:hover{
			box-shadow: 4px 4px 25px -2px rgba(0, 0, 0, 0.3);
		}
		.text-search{
			width: 25%;
		}
	</style>
</head>
<body>
	<script>
		function load_danhsach(){
			s = $('#limit_sach').val();
			var sapxep = $('#sapxep_sach').val();
		$("#re_load_bansach").load("XuLy_form/LoadAjax/Load_Ajax_bansach.php?limit="+s+"&sapxep="+sapxep);
    			
		}
	</script>
	<?php include_once("menu.php"); 
		if(isset($_SESSION['limit_sach'])){
			$limit = $_SESSION['limit_sach'];
		}else{
			$limit = 5 ;
		}
	?>
	<div class="container" style="margin-top: 100px" >
		<h3 style="font-weight: bold;">Bộ sưu tập sách nấu ăn ngon</h3>
		<div class="row" style="margin-top: 30px; ">
			<div class="col-sm-12" align="right">
 			<form action="XuLy_form/Xuly_timkiem_sach.php" method="GET">
				<input class="text-search" type="text" id="timkiem" name="timkiem" placeholder="Tìm kiếm" autocomplete="on">
				<button class="button-search" id="btn_timkiem" ><span class="glyphicon glyphicon-search"></span></button>
			</form>
				
			</div>
			<div class="col-sm-12">
				<div id="noi_dung_timkiem" align="center">
					<?php 
						include("noi_dung_timkiem_sach.php");
					?>
				</div>
			</div>
			<div class="col-sm-12" style="margin-top: 25px;">
				<div class="col-sm-5" >
					<label class="col-sm-5" for="">Số lượng hiển thị</label>
					<div class="col-sm-7">
						<input type="number" class="form-control" id="limit_sach" min="1" onchange="load_danhsach()" value="<?php echo $limit; ?>">
					</div>
					
				</div>
				<div class="col-sm-7" style="display: inline;">
					<label class="col-sm-3"  style="float: left;">Sắp xếp theo</label>
					
					<div class="col-sm-4">
						<select class="form-control" name="" id="sapxep_sach"  onchange="load_danhsach()">
							<option value="1">Giá cao đến thấp</option>
							<option value="2">Giá thấp đến cao</option>
							<option value="3">Mới nhất</option>
							<option value="4">Cũ nhất</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row" align="center" id="re_load_bansach">
			<?php
			if(!isset($conn)){
				require 'XuLy_form/Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}

				$bang_sach = new bang($conn , 'sach');
				$bang_sach->setResult_select(" count(id) as total " ," 1 " , "id DESC");
				$ketqua_sach = $bang_sach->getResult_select();
				$row_sach = mysqli_fetch_assoc($ketqua_sach);
				$total_records = $row_sach['total'];
				 // Tìm limit và current page
				$current_page =  isset($_GET['page']) ? $_GET['page'] : 1 ;
				

			// Tinh toán total page và start
			// tổng số trang
				$total_page = ceil($total_records/ $limit);
			
			// giới hạn current page trong khoảng 1 đến total_page 
				if($current_page > $total_page){
					$curren_page = $total_page ; 
				}else if( $current_page > $total_page){
					$current_page = $total_page;
				}
			// Tìm start 
			 	$start = ($current_page -1 ) * $limit;
				
				$bang_sach = new bang($conn , 'sach');
				$bang_sach->setResult_select("*" ,"1" , "don_gia DESC LIMIT $start, $limit");
				$ketqua_sach = $bang_sach->getResult_select(); 
				if(mysqli_num_rows($ketqua_sach) > 0){
					while($row_sach = mysqli_fetch_assoc($ketqua_sach)){

					
				
			?>
			<div class="col-sm-4">
				<div class="card-sach" >
					<div class="card-img-sach">
						<img src="image/sach/<?php echo $row_sach['img_sach']; ?>" alt="">
					</div>
					<div class="card-detail-sach">
						<span class="card-title-sach"><?php echo $row_sach['ten_sach']; ?></span>
						<p class="card-gia-sach"><?php echo number_format($row_sach['don_gia']); ?> <sub>đ</sub></p>
					</div>
					<div class="card-footer-sach">
						<p>
							<button><a href="chitiet_sach.php?id_sach=<?php echo $row_sach['id']; ?>">Xem thêm</a></button>
							<button onclick="them_gio_hang(<?php echo $row_sach['id']; ?>)">Mua ngay</button>
						</p>

					</div>
				</div>

			</div>
			<?php
				}
			} 
			?>
			<div class="col-sm-12" align="center" style="margin-top: 20px">
				<div class="pagination " align="center">
			 
		
				<?php
					// Phần hiển thị phân trang 
					// hiển thị phân trang 
					if($current_page > 1 && $total_page > 1){
						echo "<a href='bansach.php?page=1'> &laquo;</a>";
					}
					for($i = 1 ; $i <= $total_page; $i++){
						// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
						if($i == $current_page){
							echo "<a href='' class='active'>$i</a>";
						}else{
							echo " <a href='bansach.php?page=$i'>$i</a>";
						}
					} 
					if($current_page < $total_page && $total_page > 1){
						echo "<a href='bansach.php?page=$total_page'>&raquo;</a>";
					}
				?>
				</div>
			</div>
		</div>
		
	</div>
	
	<div  style="margin-top: 100px;">
		<?php include "footer.php" ; ?>
	</div>
	
</body>
</html>