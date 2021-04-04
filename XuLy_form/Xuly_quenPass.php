<?php
	if(isset($_POST['email'])){
		$email = $_POST['email']; 
		if(!isset($conn)){
				require 'Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect(); 
			}
			$email = $_POST['email'];
			$bang_user = new bang($conn, 'user');
			$bang_user->setResult_select(" id " , " email = $email" , "id DESC"); 
			$kq_user = $bang_user -> getResult_select();
			if(mysqli_num_rows($kq_user) <= 0) header("Location: ../dangnhap.php");
		$ma_pass = rand(100000, 999999); 
		setcookie("ma_pass", $ma_pass, time() + 180,'/');
		include ('../sendMail/PHPMailerAutoload.php');
    	$mail = new PHPMailer;
	   	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'phanvanphung215@gmail.com';                     // SMTP username
	    $mail->Password   = '2152001AbcD';                               // SMTP password
	    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;  

	    $mail->setFrom('phanvanphung215@gmail.com', 'am thuc');
	    $mail->addAddress($email , 'Hello you');     // Add a recipient
	    // $mail->addAddress('ellen@example.com');               // Name is optional
	    // $mail->addReplyTo('info@example.com', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');
	      $mail->isHTML(true);                                  // Set email format to HTML
	   	$mail->Subject = 'Quen mat khau!';
   		$mail->Body    = "<p>Bạn đang truy cập web ẩm thực </p><p>Mã : <b>$ma_pass</b></p>";
    	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


	    if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}
	if(isset($_POST['ma'])){
		$ma  = $_POST['ma']; 
		$email = $_POST['email1'];
		if( $ma == $_COOKIE['ma_pass']){
			echo "<script>alert('Bạn Nhập mã thành công');  </script>";
				header("Location: ../update_pass.php?email=$email");
	?>
	
	<?php 

		}else {
			echo "<script>alert('Bạn Nhập sai'); history.back(); </script>";

		}

	}
	if(isset($_POST['pass'])){
		if($_POST['pass'] == $_POST['re_pass']){
			$pass = md5($_POST['pass']);
			if(!isset($conn)){
				require 'Xuly_ketNoiSQL.php'; 
				$conn1 = new connectSQL ; // kết nối đến sql
				$conn1 -> setconnect();
				$conn = $conn1-> getconnect(); 
			}
			$email = $_POST['email'];
			$bang_user = new bang($conn, 'user');
		
			$bang_user->setResult_update(" password = '$pass' ", " email = '$email'"); 
			header("Location: ../dangnhap.php");
		}
	}
?>