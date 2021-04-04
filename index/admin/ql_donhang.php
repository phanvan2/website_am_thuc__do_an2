<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giỏ hàng</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/giohang.css">
	<script src="js/xuly_trangThai_hoadon.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<style>
		
	</style>
</head>
<body>
	<script>
		var a = [];
	</script>
	<?php include("menu.php"); ?>

	
	<div style="margin-top:130px;">
<div class="container">
  
  <h1>Giỏ hàng</h1>

  <div class="tabs">
   
    <div class="tabby-tab">
      <input type="radio" id="tab-2" name="tabby-tabs" checked>
      <label for="tab-2">Đang giao</label>
      <div class="tabby-content">
        
		<?php
			if(isset($_COOKIE['user']) ){
				$ten = $_COOKIE['user']; 
				$bang_user = new bang($conn , 'user');
/* */			$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
				$ketqua_idUser = $bang_user->getResult_select();
				$row_User = mysqli_fetch_assoc($ketqua_idUser);

				$idUser = $row_User['id'];	
			
				$bang_hoadon = new bang($conn , 'hoadon');
				$bang_hoadon->setResult_select(" * " ,"  tinh_trang = '0' " , " id DESC");
				$kq_hoadon = $bang_hoadon->getResult_select();
				if(mysqli_num_rows($kq_hoadon)> 0){
					$stt = 0 ;
		?>
			<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Người nhận</th>
					<th>Số điện thoại</th>
					<th>Ngày đặt</th>
					<th>Trạng thái đơn hàng</th>
					<th>Địa chỉ người nhận</th>
					<th>Phương thức thanh toán</th>
					<th>Giá</th>
					<th></th>
					<!-- <th></th> -->
				</tr>
			</thead>
			<tbody>
		<?php
					while($row_hoadon = mysqli_fetch_assoc($kq_hoadon)){
						$stt ++ ; 
						$id_hoadon = $row_hoadon['id'];
				?>
				<tr>
					<td><?php echo $stt;?></td>
					<td><?php echo $row_hoadon['ten_gui']; ?></td>
					<td><?php echo $row_hoadon['sdt_gui']; ?></td>
					<td><?php echo $row_hoadon['ngay_Dat']; ?></td>
					<td>Đang giao</td>
					<td><?php echo $row_hoadon['dia_chi']; ?></td>
					<td><?php echo $row_hoadon['pt_thanhtoan']; ?></td>
					<td><?php echo $row_hoadon['tong_tien']; ?></td>
					<td><a href="hoadon.php?id_hoadon1=<?php echo $id_hoadon; ?>">Chi tiết</a></td>
					<!-- <td><button onclick="update(<?php echo $id_hoadon; ?>)">Đã nhận được</button></td> -->
				</tr>
				<?php 
					}
				?>
				</tbody>
			</table>
				<?php 

				}else {
				?>
			
		        	<img src="image/Logo_error.png">
		        	<p>Bạn không sản phầm nào đang giao.</p>
		      	
				<?php 

				}
		}else{
		?>
			
	        	<img src="image/Logo_error.png">
	        	<p>Bạn cần đăng nhập để xem các sản phẩm đang giao.</p>
	      
		<?php
		}
 
		?>	



      </div>
    </div>

    <div class="tabby-tab">
      	<input type="radio" id="tab-3" name="tabby-tabs">
      	<label for="tab-3">Lịch sử</label>
       	<div class="tabby-content">
       		<?php
			if(isset($_COOKIE['user']) ){
				$ten = $_COOKIE['user']; 
				$bang_user = new bang($conn , 'user');
/* */			$bang_user->setResult_select("id" ," ten = '$ten'" , "id DESC");
				$ketqua_idUser = $bang_user->getResult_select();
				$row_User = mysqli_fetch_assoc($ketqua_idUser);

				$idUser = $row_User['id'];	
			
				$bang_hoadon = new bang($conn , 'hoadon');
				$bang_hoadon->setResult_select(" * " ,"  tinh_trang = '1' " , " id DESC");
				$kq_hoadon = $bang_hoadon->getResult_select();
				if(mysqli_num_rows($kq_hoadon)> 0){
					$stt = 0 ;
		?>
			<table class="GeneratedTable" align="center" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Người nhận</th>
					<th>Số điện thoại</th>
					<th>Ngày đặt</th>
					<th>Trạng thái đơn hàng</th>
					<th>Địa chỉ người nhận</th>
					<th>Phương thức thanh toán</th>
					<th>Giá</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
		<?php
					while($row_hoadon = mysqli_fetch_assoc($kq_hoadon)){
						$stt ++ ; 
						$id_hoadon = $row_hoadon['id'];
				?>
				<tr>
					<td><?php echo $stt;?></td>
					<td><?php echo $row_hoadon['ten_gui']; ?></td>
					<td><?php echo $row_hoadon['sdt_gui']; ?></td>
					<td><?php echo $row_hoadon['ngay_Dat']; ?></td>
					<td>Đang giao</td>
					<td><?php echo $row_hoadon['dia_chi']; ?></td>
					<td><?php echo $row_hoadon['pt_thanhtoan']; ?></td>
					<td><?php echo $row_hoadon['tong_tien']; ?></td>
					<td><a href="hoadon.php?id_hoadon1=<?php echo $id_hoadon; ?>">Chi tiết</a></td>
				</tr>
				<?php 
					}
				?>
				</tbody>
			</table>
				<?php 

				}else {
				?>
			
		        	<img src="image/Logo_error.png">
		        	<p>Bạn không có lịch sử sản phẩm nào .</p>
		      	
				<?php 

				}
		}else{
		?>
			
	        	<img src="image/Logo_error.png">
	        	<p>Bạn cần đăng nhập để xem lịch sử mua hàng.</p>
	      
		<?php
		}
 
		?>	
      	</div>
    </div>


    
  </div>
	</div>
	<?php include("footer.php"); ?>		
	<script>
		function sua_gio_hang(id){
			var s  = 0 ;
			var tong_menu = 0 ;
			var sl_input_id = "sl_input"+id;
			// lấy số lượng sách đã thay đổi 

			var sl_sach = document.getElementById(sl_input_id).value;
			setSessionSoluong(id , sl_sach); 

			a.forEach(myFunction);
				function  myFunction(item, index){
			
			var str = "sl_input"+index; // lấy id số lượng 
			var str1 = "thanhtien"+index; 
			var soluong = document.getElementById(str).value; // lấy số lượng mỗi sản phẩm 
			tong_menu += parseInt(soluong,10); 
				var j = ( soluong * item);
				// display tổng tiền cho mỗi sản phẩm 
				document.getElementById(str1).innerHTML = j;
				s = s +j ;
			
			document.getElementById('tong').innerHTML = s;
			}
		setSessionTong(tong_menu);

		}
		function setSessionSoluong(id_sach , soluong_sach){

			$.get("XuLy_form/setSoluong.php" , {id : id_sach , soluong : soluong_sach} , function(result){
				
			});
		}
		function setSessionTong(tong_menu){
			$.get("XuLy_form/setTong_giohang.php" , {tong : tong_menu}, function(result){
				//set lại trị giỏ hàng lại trên thanh menu 
				document.getElementById('tong_cart').innerHTML  = tong_menu;
			});
		}
	</script>				
</body>
</html>