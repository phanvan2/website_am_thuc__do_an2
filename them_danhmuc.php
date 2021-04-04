<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm danh mục</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="css/danhmuc.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
			</style>
		
</head>
<body>
	<script>
		function load_card(){
			
			var danhmuc = $("#danhmuc").val();
			var img_danhmuc= document.getElementById("img_danhmuc").files[0].name; 
			
			$("#card_danhmuc").load("XuLy_form/LoadAjax/Ajax_cardDanhmuc.php?name_danhmuc="+danhmuc+"&name_img="+img_danhmuc);
    			
		}
	</script>
	<?php include("menu.php"); 
	if(!isset($conn)){
				require_once '../Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect();
			}
	?>
	<div class="container" style="margin-top:150px;">
		<?php if(isset($_GET['them'])){

		?>
		<div class="col-sm-12" align="center">
			<h4 style="font-weight:bold">THÊM DANH MỤC</h4>
		</div>
		<form action="XuLy_form/Xuly_them_danhmuc.php" enctype="multipart/form-data" method="POST">
			<div class="col-sm-4 col-sm-offset-2">
				<div class="form-group">
					<label for="">Danh mục</label>
					<input class="form-control" type="text" id="danhmuc" name="danhmuc" placeholder="Mời bạn thêm danh mục" onchange="load_card()">
				</div>
				<div class="form-group">
					<label for="">Ảnh danh mục</label>
					<input class="form-control" type="file" id="img_danhmuc" name="img_danhmuc" onchange="load_card()" >
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 carddanhmuc " align="center"  >
					<div  class="card-danhmuc"  align="center" id="card_danhmuc">
						<a href="">
							<div class="card-img-danhmuc" align="center">
								<img src="image/img_danhmuc/load.png" alt="" width="70%" height="40%">
							</div>
							<div class="card-detail-danhmuc">
								<p>Ăn Sáng</p>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12" align="center">
				<input type="submit" value="thêm">
			</div>
		</form>
		<?php 
			}
			else if(isset($_GET['capnhat'])){
				$id_danhmuc  = $_GET['id_danhmuc'];
				$bang_danhmuc = new bang($conn, 'danh_muc');
				$bang_danhmuc->setResult_select("*" ," id = $id_danhmuc" , "id DESC");
				$ketqua_danhmuc = $bang_danhmuc->getResult_select();
				$row_danhmuc = mysqli_fetch_assoc($ketqua_danhmuc); 
				$ten = $row_danhmuc['tenDanhmuc'];
				$img = $row_danhmuc['img']; 

		?>
		<div class="col-sm-12" align="center">
			<h4 style="font-weight:bold">Cập nhật DANH MỤC</h4>
		</div>
		<form action="XuLy_form/Xuly_capnhat.php?danhmuc=<?php echo $id_danhmuc; ?>" enctype="multipart/form-data" method="POST">
			<div class="col-sm-4 col-sm-offset-2">
				<div class="form-group">
					<label for="">Danh mục</label>
					<input class="form-control" type="text" id="danhmuc" name="ten_danhmuc" placeholder="Mời bạn thêm danh mục" value="<?php echo $ten ; ?>" >
				</div>
				<div class="form-group">
					<label for="">Ảnh danh mục:	</label><input class="chon-anh" type="checkbox" name="chon_anh" style="margin-left: 10px;"> <label for="">Giữ nguyên ảnh cũ</label>
					<input class="form-control" type="file" id="img_danhmuc" name="img_danhmuc" value="<?php echo $img?>">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 carddanhmuc " align="center"  >
					<div  class="card-danhmuc"  align="center" id="card_danhmuc">
						<a href="">
							<div class="card-img-danhmuc" align="center">
								<img src="image/img_danhmuc/<?php echo $img; ?>" alt="" width="70%" height="40%">
							</div>
							<div class="card-detail-danhmuc">
								<p><?php echo $ten; ?></p>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12" align="center">
				<input type="submit" value="Cập nhật" style="width: 100px;">
			</div>
		</form>
		<?php 
			}
		?>

	</div>
	<div style="height: 150px;">
		<script>
			function check(){
				var  a= document.getElementById("img_danhmuc1").value;
				var s = a.lastIndexOf('\\');
				var c = a.slice(s+1);
				alert(a);
				alert(s);
				alert(c); 
			}
		</script>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>