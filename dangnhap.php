<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/dangnhap.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<style>

	</style>
</head>
<body >
	<script>
		function guiMa(){
			mail = $("#email1").val();
			$.post("XuLy_form/Xuly_quenPass.php", {email : mail}, function(result){
				
			});
			alert("Mã khôi phục đã được gửi!");
		}
		function show_pass(){
			var temp = document.getElementById("pass_txt"); 
			 if (temp.type === "password") { 
                temp.type = "text"; 
                $("#hide_pass").css({
                	display: 'none'
                	
                });
                 $("#show_pass").css({
                	display: 'inline'
                	
                });
            } 
            else { 
                temp.type = "password"; 
                $("#hide_pass").css({
                	display: 'inline'
                	
                });
                  $("#show_pass").css({
                	display: 'none'
                	
                });
            } 
		}
	
	</script>
	<?php 
		include_once('menu.php'); 
		if(isset($_COOKIE['user'])){
			echo "<script> alert('Bạn chưa đăng xuất') ; "; 
			echo "history.back(); </script>"; 
		}
	?>
	<div class="container-fluid" >
		<div class="row" align="center">
			<form action="XuLy_form/Xuly_dangnhap.php" method="POST">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="Sign_in" align="center">
						<div class="Sign-img" style="background-image: url('image/danhnhap/danhnhap.jpg');">
							<p>Sign In</p>
						</div>
						<div class="Sign-input" align="center">
							<p>
								<label for="">user name: </label>
								<input type="text" name="ten" placeholder="Type your user here">
							</p>
							<p>
								<label for="">Password: </label>
								<input type="password" name="pass" placeholder="Type your password here" id="pass_txt">
								<i class="fas fa-eye" onclick="show_pass()" style="display: none;color:#868e9b; " id="show_pass"></i>
								<i class="	 fas fa-eye-slash" onclick="show_pass()"  id="hide_pass" style="color:#868e9b;"></i>
							</p>
							<a href="dangky.php" style="text-decoration:none; " >Bạn chưa có tài khoản? </a>
							<a href="quenPass.php" style="text-decoration:none ;" data-toggle="modal" data-target="#myModal">Quên mật khẩu!!</a>
						</div>
						<div class="Sign-in-btn">
							<input type="submit" value="Đăng nhập">
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="myModal" role="dialog" style="margin-top:150px;">
	    <div class="modal-dialog">
	  
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Bạn quên mật khẩu!</h4>
	        </div>
	        <div class="modal-body">
	        	<p>
	        		<b>Hướng dẫn: </b>
	        		<ol>
	        			<li>Chúng ta nhập địa chỉ email bạn đã đăng ký vào text và bấm gửi mã</li>
	        			<li>Chờ mã được gửi về địa chỉ mail của bạn.Nếu không thấy bạn gửi mã lại</li>
	        	</p>
	          		<li>Mời bạn nhập địa chỉ email: </li>
	          		<form action="XuLy_form/Xuly_quenPass.php" method="post">
	          	<input class="form-control" type="email" placeholder="Nhập email của bạn tại đây" name="email1" id="email1" required>
	          			<li>Nhập mã mà bạn nhận được vào ô text phía dưới và chọn nút gửi</li>
	          			 
		          			<input class="form-control" type="number" placeholder="Nhập mã" name="ma" id="ma" >
		          			<button type="submit" class="btn btn-default"  style="margin-top:5px; float: right;" >Gửi</button>
		          		</form>
	          		</ol>
	          	<p>	
	          		<ul>
	          			<b>Lưu ý:</b>
	          			<li>Vui lòng chọn gửi mã lại nếu bạn không thấy mã được gửi về hoặc kiểm tra địa chỉ email lại</li>
	          			<li>Mỗi mã chỉ có hạn trong khoảng 3 phút</li>
	          		</ul>
	          	</p>
	        </div>
	        <div class="modal-footer">
	        	<button type="submit" class="btn btn-default" onclick="guiMa()">Gửi mã</button>
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
	        </div>
	      </div>
	    </div>
	
	 </div>
	<?php include_once('footer.php') ?>

</body>
</html>