	
	<?php
				if(!isset($conn)){
					require '../Xuly_ketNoiSQL.php'; 
					$conn1 = new connectSQL ; // kết nối đến sql
					$conn1 -> setconnect();
					$conn = $conn1-> getconnect(); 
				}
				$bang_monAn = new bang($conn, 'mon_an');
				$bang_monAn->setResult_select("*" ,"trangThai = 0 " , "id DESC");
				$ketqua_monAn = $bang_monAn->getResult_select();
				if( mysqli_num_rows($ketqua_monAn) <= 0 ){
					echo "<h4>Không có bất cứ món ăn nào cần duyệt !!</h4>";
				}else {
			?>
			<table class="GeneratedTable" align="center" id="table_monan" >
			<thead>
				<tr>
					<th>STT</th>
					<th>Người đăng</th>
					<th>Tên món ăn</th>
					<th>Ngày đăng</th>
					<th>Danh mục</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>	

			<?php 

				$stt = 1;  
				while($row_monAn = mysqli_fetch_assoc($ketqua_monAn)){ 
					$id_monAn = $row_monAn['id'];
					$id_User = $row_monAn['idUser']; 
					$id_danhmuc = $row_monAn['idDanhmuc']; 
	//----- TRuy vấn bảng user lấy tên người đăng công thức -------------
					
					$bang_user = new bang($conn, 'user'); // truy vấn tới bảng user 
					$bang_user->setResult_select("ten" ," id = '$id_User'" , "id DESC");
					$ketqua_User = $bang_user->getResult_select();
					$row_User = mysqli_fetch_assoc($ketqua_User);
					$ten_User  = $row_User['ten'];
	//============================
	//------Truy vấn bảng danh mục lấy tên danh mục ------------------
					$bang_danhmuc1 = new bang($conn, 'danh_muc'); // truy vấn tới bảng user 
					$bang_danhmuc1->setResult_select("tenDanhmuc " ," id = $id_danhmuc " , "id DESC");
					$ketqua_danhmuc1 = $bang_danhmuc1->getResult_select();
					$row_danhmuc1 = mysqli_fetch_assoc($ketqua_danhmuc1);
					$ten_danhmuc  = $row_danhmuc1['tenDanhmuc'];
			?>
			<tr>
				<td><?php echo $stt ; ?></td>
				<td><?php echo $ten_User ; ?></td>
				<td><?php echo $row_monAn['ten_monAn']; ?></td>
				<td><?php echo $row_monAn['ngayDang']; ?></td>
				<td><?php echo $ten_danhmuc ; ?> </td>
				<td><a href="sanpham.php?id=<?php echo $id_monAn; ?> ">Chi tiết</a></td>
				<td align="center" onclick="dang_congthuc('<?php echo $id_monAn; ?>')" ><button>Cho phép đăng</button></td>
				<td align="center"><button>Xóa</button></td>
			</tr>
		<?php
			$stt ++ ;   
			}
		}
		?>
		</tbody>
	</table>