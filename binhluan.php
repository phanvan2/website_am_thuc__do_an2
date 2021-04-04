<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="js/create_toggle.js"></script>
	<!-- //<script src="js/loadAjaxBinhluan.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		.txtBinhluan{
			border-radius: 10px; 
			width: 50%; 
			height: 35px; 
	
			border-style: solid ; 
			border-color:#dcdcdc;

		}

	</style>
</head>
<body>
	<script >
		$(document).ready(function(){
			$(".txtBinhluan").focus(function(event) {
				/* Act on the event */
				$(this).css({'box-shadow': '0px 20px 50px #D9DBDF'})  ;
			});
			$(".txtBinhluan").blur(function(event) {
				/* Act on the event */
				$(this).css({'box-shadow': 'none'})  ;
			});
		}); 
	</script>
	<script>
		<?php
			 if(!isset($conn)){
				require 'Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect(); 
			}
			if(isset($_COOKIE['user'])){
				$ten_user = $_COOKIE['user'] ; 
			}else $ten_user = "" ; 

			$bang_user = new bang($conn , "user") ; 
			$bang_user->setResult_select("trangthai " , " ten = '$ten_user'" , " id DESC ") ; 
			$row_user = mysqli_fetch_assoc($bang_user-> getResult_select()) ; 
			$trangthai_user = $row_user['trangthai'] ; 
		?>
// bình luận sản phẩm --------------------------------------
		$(document).ready(function(){
			$("#btn_gui_bl").click(function(){
		<?php
			if( $trangthai_user == 1) echo "alert('Bạn bị cấm bình luận'); " ; 
			else {
		?>
				var url_string = window.location.href; 
				var url = new URL(url_string);
				var id_mon_an = url.searchParams.get("id");
				
				var txt = $("#noidung_binhluan").val();
				document.getElementById("noidung_binhluan").value = " ";
				 $.post("XuLy_form/Xuly_binhluan.php?id_monAn="+id_mon_an , {binhluan: txt, id_monAn: id_mon_an}, function(result){
    			 //$("#dsbinhluan").append("<br>"+ txt);
    			  $("#load_binhluan").load("XuLy_form/LoadAjax/Load_Ajax_binhluan.php?id="+id_mon_an);

    			  
  				});
		<?php 
			} 
		?>
			});
		});
// rep lại bình luận -----------------------------
		function gui_re_binhluan(id_bl ){
			var txt = $("#input_re_bl"+id_bl).val();
			document.getElementById("input_re_bl"+id_bl).value = " ";
		<?php
			if( $trangthai_user == 1) echo "alert('Bạn bị cấm bình luận'); " ; 
			else {
		?>	
			$.post("XuLy_form/Xuly_re_binhluan.php" , {binhluan: txt, id_binhluan: id_bl}, function(result){
    			 //$("#dsbinhluan").append("<br>"+ txt);
    			$("#view"+id_bl).load("XuLy_form/LoadAjax/Load_Ajax_rebinhluan.php?id="+id_bl);
			});
		<?php 
			} 
		?>
		}
	</script>
	<?php 
		// lấy id món ăn từ trang san phẩm ---------------------------
		$id_monAn = $_GET['id']; 
	?>
	<div class="row binh-luan">
			<h4>BÌNH LUẬN</h4>
			
				<textarea name="binhluan" id="noidung_binhluan" cols="70" rows="10" placeholder="Mời bạn để lại bình luận"></textarea>
				<button type="" id="btn_gui_bl">Gửi</button>
				<hr width="70%" align="left">
				<div id="load_binhluan">

					<hr width="70%" align="left">
<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$idMon_an  = $_GET['id'];
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	// ------------lấy dữ liệu từ bảng bình luân ---------------
		$bang_binhluan = new bang($conn , 'binh_luan');
		$bang_binhluan->setResult_select("*" ," idMon_an = '$idMon_an'" , "ngay DESC");
		$ketqua_binhluan = $bang_binhluan->getResult_select();
		if(mysqli_num_rows($ketqua_binhluan) > 0 ) {
		while($row_binhluan = mysqli_fetch_assoc($ketqua_binhluan)){
			$id_binhluan = $row_binhluan['id'];
			$idUser = $row_binhluan['idUser'];
		//	$bang_user = new bang($conn, 'user');
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
						<img class="binhluan-img" src="image/img_user/<?php echo $img_user; ?>" alt="" width="3%" height="3%">
						<span class="binhluan-name"><?php echo $name_user; ?></span>
						<span class="binhluan-ngay"><?php echo $row_binhluan['ngay']; ?></span>
						<p class="binhluan-detail"><?php echo $row_binhluan['noiDung']; ?> </p>
						<span class="btn binhluan-btn-traloi"  <?php echo $onclick_reply;?> >Trả lời</span> 
						<span class="btn fas fa-angle-down binhluan-btn-down" <?php echo $onclick_view ; ?> >
							
						</span>
					</div>
		<!-- 	input tra loi bình luận ============---------------- -->
					<div class="re_binhluan" <?php echo "id='traloi$id_binhluan'"; ?> style="display:none;" >
						<input type="text" class="txtBinhluan" <?php echo "id='input_re_bl$id_binhluan'"; ?> placeholder="Nhập bình luận của bạn tại đây">
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
								$bang_user1->setResult_select("ten, img_user" ," id='$idUser1'" , "id DESC");
								$ketqua_user1 = $bang_user1->getResult_select();
								$row1 = mysqli_fetch_assoc($ketqua_user1);
								$name_user1 = $row1['ten'];
								$img_user1 = $row1['img_user'] ; 

						?>
						<div class="binhluan">
							<img class="binhluan-img" src="image/img_user/<?php echo $img_user1; ?>" alt="đang load" width="3%" height="3%">
							<span class="binhluan-name"><?php echo $name_user1; ?></span>
							<span class="binhluan-ngay"><?php echo $row_rebinhluan['ngay']; ?></span>
							<p class="binhluan-detail"><?php echo $row_rebinhluan['noiDung']; ?></p>
						</div>
						<?php 
						 	}
						}else echo "Hiện không có bất cứ bình luận nào";
						?>	
					</div>
		<!---- ===================-->
					<hr width="20%" align="left">

				</div>
<?php
	} 

} else echo "Hiện chưa có bất cứ bình luận nào về món ăn này";

}
?>
			</div>
		</div>
</body>
</html>