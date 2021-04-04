	<hr width="70%" align="left">
<?php
	require_once '../Xuly_ketNoiSQL.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$idMon_an  = $_GET['id'];
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	// ------------lấy dữ liệu từ bảng bình luân ---------------
		$bang_binhluan = new bang($conn , 'binh_luan');
		$bang_binhluan->setResult_select("*" ," idMon_an = '$idMon_an'" , "ngay DESC");
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
								$bang_user1->setResult_select("ten ,img_user" ," id='$idUser'" , "id DESC");
								$ketqua_user1 = $bang_user1->getResult_select();
								$row1 = mysqli_fetch_assoc($ketqua_user1);
								$name_user1 = $row1['ten'];
								$img_user1 = $row1['img_user']  ; 

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

}
?>