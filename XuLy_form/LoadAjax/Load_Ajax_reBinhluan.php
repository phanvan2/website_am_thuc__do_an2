
						<?php
							require_once '../Xuly_ketNoiSQL.php';
							$id_binhluan = $_GET['id'];
							$conn1 = new connectSQL ; // kết nối đến sql
							$conn1 -> setconnect();
							$conn = $conn1-> getconnect();
							$bang_reBinhluan = new bang($conn , 'tra_loi_binh_luan');
							$bang_reBinhluan->setResult_select("*" ,"idBinh_luan = $id_binhluan" , "ngay DESC");

							$ketqua_reBinhluan = $bang_reBinhluan->getResult_select();
							if (mysqli_num_rows($ketqua_reBinhluan) > 0){
							while($row_rebinhluan = mysqli_fetch_assoc($ketqua_reBinhluan)){
								$idUser1 = $row_rebinhluan['idUser'];
								$bang_user1 = new bang($conn, 'user');
								$bang_user1->setResult_select("ten , img_user" ," id='$idUser1'" , "id DESC");
								$ketqua_user1 = $bang_user1->getResult_select();
								$row1 = mysqli_fetch_assoc($ketqua_user1);
								$name_user1 = $row1['ten'];
								$img_user1 = $row1['img_user'] ;  
						?>
						<div class="binhluan">
							<img class="binhluan-img" src="image/img_user/<?php echo $img_user1 ; ?>" alt="đang load" width="3%" height="3%">
							<span class="binhluan-name"><?php echo $name_user1; ?></span>
							<span class="binhluan-ngay"><?php echo $row_rebinhluan['ngay']; ?></span>
							<p class="binhluan-detail"><?php echo $row_rebinhluan['noiDung']; ?></p>
						</div>
						<?php 
						 	}
						}else echo "Không có bình luân nào";
						?>	