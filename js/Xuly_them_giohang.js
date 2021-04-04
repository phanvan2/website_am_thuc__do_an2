		function them_gio_hang(id_sach){
				$.get("./XuLy_form/Xuly_themgiohang.php" , {id: id_sach}, function(result){
					var s = document.getElementById('tong_cart').innerHTML;
					var s1 = parseInt(s, 10);
					document.getElementById('tong_cart').innerHTML = (s1 + 1);
				});
			}