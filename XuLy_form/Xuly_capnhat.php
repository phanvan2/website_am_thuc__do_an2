<?php
	if(!isset($conn)){
		require 'Xuly_ketNoiSQL.php'; 
		$conn1 = new connectSQL ; // kết nối đến sql
		$conn1 -> setconnect();
		$conn = $conn1-> getconnect();
	}
	if(isset($_GET['hoadon'])) {
		$id_hoadon = $_POST['idhoadon']; 
		$bang_hoadon = new bang($conn , 'hoadon');
		$bang_hoadon->setResult_update(" tinh_trang = '1' ", " id = $id_hoadon"); 
	}
// cập nhật lại sách -----------------
	else if(isset($_GET['sach'])) {
		$id_sach = $_GET['id_sach']; 
		$ten_sach = $_POST['ten_sach'];
		$tac_gia = $_POST['ten_tacgia'];
		$soluong = $_POST['soluong'];
		$mota = $_POST['mo_ta'];
		$gia = $_POST['gia'];
		$bang_sach = new bang($conn , 'sach');
		if(isset($_POST['chon_anh'])){

			echo $_POST['chon_anh'];
			$list = "ten_sach = '$ten_sach', tac_gia ='$tac_gia', don_gia = $gia, soLuong = $soluong, mo_ta = '$mota'";
			
		}else {
			if(isset($_FILES['img_sach'])){
				$name_img = $_COOKIE['user'].rand(200,500).$_FILES['img_sach']['name']; 
				if(move_uploaded_file($_FILES['img_sach']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/sach/'.$name_img)){
					
					echo "Tai tap tin thanh cong";
					
				$list = "ten_sach = '$ten_sach', tac_gia ='$tac_gia', don_gia = $gia, soLuong = $soluong, mo_ta = '$mota', img_sach = '$name_img'";
					
				}
			}



		}
		$bang_sach->setResult_update( $list, " id = $id_sach");
		header("Location: ../index.php"); 
	}
// cập nhật lại công thức ---------------------
	else if(isset($_GET['congthuc'])) {
		$id_monAn = $_GET['id'];
		$ten = $_POST['ten_mon_an'];
		$mota = $_POST['mo_ta'];
		$nguyenlieu = $_POST['nguyen_lieu'];
		$huongdan = $_POST['huong_dan'];
		$idDanhmuc = $_POST['danhmuc'];
		$bang_monAn = new bang($conn , 'mon_an');

		if(isset($_POST['chon_anh'])){

			echo $_POST['chon_anh'];
			$list = " ten_monAn = '$ten' , moTa = '$mota' , nguyenLieu = '$nguyenlieu' , step = '$huongdan' , idDanhmuc = $idDanhmuc";
			
		}else {
			if(isset($_FILES['img_mon_an'])){
				$name_img = $_COOKIE['user'].rand(200,500).$_FILES['img_mon_an']['name']; 
				if(move_uploaded_file($_FILES['img_mon_an']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/img_monAn/'.$name_img)){
					echo "Tai tap tin thanh cong";
					
					$list = " ten_monAn = '$ten' , moTa = '$mota' , nguyenLieu = '$nguyenlieu' , step = '$huongdan' , idDanhmuc = $idDanhmuc, img = '$name_img'";
					
				}
			}



		}
		$bang_monAn->setResult_update( $list, " id = $id_monAn");
		header("Location: ../index.php"); 

	}
// cập nhật lại danh mục --------------------------
	else if(isset($_GET['danhmuc'])){
		$id_danhmuc = $_GET['danhmuc'];
		$ten_danhmuc = $_POST['ten_danhmuc'];
		$bang_danhmuc = new bang($conn , 'danh_muc');
		if(isset($_POST['chon_anh'])){

			echo $_POST['chon_anh'];
			$list = " tenDanhmuc = '$ten_danhmuc'";
			
		}else {
			if(isset($_FILES['img_danhmuc'])){
				$name_img = $_COOKIE['user'].rand(200,500).$_FILES['img_danhmuc']['name']; 
				if(move_uploaded_file($_FILES['img_danhmuc']['tmp_name'] , 'C:/xampp/htdocs/do_an_2/image/img_danhmuc/'.$name_img)){
					echo "Tai tap tin thanh cong";
					
					$list = " tenDanhmuc = '$ten_danhmuc' , img = '$name_img' ";
					
				}
			}


		}
		echo "bye";
		$bang_danhmuc->setResult_update( $list, " id = $id_danhmuc"); 
		header("Location: ../index.php");
	}
?>