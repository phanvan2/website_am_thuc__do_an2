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
		if(!isset($conn)){

			require("XuLy_form/Xuly_ketNoiSQL.php");
			$conn1 = new connectSQL ;
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
	?>
	<?php 
		$bang_monAn = new bang($conn, 'mon_an');
		$bang_monAn->setResult_select(" count(id) as total " ," 1 " , "id DESC");
		$ketqua_monAn1 = $bang_monAn->getResult_select();
		
		$row_monAn1 = mysqli_fetch_assoc($ketqua_monAn1);
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

			$bang_monAn->setResult_select("*" ," 1 " , "ngayDang DESC  LIMIT $start, $limit");
			$ketqua_monAn = $bang_monAn->getResult_select();
			
	?>
	<div class="container" style="margin-top:100px">
		<h3>Quản lý Công thức nấu ăn </h3>
		<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Ảnh</th>
					<th>Người đăng</th>
					<th>Tên món ăn</th>
					<th>Ngày đăng</th>
					<th>Danh mục</th>
					<th></th>
					<th></th>
					<th></th>
						
				</tr>
			</thead>
			<tbody>	
	<?php

			$stt = 0;  
			while($row_monAn = mysqli_fetch_assoc($ketqua_monAn)){ 
				$stt ++ ; 
				$id_monAn = $row_monAn['id'];
				$id_User = $row_monAn['idUser']; 
				$id_danhmuc = $row_monAn['idDanhmuc']; 
				$img_moAn = $row_monAn['img'];
//----- TRuy vấn bảng user lấy tên người đăng công thức -------------
				
				$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
				$bang_user->setResult_select("ten" ," id = '$id_User'" , "id DESC");
				$ketqua_User = $bang_user->getResult_select();
				$row_User = mysqli_fetch_assoc($ketqua_User);
				$ten_User  = $row_User['ten'];
//============================
//------Truy vấn bảng danh mục lấy tên danh mục ------------------
				$bang_danhmuc1 = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
				$bang_danhmuc1->setResult_select("tenDanhmuc " ," id = $id_danhmuc " , "id DESC");
				$ketqua_danhmuc1 = $bang_danhmuc1->getResult_select();
				$row_danhmuc1 = mysqli_fetch_assoc($ketqua_danhmuc1);
				$ten_danhmuc  = $row_danhmuc1['tenDanhmuc'];
	?>
				<tr>
					<td><?php echo $stt ; ?></td>
					<td style="width: 100px ;height: 50px"><img src="image/img_monAn/<?php echo $img_moAn;?>" alt="" width="100%" height="100%"></td>
					<td><?php echo $ten_User ; ?></td>
					<td><?php echo $row_monAn['ten_monAn']; ?></td>
					<td><?php echo $row_monAn['ngayDang']; ?></td>
					<td><?php echo $ten_danhmuc ; ?> </td>
					<td><a href="sanpham.php?id=<?php echo $id_monAn; ?> ">Chi tiết</a></td>
					<td align="center">
						<a href="them_congthuc.php?capnhat&id_monAn=<?php echo $id_monAn ; ?>"><button>Cập nhật</button></a>
					</td>
					<td align="center">
						<a href="XuLy_form/Xuly_xoa_congthuc.php?congthuc&id=<?php echo $id_monAn; ?>"><button>Xóa</button></a>
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
	<div class="col-sm-12" align="center" style="margin-top: 20px">
			<div class="pagination " align="center">
		 
	
			<?php
				// Phần hiển thị phân trang 
				// hiển thị phân trang 
				if($current_page > 1 && $total_page > 1){
					echo "<a href='danhsach_congthuc.php?page=1'> &laquo;</a>";
				}
				for($i = 1 ; $i <= $total_page; $i++){
					// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
					if($i == $current_page){
						echo "<a href='' class='active'>$i</a>";
					}else{
						echo " <a href='danhsach_congthuc.php?page=$i'>$i</a>";
					}
				} 
				if($current_page < $total_page && $total_page > 1){
					echo "<a href='danhsach_congthuc.php?page=$total_page'>&raquo;</a>";
				}
			?>
				</div>
			</div>
</body>
</html>