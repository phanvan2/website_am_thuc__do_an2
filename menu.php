<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Menu</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">

	<link rel="stylesheet" href="css/menu.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
	
</style>
</head>
<body>
	<?php
		require 'XuLy_form/Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
		if ( isset($_COOKIE['user']))
		{
			$user1 = $_COOKIE['user'] ; 
			$bang_user = new bang($conn, "user") ; 
			$bang_user->setResult_select("*" , " ten = '$user1' " , "id DESC ") ; 
			$row_user = mysqli_fetch_assoc($bang_user->getResult_select()) ; 
			$img_user = $row_user['img_user']  ; 
		}else $img_user = "user_default.jpg";
		
	?>
	<script>
		$(document).ready(function(){
			  $(".btn-bar-menu").click(function(){
			    $("#wrapper").slideToggle("slow");
			  });
			});


	</script>
	<div class="container-fluid header-menu" >
		<div class="row">
			<div class="col-2" >
				<div id="wrapper"  >
			        <!-- Sidebar -->
			        <div id="sidebar-wrapper">
			            <ul class="sidebar-nav">
			                <li class="sidebar-brand">
			                </li>
			                <li>
			                    <div class="user-menu" align="center">
			                    	<img class="img-user-menu img-circle" src="image/img_user/<?php echo $img_user; ?>" alt="" width="25%" height="25%">
			                    	<p class="name-user-menu">Xin Chào,
			                    		<?php require("XuLy_form/Xuly_user_menu.php"); ?>
			                    	</p>
			                    </div>
			                </li>
			                <li style="margin-top: 20px">
			                	
			                </li>
			                <?php
			                	if(isset($_COOKIE['quyen'])){
			                		if($_COOKIE['quyen'] == 2){ // người quản trị 
			                ?>
			                <li>
			                	<a href="thong_ke.php"><i class="fas fa-chart-bar" style="color:#ffffff; float: left; margin-left: 0px; margin-top: 15px; "></i>Thống kê </a>
			                </li>
			                <li>
			                	<a href="them_congthuc.php?them">Đăng công thức</a>
			                </li>
			                <li>
			                	<a href="danh_sach_binhluan.php">Quản lý bình luận</a>
			                </li>
			                <li>
			                	<a href="danh_sach_User.php">Quản lý khách hàng</a>
			                </li>
			                <li>
			                	<a href="danhsach_congthuc.php">Quản lý Công thức</a>
			                </li>
			                <li>
			                	<a href="danh_sach.php?sach">Quản lý Sách</a>
			                </li>
			                <li>
			                	<a href="danhsach_danhmuc.php">Quản lý danh mục</a>
			                </li>
			                <li>
			                	<a href="ql_donhang.php">Quản lý đơn hàng</a>
			                </li>
			                <li>
			                	<a href="danh_sach_tintuc.php">Quản lý tin tức</a>
			                </li>

			                <!-- <li>
			                	<a href="them_danhmuc.php?them">Thêm danh mục</a>
			                </li> -->
			                <!-- <li>
			                	<a href="them_sach.php?them">Thêm sách nấu ăn</a>
			                </li> -->
			                <li>
			                	<a href="duyet_congthuc.php">Duyệt món ăn</a>
			                </li>
			                <li>
			                	<a href="ho_so_user.php"> <i class="fas fa-address-card" style="color:#ffffff; float: left; margin-left: 0px; margin-top: 10px;"></i>Cập nhật thông tin </a>
			                </li>
			                <?php 
			                		}else{// khách hàng
			                ?>
			                <li>
			                	<a href="them_congthuc.php?them">Đăng công thức </a>
			                </li>
			                
			               	
			                <li class="">
			                    <a href="da_luu.php">Đã lưu</a>
			                </li>
			                <li>
			                    <a href="#">Lịch sử</a>
			                </li>
			                <li>
			                    <a href="#">Sự kiện</a>
			                </li>
			                <li>
			                    <a href="#">Thông báo</a>
			                </li>
			               	
			                <li>
			                    <a href="ho_so_user.php">Thông tin cá nhân</a>
			                </li>
			                <li>
			               		<a href="bansach.php">Sách hay</a>
			               	</li>
			               	<li>
			                	<a href="ho_so_user.php">Cập nhật thông tin <i class="fas fa-address-card" style="color:#ffffff;float: right; margin-right: 10px; margin-top: 10px;"></i></a> 
			                </li>
			                 <li>
			                	<a href="giohang.php" class='fas fa-shopping-cart' style='font-size:20px'> 
			                		<sup id="tong_cart">
			                			<?php
			                				if(isset($_SESSION['tong'])){
			                					echo $_SESSION['tong'];
			                				}else echo 0;  

			                			?>
			                		</sup>
			                	</a>
			                </li>
			                
			                <?php


			                		}
			                	}else{
			                ?>
			                <li>
			                	<a>Đăng nhập để sử dụng các </a>
			                	<a>chức năng</a>
			                </li>
			                <li>
			               		<a href="bansach.php">Sách hay</a>
			               	</li>
			               	
			                 <li>
			                	<a href="giohang.php" class='fas fa-shopping-cart' style='font-size:20px'> 
			                		<sup id="tong_cart">
			                			<?php
			                				if(isset($_SESSION['tong'])){
			                					echo $_SESSION['tong'];
			                				}else echo 0;  

			                			?>
			                		</sup>
			                	</a>
			                </li>
			                
			                <?php
			                	}
			                ?>
			              
			                
			               
			            </ul>
			        </div>
			    </div>
			</div>
			<div class="col-10" >
				<nav class=" navbar navbar-default navbar-fixed-top header-menu">
						<div class="navbar-header navbar-left">
							<button type="button" class="btn-bar-menu">
								<i class='fas fa-bars'></i>
							</button>
						</div>
						<ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
							<li><a href="index.php">TRANG CHỦ</a></li>
							<li><a href="about.php">VỀ CHÚNG TÔI</a></li>
							<li><a href="">TIN TỨC</a></li>
							<li class="nav-item dropdown">
	                        	<a href="#" class="navbar-link dropdown-toggle img-user" id="mydropdown" data-toggle="dropdown" >
	                        		<i class='fas fa-user-alt' style='font-size:20px; color:#000000' ></i>
	                        	</a>
	                        	<div class="dropdown-menu"  >
	                        		<p align="center" class="dropdown-user"><a class="dropdown-item" href="dangnhap.php" style="color:#000000; text-decoration: none; ">Sign In</a></p>
	                        		<p align="center" class="dropdown-user"><a class="dropdown-item" href="dangky.php" style="color:#000000; text-decoration: none;" >Sign Up</a></p>
	                        		<p align="center" class="dropdown-user"><a class="dropdown-item" href="XuLy_form/Xuly_dangxuat.php" style="color:#000000; text-decoration: none;" >Log out</a></p>
	                        	</div>
	                        </li>
						</ul>
				</nav>
			</div>
		</div>
	</div>
</body>
</html>