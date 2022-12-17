<?php


	if (isset($_POST['User']) && isset($_POST['Email']) && isset($_POST['Password']) && trim($_POST['User'])!='' && trim($_POST['Email'])!='' && trim($_POST['Password'])!='') {
		
		$conn = new mysqli('localhost','root','','progogo');
		$conn -> set_charset('utf8');
		if ($conn->connect_error) {
    		die("Ошибка соединения: " . $conn->connect_error);
		} 
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
		$name = $_POST['User'];
		$pass = $_POST['Password'];
		$mail = $_POST['Email'];

		$sql = 'SELECT email FROM users';
		$result = mysqli_query($conn, $sql);

		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$query = mysqli_query($conn, 'SELECT COUNT(*) FROM users');
		$Num = mysqli_fetch_row($query)[0];

		foreach ($rows as $row) {
   			 $user_email[] = $row["email"];
   			 
		}
		$emailexist = 'no';
		for ($i=0; $i < $Num; $i++) { 

		if ($user_email[$i] == $mail) {
			$emailexist = 'exist';
			mysqli_close($conn);
			header('refresh:0.1;url= /index.php');
			echo('<script>alert("у вас уже есть учётная запись!");</script>');
			break;
			}
			
		}
		if($emailexist != 'exist'){
			$sql = "INSERT INTO users(id,name, password, email,ip) VALUES (0,'".$name."','".$pass."','".$mail."','".$visitor_ip."')";
				if ($conn->query($sql) === TRUE) {
					$userInformation = $mail. '/' .$pass; 
					setcookie("ClientInfo",$userInformation, time()+3600000, '/');
					mysqli_close($conn);
					header('Location: /index.php');
   					exit();
   				}
		}
		
   }
   	else if (isset($_POST['EmailL']) && isset($_POST['PasswordL']) && trim($_POST['EmailL']!='') && trim($_POST['PasswordL']!='')) {

		$link = mysqli_connect("localhost", "root", "", "progogo");

		$sql = 'SELECT email, password FROM users';

		$result = mysqli_query($link, $sql);

		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$query = mysqli_query($link, 'SELECT COUNT(*) FROM users');
		$Num = mysqli_fetch_row($query)[0];
		mysqli_close($link);
		foreach ($rows as $row) {
   			
   			 $user_password[] = $row["password"];
   			 $user_login[] = $row["email"];

			}
	
	$log = $_POST['EmailL'];
	$pass = $_POST['PasswordL'];
	for ($i=0; $i < $Num + 1; $i++) { 

		if ($user_login[$i] == $log and $user_password[$i] == $pass) {
			$userInformation = $log. '/' .$pass; 
			
			setcookie("ClientInfo",$userInformation, time()-3600000, '/');
			setcookie("ClientInfo",$userInformation, time()+3600000, '/');
			$ItsOK = 'ok';
			

			header('refresh:0.1;url= /index.php');

			break;
		}
		else{
			
			$ItsOK = 'no';
		}
	}
	if($ItsOK == 'no'){
			header('refresh:0.1;url= /index.php');
			echo('<script>alert("Неверно введены данные! '.$log.' '.$pass.'");</script>');
	}

	

}


	else if(isset($_POST['exitfromacc'])){
		setcookie("ClientInfo",$userInformation, time()-3600000, '/');
		header('Location: /index.php');
	}
	else{
		
		header('refresh:0.1;url= /index.php');
		echo "<script>alert('заполнены не все поля!')</script>";
		exit();
	}

?>
