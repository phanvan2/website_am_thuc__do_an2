<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<style>

	</style>
</head>
<body >
	<?php include_once('menu.php'); 
		$email = $_GET['email'];
	?>
	<div class="container-fluid" >
		
			 <form action="XuLy_form/Xuly_quenPass.php" method="post">
			    <div class="modal-dialog" style="margin-top: 100px;">
			  
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Nhập lại mật khẩu!</h4>
			        </div>
			        <div class="modal-body">
						<div class="form-group">
							<label for="">Mời bạn mật khẩu: </label>
			        		<input class="form-control" type="number" placeholder="Nhập mật khẩu" name="pass" id="pass" >
						</div>
			        	<div class="form-group">
							<label for="">Mời bạn nhập lại mật khẩu: </label>
			        		<input class="form-control" type="number" placeholder="Nhập mật khẩu" name="re_pass" id="re_pass" >
						</div>
						<input type="text" style="display: none;" value="<?php echo $email; ?>" name="email">
				          
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-default" >Đổi mật khẩu</button>
			        </div>
			      </div>
			    </div>
			</form>
	 </div>
	<?php include_once('footer.php') ?>

</body>
</html>