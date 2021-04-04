<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thống kê</title>
	<link rel="stylesheet" href="">
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style>
		.thongke{
			float: left;
			margin-top: auto; 
		}
		.thongke p.thongke-so{
			font-size: 30px ; 
			color: #2ab4c0;
			font-family: sans-serif;
		
		}
		.thongke p.thongke-gia{
			font-size: 30px ; 
			color: #f36a5a;
			font-family: sans-serif;
			
		}
		.thongke p.thongke-danhgia{
			font-size: 30px ; 
			color: #2ac4a0;
			font-family: sans-serif;
			
		}
		.thongke p.thongke-user{
			font-size: 30px ; 
			color: #8877a9;
			font-family: sans-serif;
			
		}
		.thongke p.thongke-deatil{
			margin-top: -15px;
			font-size: 14px; 
			color: #9a9a9a;
		}
		.card-detail p.icon{
			margin-top: 10px; 
			font-size: 25px ; 
			color: #9a9a9a;
			float: right;

		}
		.btn-card{
			float: right;
			border-radius: 5px;
			height: 30px ;
			width: 70px; 
			border-style: none; 
			color: #ffffff;
			background-color:  #9a9a9a;
			font-weight: bold ; 
		}
		
	</style>
</head>
<body style="background-color: #dcdcdc">
	<?php include 'menu.php' ; ?>
	<!-- Tạo biểu đồ thốn kê các công thưc món ăn  -->
	  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
<?php
	if(!isset($conn)){
		require 'XuLy_form/Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect(); 
	}
	$bang_monAn = new bang($conn , "mon_an"); 
	$bang_monAn->setResult_select("idDanhmuc, COUNT(1) as sl " ,"  1  GROUP BY idDanhmuc HAVING COUNT(1) > 1 " , "id DESC");
	$kq_monAn = $bang_monAn->getResult_select() ; 
	$bang_danhmuc = new bang($conn , "danh_muc");
