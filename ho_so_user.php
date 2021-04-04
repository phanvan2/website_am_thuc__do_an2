<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style >
		.container-body{
			margin-top : 130px;
			
		}
		.card-capNhat{
			background-color: #ffffff;
			border-style: solid;
			border-radius: 10px; 
			border-color: #dcdcdc; 
		}
		.card-thongtin{
			background-color: #ffffff;
			border-style: solid;
			border-radius: 10px; 
			border-color: #dcdcdc; 
			margin-left: 40px; 
		}
		input{
			border-style:solid;
			border-radius: 5px; 
			border-color: #dcdcdc; 
			height: 40px ; 
			width: 100% ; 
		}
		label{
			color:#9a9a9a;
		}
		select{
			border-style:solid;
			border-radius: 5px; 
			border-color: #dcdcdc; 
			height: 40px ; 
			width: 100% ; 
		}
		.card-img{
			margin-top: -15%; 
		}
		.card-share a i{
			font-size: 20px; 
			color:#9a9a9a;
		}
		.card-detail h5{
			margin-top: 10%; 
			color: #1dc7ea ;
			font-size: 28px; 
		}
		.card-detail p.name{
			font-size: 18px; 
			color:#9a9a9a;
		}
		.btn-capnhat{
			border-style: none ;
			border-radius: 5px;  
			width: 20%; 
			height: 40px ; 
			color: #ffffff;
			font-size: 18px; 
			background-color: #1dc7ea; 
		}
	</style>
</head>
<body style="background-color: #dcdcdc">
	<?php include 'menu.php' ; ?>
	<?php
		if(!isset($_COOKIE['quyen']))
			echo "<script> location.replace('index.php'); </script>";	

		$ten_user = $_COOKIE['user']; // laáy tên user
//--------------- Lấy id user 
		$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
		$bang_user->setResult_select(" * " ," ten = '$ten_user'" , "id DESC");
		$ketqua_idUser = $bang_user->getResult_select();
		$row = mysqli_fetch_assoc($ketqua_idUser);
		$idUser  = $row['id'];
		$ten_user = $row['ten'];
		$dia_chi = $row['dia_chi'] ; 
		if($row['ho_va_ten'] == ""){
			$full_ten = "";
		} else $full_ten = $row['ho_va_ten']; 
		
		$about = $row['about'];
		// lấy quyền 
		if($_COOKIE['quyen'] == 2) {
			$quyen = "Người quản trị ";
		}else $quyen = "Khách hàng ";
		$gioi_tinh = $row['gioi_tinh'];
		$sdt = $row['sdt'] ; 
		$email = $row['email']; 
		if ( $row['img_user'] == ""){
			$img_user = "user_default.jpg" ; 
		}else $img_user = $row['img_user'] ; 

	?>
	<div class="container container-body" >
		<div class="row">
		  <form action="XuLy_form/Xuly_updateUser.php" method="POST"  enctype="multipart/form-data">
			<div class="col-sm-7 card-capNhat" style="height: auto;  ">
				<h3>Cập nhật thông tin</h3>
				<div class="col-sm-6 form-group" >
					<label for="">Tên đăng nhập :</label>
					<input type="text" placeholder="Nhập tên đăng nhập của bạn " name="ten" value="<?php echo $ten_user ; ?>">
				</div>
				<div class="col-sm-6 form-group" >
					<label for="">Số điện thoại  :</label>
					<input type="number" placeholder="Nhập số điện thoại của bạn " name="sdt" value="<?php echo $sdt; ?>">
				</div>
				<div class="col-sm-8 form-group" >
					<label for="">Họ và tên:</label>
					<input type="text" placeholder="Nhập tên  của bạn " name="ho_ten" value="<?php echo $full_ten; ?>">
				</div>
				<div class="col-sm-4 form-group" >
					<label for="">Giới tính  :</label>
					<select name="gioi_tinh" id="">
						<?php
							if($gioi_tinh == '0' ){


						?>
						<option value="0" selected></option>
						<option value="Nam" >Nam</option>
						<option value="Nữ">Nữ</option>
						
						<?php 
							}else if( $gioi_tinh == 'Nam')  {
						?>
						<option value="0"></option>
						<option value="Nam" selected>Nam</option>
						<option value="Nữ">Nữ</option>
						
						<?php 
							}else if( $gioi_tinh == 'Nữ')  {
						?>
						<option value="0"></option>
						<option value="Nam" >Nam</option>
						<option value="Nữ" selected>Nữ</option>
					<?php }?>
					</select>
				</div>
				<div class="col-sm-12 form-group" >
					<label for="">Email :</label>
					<input type="text" placeholder="Nhập Email của bạn " name="email" value="<?php echo $email ; ?>">
				</div>
				<div class="col-sm-12 form-group" >
					<label for="">Địa chỉ :</label>
					<input type="text" placeholder="Nhập Địa chỉ của bạn " name="dia_chi" value="<?php echo $dia_chi; ?>">
				</div>
				<div class="col-sm-6 form-group" >
					<label for="">facebook :</label>
					<input type="text" placeholder="Đường dẫn đến facbook của bạn " name="link_fb">
				</div>
				<div class="col-sm-6 form-group" >
					<label for="">Youtube :</label>
					<input type="text" placeholder="Đường dẫn đến YouTube của bạn " name="link_ytb">
				</div>
				<div class="col-sm-12 form-group" >
					<label for="">Giới thiệu về tôi :</label>
					<input type="text" placeholder=" " value="<?php echo $about ; ?>" name="about">
				</div>
				<div class="col-sm-12 form-group" >
					<label for="">Cập nhật lại ảnh đại diện:</label>
					<input type="file" class="form-control" name="file_img">
				</div>
				<div class="col-sm-12 form-group" align="right">
					<button class="btn-capnhat" type="submit">Cập nhật</button>
				</div>
			</div>
		  </form>
			<div class="col-sm-4 card-thongtin" style="height: auto; ">
				<div class="card-img" align="center">
					<img class="img-user-menu img-circle" src="image/img_user/<?php echo $img_user; ?>" alt="" width="30%" height="30%">
				</div>
				<div class="card-detail" align="center">
					<h5><?php echo $_COOKIE['user'] ; ?></h5>
					<p class="name"><?php echo $full_ten ; ?></p>
					<p style="color: #9a9a9a; "><?php echo $quyen ; ?> </p>
					<p style="margin-top: 10%;" ><?php echo $about ; ?> </p>
					<p>Công thức đã đăng : 12</p>

				</div>
				<hr >
				<div class="card-share" align="center">
					<div class="col-sm-12" >
						<a class=" col-sm-2 col-sm-offset-3" href=""><i class="fab fa-facebook-square icon-MXH-footer"></i></a>
						<a class=" col-sm-2 " href=""><i class="fab icon-MXH-footer fa-twitter"></i></a>
						<a class="col-sm-2 " href=""><i class="fab icon-MXH-footer fa-youtube"></i></a>
					</div>
					<div class="col-sm-12" style="height: 20px ; ">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>