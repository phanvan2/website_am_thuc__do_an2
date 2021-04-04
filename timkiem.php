<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tìm Kiếm</title>
	<link rel="stylesheet" href="">
	<style>
		.button-search{
			width: 80px; 
			background-color: #288ad6;
			border-style: solid;
			color:#ffffff;
			border-color:#288ad6;
			margin-left: 5px;
			/**/
		}
		.button-search:hover{
			box-shadow: 4px 4px 25px -2px rgba(0, 0, 0, 0.3);
		}
		.text-search{
			width: 25%;
		}
	</style>
</head>
<body>
	<script>
		// $(document).ready(function(){
		// 	$("#btn_timkiem").click(function(){
		// 		txt_tim = $('#timkiem').val();
		// 		$("#noi_dung_timkiem").load("noiDung_timkiem.php?txt_tim="+txt_tim);
		// 	});
		// });
			
		
	</script>
	<div class="container" style="margin-top: 100px;">
		<div class="row"  align="right">
 			<form action="XuLy_form/Xuly_timkiem.php" method="GET">
				<input class="text-search" type="text" id="timkiem" name="timkiem" placeholder="Tìm kiếm" autocomplete="on">
				<button class="button-search" id="btn_timkiem" ><span class="glyphicon glyphicon-search"></span></button>
			</form>
		</div>
		<div id="noi_dung_timkiem">
			<?php 
				include("noiDung_timkiem.php");
			?>
		</div>
	</div>
</body>
</html>