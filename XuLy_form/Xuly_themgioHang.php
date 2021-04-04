<?php 
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$id = $_GET['id'];
					if(isset($_SESSION['cart'][$id])){
						$_SESSION['cart'][$id] += 1;
					}
					else $_SESSION['cart'][$id] = 1;
					if(isset($_SESSION['tong'])){
						$_SESSION['tong'] += 1;
					}
					else $_SESSION['tong'] = 1;
		
			}
	echo "<script>
			//location.replace('index.php');
		</script>"
?>