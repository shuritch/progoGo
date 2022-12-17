<?php
	$error_info = '';
    $error_count = 0;
    //password
	if (isset($_POST['oldpass']) && trim($_POST['oldpass'] != '') && isset($_POST['newpass']) && trim($_POST['newpass'] != '') && isset($_POST['repeatnewpass']) && trim($_POST['repeatnewpass'] !='')) {
		if(isset($_SESSION["loginkey"])){
			$oldpass = $_POST['oldpass'];
			$newpass = $_POST['newpass'];
			$repeatnewpass = $_POST['repeatnewpass'];
			include 'connection.php';
			global $connection;
			$user_mail = strval($_SESSION["loginkey"]);
			$sql = "SELECT password FROM users WHERE email = '$user_mail'";
			$resultcomand = mysqli_query($connection, $sql);
			$user_password = mysqli_fetch_row($resultcomand);
			if(strlen(trim($pass)) < 7 or strlen(trim($pass)) > 30)
			{
			$error_info .= '/ Password must be bigger and not so big! /';
			$eror_count+=1;
			}
			$user_pass = $user_password[0];
			if ($user_pass == $oldpass && $eror_count == 0){
				if ($newpass = $repeatnewpass) {
					$sql2 = "UPDATE users SET password = '$newpass' WHERE email = '$user_mail'";
					if ($connection->query($sql2) === TRUE) {
						$response_info = 'You signed in';
					}
					else{
						$error_info .= '/ bad connection /';
						$error_count +=1;
					}
				}
				else{
					$error_info .= '/ new password != repeat password /';
					$error_count +=1;
				}
			}
			else{
				$error_info .= '/ wrong old password /';
				$error_count +=1;
			}
		mysqli_close($connection);
		}
		else{
			$error_info .= '/ how /';
			$error_count +=1;
		}
	}
	//filds 
	else{
		$error_info .= '/ fill all filds /';
		$error_count +=1;
	}
	//out
	if ($eror_count >= 1){
		echo 'error: '.$error_info. ' error count: ' .$eror_count;
	}
	else{
		echo $response_info;
	}
?>