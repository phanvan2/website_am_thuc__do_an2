<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng ký </title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/js/bootstrap.min.js">
	<link rel="stylesheet" href="css/dangky.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>

.selectdiv {
  position: absolute;
  /*Don't really need this just for demo styling*/
  
  float: left;
  min-width: 400px;
 
}

/* IE11 hide native button (thanks Matt!) */
select::-ms-expand {
display: none;
}

.selectdiv:after {
  content: '<>';
  font: 17px "Consolas", monospace;
  color: #333;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
  right: 11px;
  /*Adjust for position however you want*/
  
  top: 10px;
  padding: 0 0 2px;
  border-bottom: 1px solid #999;
  /*left line */
  
  position: absolute;
  pointer-events: none;
}

.selectdiv select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  /* Add some styling */
  
  display: block;
  width: 100%;
  max-width: 320px;
  height: 30px;
  float: right;
  margin: 5px 0px;
  padding: 0px 24px;
  font-size: 16px;
  line-height: 1.75;
  color: #333;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  -ms-word-break: normal;
  word-break: normal;
}
.selectdiv select:checked{
	background-color: red;
}
.error{
	color:#ff0000;
}
	</style>

</head>
<body>
	<script type="text/javascript">
		function loadError(){
			var ten =  document.getElementById("ten").value;
			console.log(ten);
			 $("#error").load("./XuLy_form/Xuly_error.php?ten="+ten);
 
		}
	</script>
	<?php include_once("menu.php") ;
		include_once("XuLy_form/Xuly_select.php");
	?>
	<div class="container" style="margin-top:150px;">
		<form action="XuLy_form/Xuly_dangky.php" method="POST">
			<div class="row" style="box-shadow: 0 14px 28px gray;">
			
			<div class=" dangky">
				<div class="col-sm-6 height">
					<div class="dangky-form">
						<h1>Đăng ký</h1>
						<div class="form-group">
							<label for="">Tên đăng nhập:<span style="float:right;" class="error" id="error"></span></label>
							<input class="form-control" type="text" name="ten" id="ten" placeholder="Type your username here" onkeyup ="loadError()">
							
						</div>
						<div class="form-group">
							<label for="">Mật khẩu: </label>
							<input class="form-control" type="password" name="pass" placeholder="Type your password here">
						</div>
						<div class="form-group">
							<label for="">Nhập mật khẩu lại:</label>
							<input class="form-control" type="password" name="repass" placeholder="Type Re-password here">
						</div>
						<div class="form-group">
							<label for="">Email: </label>
							<input class="form-control" type="text" name="email" placeholder="Type your Email here">
						</div>
						<div class="form-group" align="left">
							<label for="">Quyền:</label>
							<div class=" selectdiv">
								<select name="quyen" >
						          	<option selected value="1"> Người dùng </option>
						          	<?php 
						          		if($disable_select == true){
						          	?>
						          	<option value="2"  >Người quản trị </option>
						          	<?php 
						          		}
						        	?>
						      	</select>
						    </div>
						</div>
						<div style="height: 25px;"></div>
						<button>Đăng ký</button>
					</div>
				</div>
				<div class="col-sm-6 height">
					<div class="dangky-introduce">
						<div style="height: 200px;"></div>
						<h3>Xin chào </h3>
						<span>Đăng ký để trải nghiệm những </span><br><span style="margin-left: 32%;">dịch vụ tuyệt với nhất từ chúng tôi</span>
					</div>
				</div>
			</div>
			</div>
			
		</form>
		
	</div>
	<div style="margin-top:  100px"></div>
	<?php include_once("footer.php"); ?>
</body>
</html>