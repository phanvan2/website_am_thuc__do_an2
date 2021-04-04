	
function update(id ){
	var s = confirm("Xác nhận bạn đã nhận được hàng");
	if (s == true){
		$.post("./XuLy_form/Xuly_capnhat.php?hoadon", {idhoadon: id }, function(result){
		// Update lại trạng thái đơn hàng
		
				});
			}
		}