<?php

	if(isset($_GET['name_img'])){
		$name_img = $_GET['name_img'];
	} else $name_img = "load.png";
	$name_img = "image/img_danhmuc/$name_img"  ; 

		$name_danhmuc = $_GET['name_danhmuc'];
	
	echo "
					<div  class='card-danhmuc'  align='center'>
						<a href=''>
							<div class='card-img-danhmuc' align='center'>
								<img src='$name_img' alt='' width='70%' height='40%'>
							</div>
							<div class='card-detail-danhmuc'>
								<p>$name_danhmuc</p>
							</div>
						</a>
					</div>
		";
?>