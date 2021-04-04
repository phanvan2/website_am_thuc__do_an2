<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thanh toán</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<style>
		input{
			border:none;
			border-bottom-style: solid;
			border-bottom-width:  2px;
			outline: none;
		}
		input[type="submit"]{
			border-style: none;
			background-color:#ffcc00;
			width: 8%;
			border-radius:5px;
			height: 25px;
			font-family: sans-serif;
			font-weight: bold;	
		}
		.xac-nhan{
			margin-top:100px;
			border-style: solid;
			border-color: #000000;
			border-radius: 10px;
		}
		.table-xacnhan{
			border-color:#ffcc00;
		}
		.table-xacnhan thead{
			background-color:#ffcc00;
		}
		
	</style>
</head>
<body>
	<?php include ("menu.php"); ?>
	<?php 
		if(!isset($_COOKIE['user'])){
	        echo "<script> 
	                var s = confirm('Bạn cần đăng nhập để mua hàng');
	                if( s == true) location.replace('dangnhap.php');
	                else  history.back();
	            </script>";
	    }
	    $name_user = $_COOKIE['user'];
	    if(!isset($conn)){
			require 'XuLy_form/Xuly_ketNoiSQL.php'; 
			$conn1 = new connectSQL ; // kết nối đến sql
			$conn1 -> setconnect();
			$conn = $conn1-> getconnect();
		}
		$bang_user = new bang($conn ,'user') ; 
		$bang_user->setResult_select("*" , " ten = '$name_user' " , "id DESC"); 
		$row_user = mysqli_fetch_assoc($bang_user->getResult_select()); 
		$name_send = $row_user['ho_va_ten']; 
		$dia_chi = $row_user['dia_chi']; 
		$sdt = $row_user['sdt'] ; 

	?>
	<div class="container">
		<div class="col-sm-12 xac-nhan" align="center">
			<form action="XuLy_form/Xuly_thanhtoan.php?tong=<?php echo $_GET['tong']; ?>" method="POST">
			<h3>Thông tin đơn hàng</h3>
			<hr  style="border-color: #ffcc00; border-width: 1px; width: 50%; ">
			<div style="margin-top:10px; "></div>
			<div class="col-sm-6">
				<p class="col-sm-offset-4 col-sm-4 "><input type="text" placeholder="Người nhận" name="ten" value="<?php echo $name_send ; ?>"></p>
				<p class="col-sm-offset-4 col-sm-4"><input type="text" placeholder="Địa chỉ người nhận" name="diachi" value="<?php echo $dia_chi ; ?>"></p>
				<p class="col-sm-offset-4 col-sm-4"><input type="number" placeholder="Số điện thoại" name="sdt" value ="<?php echo $sdt; ?>"></p>
				<p class="col-sm-offset-4 col-sm-4"> 
					<select name="PT_thanhtoan" id="" >
						<option value="1">Tiền mặt</option>
						<option value="2">thẻ</option>
					</select>
				</p>
				<p class="col-sm-offset-4 col-sm-4"><label style="float: left ; " for="">Số lượng : </label><?php echo $_SESSION['tong']; ?></p>
				<p class="col-sm-offset-4 col-sm-4"><label style="float:left; " for="">Tổng tiền: </label><?php echo $_GET['tong']; ?></p>
				<p>
				
				</p>
			</div>
			<div class="col-sm-6">
				<?php
      		if(isset($_SESSION['tong'])){
      			foreach($_SESSION['cart'] as $key => $value){
					$item[] = $key;
				}
				if(isset($item)){
				$str = implode(",",$item);
				}
				
				
				$bang_sach = new bang($conn , 'sach');
				$bang_sach->setResult_select("*" ," id in ($str) " , "ngay_dang DESC");
				$ketqua_sach = $bang_sach->getResult_select(); 
				


      		?>
      		<input type="text" name="idSach" value="<?php echo $str; ?>" style="display: none;">
				<table class="table-xacnhan" border="1" >
					<thead>
						<tr>

							<th>Tên sách</th>
							<th>Tác giả</th>
							<th>Đơn giá(VNĐ)</th>
							<th>Số lượng</th>
							<th>Thành tiền(VNĐ)</th>
						</tr>
					</thead>
					<tbody>
								
		<?php
			$tong_thanh_toan = 0 ; 
			while($row_sach = mysqli_fetch_assoc($ketqua_sach)){
			
				$id_sach = $row_sach['id'];
				$soluong = $_SESSION['cart'][$id_sach];
				$thanh_tien = $row_sach['don_gia'] * $soluong; 
				$tong_thanh_toan += $thanh_tien; 
 		?>	
				<tr style="height: 30px;">
					<td><?php echo $row_sach['ten_sach'] ; ?></td>
					<td><?php echo $row_sach['tac_gia']; ?></td>
					<td align="center"><?php echo number_format($row_sach['don_gia']); ?></td>
					<td align="center"><?php echo $soluong; ?></td>
					<td align="center"><?php echo $thanh_tien; ?></td>
				</tr>
		<?php
			} 
		?>
					
					</tbody>
				</table>
					<?php
      		} 
      	?>
			</div>
			<div class="col-sm-12" style="margin-top:30px;">
				
			</div>
			<div class="col-sm-12" align="center">
				<input type="submit" value="Mua">
			</div>
			<div class="col-sm-12" style="height: 30px;"></div>
		</form>
			
		</div>
	</div>
</body>
</html>