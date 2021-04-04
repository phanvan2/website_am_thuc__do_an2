<?php

	if(isset($_GET['id_danhmuc'])){
	$id_danhmuc = $_GET['id_danhmuc']; 
	if(!isset($conn)){
		require 'XuLy_form/Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
	}
	$bang_danhmuc1 = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
	$bang_danhmuc1->setResult_select("* " ," id = $id_danhmuc " , "id DESC");
	$ketqua_danhmuc1 = $bang_danhmuc1->getResult_select();
	$row_danhmuc1 = mysqli_fetch_assoc($ketqua_danhmuc1);
?>
			<div class="col-sm-12" align="left">
				<h4>NỔI BẬT</h4>
				<hr class="col-sm-12"  style="" width="50%">
				<div class="col-sm-12">
					<h5 class="col-sm-6">Hiển thị danh mục : 
						<span style="color:#ff0000">	 
				 			<?php echo $row_danhmuc1['tenDanhmuc']; ?>	
						</span>
					</h5>
					
		<?php
		// Tinh gioi hạn  so san pham hien thi 
		$bang_monAn = new bang($conn, 'mon_an');
		$bang_monAn->setResult_select(" count(id) as total " ," idDanhmuc = $id_danhmuc" , "id DESC");
		$ketqua_monAn1 = $bang_monAn->getResult_select();
		
		$row_monAn1 = mysqli_fetch_assoc($ketqua_monAn1);
		$total_records = $row_monAn1['total'];
	 // Tìm limit và current page
		$current_page =  isset($_GET['page']) ? $_GET['page'] : 1 ;

		if(isset($_SESSION['limit'])){
			$limit = $_SESSION['limit'];
		}else{
			$limit = 6 ;
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

		if(isset($_COOKIE['user'])){
			$ten_user = $_COOKIE['user']; // laáy tên user
				//--------------- Lấy id user 
			$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
			$bang_user->setResult_select("id" ," ten = '$ten_user'   " , " id DESC ");
			$ketqua_idUser = $bang_user->getResult_select();
			$row = mysqli_fetch_assoc($ketqua_idUser);
			$idUser  = $row['id'];
			}else $idUser = -1; 

				
				$bang_monAn = new bang($conn, 'mon_an');
				$bang_monAn->setResult_select("*" ," idDanhmuc = $id_danhmuc" , "id DESC LIMIT $start, $limit");
				$ketqua_monAn_9 = $bang_monAn->getResult_select();
		?>
<!-- ======================= -->
					<h5 class="col-sm-6">Số lượng tìm thấy:
						<span style="color:#00ff00">
							<?php echo $total_records; ?>
						</span>

					</h5>
				</div>
				
			</div>
<!-- -========================== -->
		<?php 
				while($row = mysqli_fetch_assoc($ketqua_monAn_9)){
					$bang_xem_sau = new bang($conn, 'xem_sau');
					$display_xem = "none";
					$display_boxem = "none";
					$check_yeuthich = " " ; 
					$mota = $row['moTa'] ; 
					$length =  strlen($mota)  ; 
					$k = "" ;
					if( $length > 160 ) {
						$mota  = substr( $mota,  0, 160 )."..." ; 
						$k = strripos($mota, ' ') ; 
						$mota  = substr( $mota,  0, $k )."..." ; 
					}

					if(isset( $_COOKIE['user'])){
					$bang_xem_sau->setResult_select("id" , "idMon_an=".$row['id']." AND idUser= $idUser", "id DESC");
					$ketqua_xemsau = $bang_xem_sau->getResult_select();
					
						if(mysqli_num_rows($ketqua_xemsau) >0 ){
							$display_boxem = "inline-block";
						}else if(mysqli_num_rows($ketqua_xemsau) == 0 ) $display_xem = "inline-block";
						$bang_yeu_thich = new bang($conn , 'yeu_thich') ; 
						$bang_yeu_thich-> setResult_select(" id " , " idUser = $idUser AND idMon_an=".$row['id']." " , " id DESC")  ; 
						if( mysqli_num_rows($bang_yeu_thich->getResult_select()) > 0 )
								$check_yeuthich = "checked" ; 
					}
					
		?>
		<div class="col-sm-4">
			<div class=" card-sp">
				<div class="card-img-sp" style="width: 100%; height: 100%;">			
					<?php echo "<img class='card-img-sp' src='image/img_monAn/".$row['img']."' alt='' width='100%' height='100%'>"; ?>

				</div>
				<div class="card-detail-sp" align="center">
					<p class="card-name-sp"><?php echo $row['ten_monAn']; ?></p>
					<p><?php echo $mota; ?></p>
				</div>
				<div class="card-footer-sp">
					<a <?php echo "href='sanpham.php?id=".$row['id']."'";  ?> >
						<button <?php echo "id='xemthem".$row['id']."'"; ?> >
							Xem thêm	
						</button>
					</a>
					<button onclick="btn_xemsau(<?php echo $row['id']; ?>) " style="display:<?php echo  $display_xem; ?> ;  margin-left:5px;" <?php echo "id='btn1".$row['id']."'"; ?> >
						Xem sau
					</button>
					<button onclick="btn_bo_xemsau(<?php echo $row['id'] ; ?>)" <?php echo "id='btn12".$row['id']."'" ; ?>  style="display:<?php echo  $display_boxem; ?> ;  margin-left:5px;" >
						Bỏ xem
					</button>
					<div class="mt-heart-indigo" style="font-size: 8px; float: right"> 
    					<input <?php echo "id='".$row['id']."'"; ?>name="check" type="checkbox"  <?php echo $check_yeuthich ; ?> onclick="yeu_thich(<?php echo $row['id'] ; ?>) " />
    					<label <?php echo "for='".$row['id']."'"; ?> ></label>  
    				</div>
				</div>
				<div style="height: 10px;">
					
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
					echo "<a href='danhmuc_index.php?id_danhmuc=".$id_danhmuc."&page=1'> &laquo;</a>";
				}
				for($i = 1 ; $i <= $total_page; $i++){
					// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
					if($i == $current_page){
						echo "<a href='' class='active'>$i</a>";
					}else{
						echo " <a href='danhmuc_index.php?id_danhmuc=".$id_danhmuc."&page=$i'>$i</a>";
					}
				} 
				if($current_page < $total_page && $total_page > 1){
					echo "<a href='danhmuc_index.php?id_danhmuc=".$id_danhmuc."&page=$total_page'>&raquo;</a>";
				}
			?>
				</div>
			</div>