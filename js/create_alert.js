
function alert1(noidung , icon1){
				 a = swal({
					title: "Food Recipes",
					text: noidung,
					icon: icon1,
				});
				console.log(a);
			}
			var back = function back(){
				history.back();
			}
			var replace = function replace(){
				location.replace( '../index.php');
}