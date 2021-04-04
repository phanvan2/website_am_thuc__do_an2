<?php 
	
		setcookie("user","", time() - 3600 ,'/');
		setcookie("quyen" ,"" , time() - 3600 , '/');
		echo "<script> location.replace('../index.php'); </script>";	

?>