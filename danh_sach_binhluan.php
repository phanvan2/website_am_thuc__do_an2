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
</head>
<body>
	<?php include_once('menu.php'); ?>
	<?php
		if(isset($_COOKIE['quyen']))
		if($_COOKIE['quyen'] != 2)  echo "<script>
			location.replace('index.php');
			</script>"; // ngươi quản trị
		if(!isset($conn)){
			require 'XuLy_form/Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
		if(isset($_SESSION['limit_binhluan'])){
			$limit = $_SESSION['limit_binhluan'];
		}else{
			$limit = 5;
		}
		$bang_binhluan =  new bang($conn , 'binh_luan');
		$bang_binhluan->setResult_select(" count(id) as total " ," 1 " , "id DESC");
		$ketqua_binhluan = $bang_binhluan->getResult_select();
		$row_binhluan = mysqli_fetch_assoc($ketqua_binhluan);
		$total_records = $row_binhluan['total'];
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
	?>
	<div class="container" style="margin-top: 100px;">
		<div class="row">
			<div class="col-sm-offset-2 col-sm-8">
				<h3>Danh sách người dùng: </h3>
			</div>
			<div class="col-sm-12">
<?php
				$bang_binhluan = new bang($conn , 'binh_luan');
				$bang_binhluan->setResult_select("*" ," 1" , "ngay DESC LIMIT $start, $limit");
				$ketqua_binhluan = $bang_binhluan->getResult_select();
				while($row_binhluan = mysqli_fetch_assoc($ketqua_binhluan)){
					$id_binhluan = $row_binhluan['id'];
					$idUser = $row_binhluan['idUser'];
					$bang_user = new bang($conn, 'user');
					$bang_user->setResult_select("ten , img_user" ," id='$idUser'" , "id DESC");
					$ketqua_user = $bang_user->getResult_select();
					$row = mysqli_fetch_assoc($ketqua_user);
					$name_user = $row['ten'];
					$img_user = $row['img_user'] ; 
					$toggle_view = "toggle1('btn', 'view$id_binhluan')";
					$onclick_view = 'onclick="'.$toggle_view.'"';
					$toggle_reply = "toggle1('btn', 'traloi$id_binhluan')";
					$onclick_reply = 'onclick="'.$toggle_reply.'"';
					$function_re_binhluan = "gui_re_binhluan('$id_binhluan')";
					$onclick_re_binhluan = 'onclick="'.$function_re_binhluan.'"';
?>
			
				<div class="col-sm-12 ">
					<div class="binhluan">
						<img class="binhluan-img" src="image/img_user/<?php echo $img_user ; ?>" alt="" width="3%" height="3%">
						<span class="binhluan-name"><?php echo $name_user; ?></span>
						<span class="binhluan-ngay"><?php echo $row_binhluan['ngay']; ?></span>
						<p class="binhluan-detail"><?php echo $row_binhluan['noiDung']; ?> </p>
						<span class="btn binhluan-btn-traloi"  <?php echo $onclick_reply;?> >Trả lời</span> 
						<span class="btn fas fa-angle-down binhluan-btn-down" <?php echo $onclick_view ; ?> >
							
						</span>
					</div>
		<!-- 	input tra loi bình luận ============---------------- -->
					<div class="re_binhluan" <?php echo "id='traloi$id_binhluan'"; ?> style="display:none;" >
						<input type="text" <?php echo "id='input_re_bl$id_binhluan'"; ?> placeholder="Nhập bình luận của bạn tại đây">
						<button class="re_btn" <?php echo $onclick_re_binhluan; ?> >Gửi</button>
					</div>
		<!-- ===============-->
	<!-- xem các trả lời bình luân =============------------------------>
					<div class="traloi" <?php echo "id='view$id_binhluan'"; ?> style="display:none;" >
						<?php
							$bang_reBinhluan = new bang($conn , 'tra_loi_binh_luan');
							$bang_reBinhluan->setResult_select("*" ,"idBinh_luan = $id_binhluan" , "ngay DESC");

							$ketqua_reBinhluan = $bang_reBinhluan->getResult_select();
							if (mysqli_num_rows($ketqua_reBinhluan) > 0){
							while($row_rebinhluan = mysqli_fetch_assoc($ketqua_reBinhluan)){
								$idUser1 = $row_rebinhluan['idUser'];
								$bang_user1 = new bang($conn, 'user');
								$bang_user1->setResult_select("ten , img_user" ," id='$idUser'" , "id DESC");
								$ketqua_user1 = $bang_user1->getResult_select();
								$row1 = mysqli_fetch_assoc($ketqua_user1);
								$name_user1 = $row1['ten'];
								$img_user1 = $row1['img_user1'] ; 
						?>
						<div class="binhluan">
							<img class="binhluan-img" src="image/img_user/<?php echo $img_user1 ; ?>" alt="đang load" width="3%" height="3%">
							<span class="binhluan-name"><?php echo $name_user1; ?></span>
							<span class="binhluan-ngay"><?php echo $row_rebinhluan['ngay']; ?></span>
							<p class="binhluan-detail"><?php echo $row_rebinhluan['noiDung']; ?></p>
						</div>
						<?php 
						 	}
						}else echo "Hiện Không có bất cứ bình luân nào ";
						?>	
				</div>
		<!---- ===================-->
					<hr width="20%" align="left">

			</div>
<?php
	}
?>
				<div class="col-sm-12" align="center" style="margin-top: 20px">
					<div class="pagination " align="center">
				 
			
					<?php
						// Phần hiển thị phân trang 
						// hiển thị phân trang 
						if($current_page > 1 && $total_page > 1){
							echo "<a href='danh_sach_binhluan.php?page=1'> &laquo;</a>";
						}
						for($i = 1 ; $i <= $total_page; $i++){
							// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
							if($i == $current_page){
								echo "<a href='' class='active'>$i</a>";
							}else{
								echo " <a href='danh_sach_binhluan.php?page=$i'>$i</a>";
							}
						} 
						if($current_page < $total_page && $total_page > 1){
							echo "<a href='danh_sach_binhluan.php?page=$total_page'>&raquo;</a>";
						}
					?>
					</div>
				</div>
			</div>	
		</div>
	</div>
		<script>
			$(document).ready(function(){
				$("#btn_gui_bl").click(function(){
					var url_string = window.location.href; 
					var url = new URL(url_string);
					var id_mon_an = url.searchParams.get("id");
					
					var txt = $("#noidung_binhluan").val();
					document.getElementById("noidung_binhluan").value = " ";
					 $.post("XuLy_form/Xuly_binhluan.php?id_monAn="+id_mon_an , {binhluan: txt, id_monAn: id_mon_an}, function(result){
	    			 //$("#dsbinhluan").append("<br>"+ txt);
	    			  $("#load_binhluan").load("XuLy_form/LoadAjax/Load_Ajax_binhluan.php?id="+id_mon_an);

	    			  
	  				});
				});
			});
			function gui_re_binhluan(id_bl ){
				var txt = $("#input_re_bl"+id_bl).val();
				alert(txt);
				$.post("XuLy_form/Xuly_re_binhluan.php" , {binhluan: txt, id_binhluan: id_bl}, function(result){
	    			 //$("#dsbinhluan").append("<br>"+ txt);
	    			$("#view"+id_bl).load("XuLy_form/LoadAjax/Load_Ajax_rebinhluan.php?id="+id_bl);
				});
			}
		</script>
</body>
</html>