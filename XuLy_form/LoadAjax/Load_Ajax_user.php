<link rel="stylesheet" href="">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">

	<link rel="stylesheet" href="../../css/menu.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="../../css/bang.css">
<link rel="stylesheet" href="../../css/phan_trang.css">
<?php
		if(!isset($conn)){
		require '../Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		} 
		if(isset($_SESSION['limit_user'])){
			$limit = $_SESSION['limit_user'];
		}else{
			$limit = 5;
		}
		$bang_user =  new bang($conn , 'user');
		$bang_user->setResult_select(" count(id) as total " ," 1 " , "id DESC");
		$ketqua_user = $bang_user->getResult_select();
		$row_user = mysqli_fetch_assoc($ketqua_user);
		$total_records = $row_user['total'];
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
			<div class="col-sm-offset-3 col-sm-6">
				<table class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
			      <thead class="thead-dark" style="background-color: #ffcc00; ">
			         <tr>
			            <th>STT</th>
			            <th>Tên người dùng</th>
			            <th>Email</th>
			            <th></th>
			            <th></th>
			         </tr>
			      </thead>
			      <tbody>
			      	<?php
			  
						$bang_user->setResult_select(" * " ," 1 " , "id ASC LIMIT $start, $limit");
						$ketqua_user = $bang_user->getResult_select();
						$stt = 0 ; 
						while ($row_user = mysqli_fetch_assoc($ketqua_user)){
							$stt ++ ; 
						
			      	?>
			         <tr>
			            <td><?php echo $stt; ?></td>
			            <td><?php echo $row_user['ten']; ?></td>
			            <td><?php echo $row_user['email']; ?>t</td>
			            <?php 
			            	if($row_user['trangthai'] == 0){
			            ?>
			           	<td><button>Khóa</button></td>
			            <?php
			            	}else if($row_user['trangthai'] == 1){
			            ?>
						<td><button>Mở</button></td>
			            <?php
			            	}
			            ?>
			         	
			         	<td><button>Xóa tài khoản</button></td>
			         </tr>
			        <?php 
			    		}
			    	?>
			      </tbody>
   				</table>
					<div class="col-sm-12" align="center" style="margin-top: 20px">
						<div class="pagination " align="center">
					 
				
						<?php
							// Phần hiển thị phân trang 
							// hiển thị phân trang 
							if($current_page > 1 && $total_page > 1){
								echo "<a href='danh_sach_user.php?page=1'> &laquo;</a>";
							}
							for($i = 1 ; $i <= $total_page; $i++){
								// nếu là trang hiện tại thì hiện thị thẻ span ngược lại hiển thị thẻ a 
								if($i == $current_page){
									echo "<a href='' class='active'>$i</a>";
								}else{
									echo " <a href='danh_sach_user.php?page=$i'>$i</a>";
								}
							} 
							if($current_page < $total_page && $total_page > 1){
								echo "<a href='danh_sach_user.php?page=$total_page'>&raquo;</a>";
							}
						?>
						</div>
					</div>
			</div>	
		</div>
	</div>