<?php 
session_start(); 
$_SESSION['limit_sach'] = $_GET['limit'];
$limit = $_SESSION['limit_sach']; 
$sapxep = $_GET['sapxep']; 
if( $sapxep == 1) $dk = " don_gia DESC" ; 
else if($sapxep == 2 ) $dk = " don_gia ASC" ; 
	else if ($sapxep == 3 ) $dk = "ngay_dang DESC" ; 
		else if($sapxep == 4) $dk = " ngay_dang ASC "; 
?>

			<?php
			if(!isset($conn)){
				require_once '../Xuly_ketNoiSQL.php'; 
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
				$bang_sach->setResult_select("*" ,"1" , " $dk LIMIT $start, $limit");
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