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
	<title>Quản lý sách nấu ăn</title>
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

		// Tinh gioi hạn  so san pham hien thi 
		$bang_sach = new bang($conn, 'sach');
		$bang_sach->setResult_select(" count(id) as total " ," 1 " , "id DESC");
		$ketqua_sach = $bang_sach->getResult_select();
		
		$row_sach1 = mysqli_fetch_assoc($ketqua_sach);
		$total_records = $row_sach1['total'];
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
		if(isset($_GET['sach'])){
			$bang_sach = new bang($conn , "sach");
			$bang_sach->setResult_select("*" ," 1 " , "ngay_dang DESC LIMIT $start, $limit");
			$kq_sach = $bang_sach->getResult_select();
			
			
	?>
	<div class="container" style="margin-top:100px">
		<h3>Quản lý sách nấu ăn</h3>
		<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sách</th>
					<th>Tác giả</th>
					<th>Đơn giá (VNĐ)</th>
					<th>Số lượng</th>
					<th>Ngày đăng</th>
					<th></th>
					<th></th>
					<th></th>
						
				</tr>
			</thead>
			<tbody>	
	<?php
		$stt = 0 ; 
		 while ($row_sach = mysqli_fetch_assoc($kq_sach)){
			$stt ++ ; 
			$id_sach = $row_sach['id'];
			$ten_sach = $row_sach['ten_sach'];
			$tac_gia = $row_sach['tac_gia'];
			$don_gia = $row_sach['don_gia'];
			$soluong = $row_sach['soLuong'];
			$ngay_dang = $row_sach['ngay_dang'];
	?>
				<tr>
					<td><?php echo $stt ; ?></td>
					<td><?php echo $ten_sach ; ?></td>
					<td><?php echo $tac_gia ; ?></td>
					<td><?php echo $don_gia ; ?></td>
					<td><?php echo $soluong; ?></td>
					<td><?php echo $ngay_dang; ?></td>
					<td align="center">
						<a href="chitiet_sach.php?id_sach=<?php echo $id_sach ; ?>"><p>Chi tiết</p></a>
					</td>
					<td align="center">
						<a href="them_sach.php?capnhat&id_sach=<?php echo $id_sach ; ?>"><button>Cập nhật</button></a>
					</td>
					<td align="center">
							<a href="XuLy_form/Xuly_xoa_congthuc.php?sach&id=<?php echo $id_sach; ?>"><button>Xóa</button></a>
					</td>

				</tr>
	<?php 
		}
	?>
			</tbody>
			<tfoot>
				
			</tfoot>
		</table>
	</div>
		<div class="col-sm-12" align="center" style="margin-top:20px;">
			<a href="them_sach.php?them"><button>Thêm sách</button></a>
		</div>
	<div class="col-sm-12" align="center" style="margin-top: 20px">
			<div class="pagination " align="center">
		 
	
			<?php
				// Phần hiển thị phân trang 
				// hiển thị phân trang 
				if($current_page > 1 && $total_page > 1){
					echo "<a href='danh_sach.php?sach&page=1'> &laquo;</a>";
				}
				for($i = 1 ; $i <= $total_page; $i++){
					// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
					if($i == $current_page){
						echo "<a href='' class='active'>$i</a>";
					}else{
						echo " <a href='danh_sach.php?sach&page=$i'>$i</a>";
					}
				} 
				if($current_page < $total_page && $total_page > 1){
					echo "<a href='danh_sach.php?sach&page=$total_page'>&raquo;</a>";
				}
			?>
				</div>
			</div>
	<?php
		}
	?>	
</body>
</html>