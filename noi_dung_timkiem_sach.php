<?php
	if(isset($_GET['txt_tim'])){
	$txt_tim = $_GET['txt_tim']; 
	if(!isset($conn)){
		require 'XuLy_form/Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
	}
	
?>
<div class="col-sm-12" align="left">
				<h4>NỔI BẬT</h4>
				<hr  style="" width="50%"  >
				<h3>Kết quả tìm kiếm : <span style="font-color:#00ff00"><?php echo $txt_tim ; ?></span></h3>
</div>
<?php
				$bang_sach = new bang($conn , 'sach');
				$bang_sach->setResult_select("*" ," ten_sach LIKE '%$txt_tim%' OR don_gia LIKE '%$txt_tim%'" , "don_gia DESC ");
				$ketqua_sach = $bang_sach->getResult_select(); 
				if(mysqli_num_rows($ketqua_sach) > 0){
				?>
				<h3 class="col-sm-12" align="left">Số lượng tìm thấy : <span style="font-color:#00ff00"><?php echo mysqli_num_rows($ketqua_sach) ; ?></span></h3>

				<?php
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
			}else { ?>
			 <h3 class="col-sm-12" align="left">Số lượng tìm thấy : <span style="font-color:#00ff00"><?php echo mysqli_num_rows($ketqua_sach) ; ?></span></h3>
			
<?php
			 }
		}
			?>