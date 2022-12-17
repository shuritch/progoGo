<?php 
	if (isset($_COOKIE['ClientInfo'])) {
		$link = mysqli_connect("localhost", "root", "", "progogo");

		$sql = 'SELECT email, password FROM users';
		$userCookieInfo = $_COOKIE["ClientInfo"];
		$userCookieInfo =  explode('/', $userCookieInfo);
		$result = mysqli_query($link, $sql);

		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$query = mysqli_query($link, 'SELECT COUNT(*) FROM users');
		$Num = mysqli_fetch_row($query)[0];
		mysqli_close($link);
		foreach ($rows as $row) {
   			
   			 $user_password[] = $row["password"];
   			 $user_login[] = $row["email"];
   			 
			}
		for ($i=0; $i < $Num; $i++) { 
		if($user_login[$i] ==  $_POST['email/'] and $user_login[$i] != $userCookieInfo[0]){
			$ItsOK = 'no';
			$access = 'false';
			
			header('refresh:0.1;url= http://progogo/php/pages/profile.php');
			echo "<script>alert('Такая почта уже существует')</script>";
			exit();

		}
	}
		
		$log = $userCookieInfo[0];
		$pass = $userCookieInfo[1];

		if (isset($_COOKIE['ClientInfo'])) {
		
		for ($i=0; $i < $Num; $i++) { 
		

		if ($user_login[$i] == $log and $user_password[$i] == $pass) {

			$userInformation = $log. '/' .$pass; 
			
			$ItsOK = 'ok';
			
			$access = 'true';	
			
			break;
		}
		
			else{
			$ItsOK = 'no';
			$access = 'false';
		}
	}
					
}

}
	
	if(isset($_COOKIE['ClientInfo']) && isset($_POST['name/']) && isset($_POST['password/']) && isset($_POST['email/']) && trim($_POST['name/'])!='' && trim($_POST['password/'])!='' && trim($_POST['email/'])!='' && $access == 'true'){
		$email = $_POST['email/'];
		$name =  $_POST['name/'];
		$password =  $_POST['password/'];
		$conn = new mysqli('localhost','root','','progogo');
		$conn -> set_charset('utf8');
		if ($conn->connect_error) {
    		die("Ошибка соединения: " . $conn->connect_error);

		} 
		if(isset($_FILES['img']) && $_FILES['img']['error']== UPLOAD_ERR_OK){
			 $allowed_filetypes = array('.jpg','.gif','.bmp','.png');
			 $max_filesize = 1524288;
			 $upload_path = 'W:/domains/progogo/scss/img/userimg/';     
			 
   			 $filename = $_FILES['img']['name'];
     		 $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
     		 if(!in_array($ext,$allowed_filetypes)) // Сверяем полученное расширение со списком допутимых расширений. 
			die('Данный тип файла не поддерживается.');

			if(filesize($_FILES['img']['tmp_name']) > $max_filesize) // Проверим размер загруженного файла.
			die('Фаил слишком большой.');

			if(!is_writable($upload_path)) // Проверяем, доступна ли на запись папка.
			die('Невозможно загрузить фаил в папку. Установите права доступа - 777.');

			// Загружаем фаил в указанную папку.
			if(move_uploaded_file($_FILES['img']['tmp_name'],$upload_path . $filename))
			{
				$sql = "UPDATE users SET name='$name', email='$email', password='$password',photo='http://progogo/scss/img/userimg/$filename' WHERE email='$log'";
			    
			} else {
			    echo 'При загрузке возникли ошибки. Попробуйте ещё раз.';
			}
		}
		else{
			$sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE email='$log'";
		}
		
		
		if ($conn->query($sql) === TRUE) {
			mysqli_close($conn);
			$userInformation = $email.'/'.$password;
			setcookie("ClientInfo",$userInformation, time()-3600000, '/');
			setcookie("ClientInfo",$userInformation, time()+3600000, '/');
			header('Location: http://progogo/php/pages/profile.php');
   			exit();
   	}
	}
	else if(isset($_POST['email/'])){
			echo "<script>alert('Такая почта уже существует')</script>";
			header('refresh:0.1;url=http://progogo/php/pages/profile.php');
	}
	else{
		header('Location: http://progogo/php/pages/profile.php');
	}

?>