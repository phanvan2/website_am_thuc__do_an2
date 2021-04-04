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
	<link rel="stylesheet" href="css/phan_trang.css">
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
		if($_COOKIE['quyen'] != 2) echo "<script>
			location.replace('index.php');
			</script>"; // ngươi quản trị
		if(!isset($conn)){

			require("XuLy_form/Xuly_ketNoiSQL.php");
			$conn1 = new connectSQL ;
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
	?>
	<?php 
		$bang_tin_tuc = new bang($conn, 'tin_tuc');
		$bang_tin_tuc->setResult_select(" count(id) as total " ," 1 " , "id DESC");
		$ketqua_tintuc = $bang_tin_tuc->getResult_select();
		
		$row_monAn1 = mysqli_fetch_assoc($ketqua_tintuc);
		$total_records = $row_monAn1['total'];
	 // Tìm limit và current page
		$current_page =  isset($_GET['page']) ? $_GET['page'] : 1 ;

		if(isset($_SESSION['limit'])){
			$limit = $_SESSION['limit'];
		}else{
			$limit = 5 ;
		}

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

			$bang_tin_tuc->setResult_select("*" ," 1 " , "id DESC  LIMIT $start, $limit");
			$ketqua_tintuc = $bang_tin_tuc->getResult_select();
			
	?>
	<div class="container" style="margin-top:100px">
		<h3>Quản lý tin tức </h3>
		<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Tiêu đề tin tức</th>
					<th>Ngày đăng</th>
					<th>Nguồn</th>
					<th></th>
					<th></th>
					<th></th>
						
				</tr>
			</thead>
			<tbody>	
	<?php

			$stt = 0;  
			while($row_tintuc = mysqli_fetch_assoc($ketqua_tintuc)){ 
				$stt ++ ; 
				$id_tintuc = $row_tintuc['id'];
				$tieu_de = $row_tintuc['ten_tin_tuc']; 
				$tac_gia = $row_tintuc['tac_gia']; 
				$nguon = $row_tintuc['nguon'];
				$ngay_dang = $row_tintuc['ngay_dang'] ; 
//----- TRuy vấn bảng user lấy tên người đăng công thức -------------
				
		
//============================
//------Truy vấn bảng danh mục lấy tên danh mục ------------------
		
	?>
				<tr>
					<td><?php echo $stt ; ?></td>
					<td><?php echo $tieu_de ; ?></td>
					<td><?php echo $ngay_dang ?></td>
					<td><?php echo $nguon;  ?></td>
					
					<td><a href="tintuc.php?id_tintuc=<?php echo $id_tintuc; ?> ">Chi tiết</a></td>
					<td align="center">
						<a href="them_tintuc.php?update&id_tintuc=<?php echo $id_tintuc ; ?>"><button>Cập nhật</button></a>
					</td>
					<td align="center">
						<a href=""><button>Xóa</button></a>
					</td>

				</tr>
	<?php 
		}
	?>
			</tbody>
			<tfoot>
				<tr align="right" >
					<td colspan="7" height="40px">
						<a href="them_tintuc.php?them"><button style="border-radius: 5px; border-style: none;margin-right: 20px; height: 30px" >THÊM TIN TỨC</button></a>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-sm-12" align="center" style="margin-top: 20px">
			<div class="pagination " align="center">
		 
	
			<?php
				// Phần hiển thị phân trang 
				// hiển thị phân trang 
				if($current_page > 1 && $total_page > 1){
					echo "<a href='danh_sach_tintuc.php?page=1'> &laquo;</a>";
				}
				for($i = 1 ; $i <= $total_page; $i++){
					// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
					if($i == $current_page){
						echo "<a href='' class='active'>$i</a>";
					}else{
						echo " <a href='danh_sach_tintuc.php?page=$i'>$i</a>";
					}
				} 
				if($current_page < $total_page && $total_page > 1){
					echo "<a href='danh_sach_tintuc.php?page=$total_page'>&raquo;</a>";
				}
			?>
				</div>
			</div>
</body>
</html>