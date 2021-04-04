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


			if(isset($_COOKIE['user'])){
				$ten_user = $_COOKIE['user']; // laáy tên user
				//--------------- Lấy id user 
				$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
				$bang_user->setResult_select("id" ," ten = '$ten_user'" , "id DESC");
				$ketqua_idUser = $bang_user->getResult_select();
				$row = mysqli_fetch_assoc($ketqua_idUser);
				$idUser  = $row['id'];
			}else $idUser = -1; 

				
				$bang_monAn = new bang($conn, 'mon_an');
				$bang_monAn->setResult_select("*" ," ten_monAn LIKE '%$txt_tim%' " , "id DESC");
				$ketqua_monAn_9 = $bang_monAn->getResult_select();
				while($row = mysqli_fetch_assoc($ketqua_monAn_9)){
					$bang_xem_sau = new bang($conn, 'xem_sau');
					$display_xem = "none";
					$display_boxem = "none";

					if(isset( $_COOKIE['user'])){
					$bang_xem_sau->setResult_select("id" , "idMon_an=".$row['id']." AND idUser= $idUser", "id DESC");
					$ketqua_xemsau = $bang_xem_sau->getResult_select();
					
						if(mysqli_num_rows($ketqua_xemsau) >0 ){
							$display_boxem = "inline-block";
						}else if(mysqli_num_rows($ketqua_xemsau) == 0 ) $display_xem = "inline-block";
					}
					
		?>
		<div class="col-sm-4">
			<div class=" card-sp">
				<div class="card-img-sp" style="width: 100%; height: 100%;">			
					<?php echo "<img class='card-img-sp' src='image/img_monAn/".$row['img']."' alt='' width='100%' height='100%'>"; ?>

				</div>
				<div class="card-detail-sp" align="center">
					<p class="card-name-sp"><?php echo $row['ten_monAn']; ?></p>
					<p><?php echo $row['moTa']; ?></p>
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
    					<input <?php echo "id='".$row['id']."'"; ?>name="check" type="checkbox"  />
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