?>
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        	['Task', 'Hours per Day'],
      <?php
      	while ($row_moAn = mysqli_fetch_assoc($kq_monAn)) {
			$sl = $row_moAn['sl'];
			$id_danhmuc = $row_moAn['idDanhmuc'];
			$bang_danhmuc-> setResult_select('tenDanhmuc ' , "id = $id_danhmuc " , 'id DESC ') ; 
			$row_danhmuc = mysqli_fetch_assoc($bang_danhmuc->getResult_select());
			$ten_Danhmuc = $row_danhmuc['tenDanhmuc'];

	 		
      ?>
          
          ['<?php echo $ten_Danhmuc ; ?>',   <?php echo $sl ; ?>],
          
        <?php 
			}
        ?>
          ['Khác',   0 ]
         
        ]);

        var options = {
          title: 'Thống kê các công thức'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <!-- tạo biểu đồ thống kê doanh thu --------------------------> 
<?php 
	$bang_hoadon = new bang($conn ,"hoadon"); 
//SELECT YEAR(ngay_Dat) as y ,(MONTH(ngay_Dat)) AS month, SUM(tong_tien) AS gia FROM hoadon GROUP BY (MONTH(ngay_Dat)) , YEAR(ngay_Dat)	
	$bang_hoadon->setResult_select(" YEAR(ngay_Dat) as y , (MONTH(ngay_Dat)) AS month, SUM(tong_tien) AS gia " , " tinh_trang = '1'  GROUP BY (MONTH(ngay_Dat))" ," ngay_Dat ASC " ) ; 
	$max_limit = mysqli_num_rows($bang_hoadon->getResult_select()); 
	$min_limit = $max_limit- 6; 
	$bang_hoadon->setResult_select(" YEAR(ngay_Dat) as y , (MONTH(ngay_Dat)) AS month, SUM(tong_tien) AS gia " , " tinh_trang = '1'  GROUP BY (MONTH(ngay_Dat))" ," ngay_Dat ASC LIMIT $min_limit, $max_limit " ) ; 

?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['tháng', 'doanh thu'],
 <?php
 	while ($row_hoadon = mysqli_fetch_assoc($bang_hoadon->getResult_select() )) {
 		$ngaythang = $row_hoadon['month']."-".$row_hoadon['y']; 
 		$gia = $row_hoadon['gia'];


 ?>
          ['<?php echo $ngaythang; ?>',    <?php echo $gia; ?>],
 <?php
 	} 
 ?>      
          
        ]);

        var options = {
          title: 'Doanh thu của 6 tháng gần nhất',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
   <!-- -----------------------------------------// -->
<!-- Thống kê đơn hàng theo tháng =========================  -->
 
<?php 
	$bang_hoadon = new bang($conn ,"hoadon"); 
	$date = getdate(); 
//SELECT YEAR(ngay_Dat) as y ,(MONTH(ngay_Dat)) AS month,COUNT(1) AS sl  FROM hoadon GROUP BY (MONTH(ngay_Dat)) , YEAR(ngay_Dat)	
	$bang_hoadon->setResult_select(" YEAR(ngay_Dat) as y , (MONTH(ngay_Dat)) AS month, COUNT(1) AS sl , SUM(tong_sl) as t_sl  " , " tinh_trang = '1'  GROUP BY (MONTH(ngay_Dat))" ," ngay_Dat ASC " ) ;
	$max_limit = mysqli_num_rows($bang_hoadon->getResult_select()); 
	$min_limit = $max_limit - 6; 
	$bang_hoadon->setResult_select(" YEAR(ngay_Dat) as y , (MONTH(ngay_Dat)) AS month, COUNT(1) AS sl , SUM(tong_sl) as t_sl  " , " tinh_trang = '1'  GROUP BY (MONTH(ngay_Dat))" ," ngay_Dat ASC LIMIT $min_limit , $max_limit " ) ; 

?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['tháng','số lượng ' ,'đơn hàng'],
 <?php
 	
 	while ($row_hoadon = mysqli_fetch_assoc($bang_hoadon->getResult_select() )) {
 		$ngaythang = $row_hoadon['month']."-".$row_hoadon['y']; 
 		$sl = $row_hoadon['sl'];
 		$t_sl = $row_hoadon['t_sl']  ; 

 ?>
          ['<?php echo $ngaythang; ?>', <?php echo $t_sl; ?> ,   <?php echo $sl; ?>],
 <?php
 	} 
 ?>      
          
        ]);

        var options = {
          title: 'Thống kê bán sách của 6 tháng gần nhất',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
    </script>
<!-- -========================================-->	
	<div class="container-fluid" style="margin-top : 100px">
		<?php
		// lấy tổng doanh thu 
			$bang_hoadon->setResult_select("SUM(tong_tien) as tong"  , " tinh_trang = '1' " , "id DESC") ; 
			$row_hoadon = mysqli_fetch_assoc($bang_hoadon->getResult_select()) ; 
			$tong_tien = $row_hoadon['tong'] ; 
		//  lấy số lượng hóa dơn
			$bang_hoadon-> setResult_select("COUNT(1) as dem" ,"tinh_trang = '1' " ," id DESC ") ; 
			$row_hoadon = mysqli_fetch_assoc($bang_hoadon->getResult_select()) ; 
			$dem = $row_hoadon['dem'] ; 
		// lấy số lượng khách hàng 
			$bang_user = new bang($conn  , 'user'); 
			$bang_user->setResult_select("COUNT(1) as dem1 " , "quyen = '1' " , "id DESC ") ; 
			$row_user = mysqli_fetch_assoc($bang_user->getResult_select()) ; 
			$dem1 = $row_user['dem1'] ;
		// lấy tổng số lượng đánh giá công thức 
			$bang_danh_gia = new bang($conn , "danh_gia")  ;
			$bang_danh_gia->setResult_select("COUNT(1) as dem_danhgia " ," 1 " , "id DESC" ) ; 
			$row_danhgia = mysqli_fetch_assoc($bang_danh_gia->getResult_select()) ; 
			$dem_danhgia = $row_danhgia['dem_danhgia']  ; 

		?>
		<div class="row" align="center">
			<div class="col-sm-3 card-thongke" >
				<div style="height: 150px ;background-color: #ffffff; width: 95%;">
					<div class="col-sm-12 card-detail">
						<div class="thongke" align="center">
							<p class="thongke-so"><?php echo $dem ;?></p>
							<p class="thongke-deatil">ĐƠN HÀNG</p>
						</div>
						
						<p class="icon" style="color: #2ab4c0;"><i class="fas fa-shopping-cart"></i></p>
					</div>
					<div class="col-sm-12">
						<hr style="border-width: 3px; border-color:#2ab4c0 ;  height: 2px; width: 100% ;size: 2px">
						<a href="ql_donhang.php"><button class="btn-card"> XEM</button></a>
					</div>
				</div>
			</div>
			<div class="col-sm-3 card-thongke" >
				<div style="height: 150px ;background-color: #ffffff; width: 95%;">
					<div class="col-sm-12 card-detail">
						<div class="thongke" align="center">
							<p class="thongke-gia"><?php echo $tong_tien; ?> <span style="font-size: 16px">VND</span></p>
							<p class="thongke-deatil">DOANH THU</p>
						</div>
						
						<p class="icon" style=" color: #f36a5a;  "><i class="	fas fa-money-bill-wave"></i></p>
					</div>
					<div class="col-sm-12">
						<hr style="border-width: 3px; border-color:#f36a5a ;  height: 2px; width: 100% ;size: 2px">
						<a href="#doanhthu"><button class="btn-card"> XEM</button></a>
					</div>
				</div>
			</div>
			<div class="col-sm-3 card-thongke" >
				<div style="height: 150px ;background-color: #ffffff; width: 95%;">
					<div class="col-sm-12 card-detail">
						<div class="thongke" align="center">
							<p class="thongke-user"><?php echo $dem1; ?> </p>
							<p class="thongke-deatil">KHÁCH HÀNG</p>
						</div>
						
						<p class="icon" style="color: #8877a9 ; "><i class="fas fa-user-check"></i></p>
					</div>
					<div class="col-sm-12">
						<hr style="border-width: 3px; border-color:#8877a9 ;  height: 2px; width: 100% ;size: 2px">
						<a href="danh_sach_user.php"><button class="btn-card"> XEM</button></a>
					</div>
				</div>
			</div>
			<div class="col-sm-3 card-thongke">
				<div style="height: 150px ;background-color: #ffffff; width: 95%;">
					<div class="col-sm-12 card-detail">
						<div class="thongke" align="center">
							<p class="thongke-danhgia"><?php echo $dem_danhgia ; ?></p>
							<p class="thongke-deatil">ĐÁNH GIÁ</p>
						</div>
						
						<p class="icon" style="color: #2ac4a0;  "><i class="glyphicon glyphicon-star-empty "></i></p>
					</div>
					<div class="col-sm-12">
						<hr style="border-width: 3px; border-color:#2ac4a0 ;  height: 2px; width: 100% ;size: 2px">
						<a href=""><button class="btn-card"> XEM</button></a>
					</div>
				</div>
			</div>

			<div class="col-sm-12" align="center">
	<!-- tạo thống kê đánh giá ================ --> 
		<?php
		
			$sum = 0  ; 
			for($i = 1  ; $i <= 5 ; $i ++){
				$bang_danh_gia->setResult_select(" COUNT(1) as sl " , " kq_danh_gia = $i " , "id DESC") ; 

				$row_danhgia = mysqli_fetch_assoc($bang_danh_gia->getResult_select()); 
				$sao[$i] = $row_danhgia['sl'] ; 
				$sum += $sao[$i] ; 
			}

		?>
				<div class="col-sm-6" align="left">

					<div class="danh-gia" style="height: 400px; background-color: #ffffff; width: 99% ; margin-top: 30px; margin-left: -5px;   ">
						<div class="col-sm-12">
							<h4>Thống kê đánh giá</h4>
							<hr style="border-width: 2px; border-color:#dcdcdc ;  height: 2px; width: 80% ;">
						</div>
						<div class="col-sm-12" style="margin-top: 20px; ">
							<div class="col-sm-2 sao">
								<p>5 <i class="glyphicon glyphicon-star"></i></p>
								
							</div>

							<div class="col-sm-7">
								<div class="progress" style="height: 10px; ">
							        <div class="progress-bar-warning" role="progressbar" aria-valuenow="70"
							                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ( $sao['5'] / $sum *100);?>% ; background-color: #f25800; ">
							            <span style=" padding: 5px;"></span>
							        </div>
							    </div>

							</div>
							<div class="col-sm-3">
								<span><?php echo $sao['5'] ?> đánh giá</span>
							</div>
							
						</div>
						<div class="col-sm-12">
							<div class="col-sm-2 sao">
								<p>4 <i class="glyphicon glyphicon-star"></i></p>
								
							</div>

							<div class="col-sm-7">
								<div class="progress" style="height: 10px; ">
							        <div class="progress-bar-warning" role="progressbar" aria-valuenow="70"
							                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ( $sao['4'] / $sum *100);?>% ;  background-color: #f25800; ">
							            <span style=" padding: 5px;"></span>
							        </div>
							    </div>

							</div>
							<div class="col-sm-3">
								<span><?php echo $sao['4'] ?> đánh giá</span>
							</div>
							
						</div>
						<div class="col-sm-12">
							<div class="col-sm-2 sao">
								<p>3 <i class="glyphicon glyphicon-star"></i></p>
								
							</div>

							<div class="col-sm-7">
								<div class="progress" style="height: 10px; ">
							        <div class="progress-bar-warning" role="progressbar" aria-valuenow="70"
							                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ( $sao['3'] / $sum *100);?>%  ; background-color: #f25800; ">
							            <span style=" padding: 5px;"></span>
							        </div>
							    </div>

							</div>
							<div class="col-sm-3">
								<span><?php echo $sao['3'] ?> đánh giá</span>
							</div>
							
						</div>
						<div class="col-sm-12">
							<div class="col-sm-2 sao">
								<p>2 <i class="glyphicon glyphicon-star"></i></p>
								
							</div>

							<div class="col-sm-7">
								<div class="progress" style="height: 10px; ">
							        <div class="progress-bar-warning" role="progressbar" aria-valuenow="70"
							                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ( $sao['2'] / $sum *100);?>%  ; background-color: #f25800; ">
							            <span style=" padding: 5px;"></span>
							        </div>
							    </div>

							</div>
							<div class="col-sm-3">
								<span><?php echo $sao['2'] ?> đánh giá</span>
							</div>
							
						</div>
						<div class="col-sm-12">
							<div class="col-sm-2 sao">
								<p>1 <i class="glyphicon glyphicon-star"></i></p>
								
							</div>

							<div class="col-sm-7">
								<div class="progress" style="height: 10px; ">
							        <div class="progress-bar-warning" role="progressbar" aria-valuenow="70"
							                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ( $sao['1'] / $sum *100);?>%  ; background-color: #f25800; ">
							            <span style=" padding: 5px;"></span>
							        </div>
							    </div>

							</div>
							<div class="col-sm-3">
								<span><?php echo $sao['1']; ?> đánh giá</span>
							</div>
							
						</div>
						<div class="col-sm-12">
							<h5>Tổng đánh giá : <?php echo $sum ; ?></h5>
						</div>
					</div>
				</div>
				<div class="col-sm-6" align="center">
					<div class="danh-gia" style="height: 400px; background-color: #ffffff; width: 99% ; margin-top: 30px; margin-right: -5px; ">
						
						<div class="col-sm-12" id="piechart" style="width: 100%; height: 100%;"></div>
					</div>
				</div>
	<!---            -->			
				<div class="col-sm-6" align="left" id="doanhthu">
					<div class="danh-gia" style="height: 400px; background-color: #ffffff; width: 99% ; margin-top: 30px; margin-left: -5px;   ">
						
							 <div id="chart_div1" style="width: 100%; height: 100%;"></div>
					</div>
				</div>
				<div class="col-sm-6" align="center">
					<div class="danh-gia" style="height: 400px; background-color: #ffffff; width: 99% ; margin-top: 30px; margin-right: -5px; ">
						
						 <div id="chart_div" style="width: 100%; height: 100%;"></div>
					</div>
				</div>
				
				
				
			</div>
		</div>
		
	</div>
	<?php include 'footer.php' ; ?>
</body>
</html>