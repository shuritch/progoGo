<?php 
	if (isset($_COOKIE['ClientInfo'])) {
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
		$userCookieInfo = $_COOKIE["ClientInfo"];
		$userCookieInfo =  explode('/', $userCookieInfo);
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
	

	if(isset($_COOKIE['ClientInfo'])  && isset($_POST['about']) && isset($_FILES['fileimg']) && isset($_FILES['applec']) && isset($_POST['razdel']) && $_POST['razdel']!=''  && $_POST['filename']!='' && $_POST['about']!='' && $_FILES['applec']!='' && $_FILES['fileimg']!='' && $access == 'true'){
		$filename3 = $_POST['filename'];
		$about =  $_POST['about'];
		$razdel =  $_POST['razdel'];
		$conn = new mysqli('localhost','root','','progogo');
		$conn -> set_charset('utf8');
		if ($conn->connect_error) {
    		die("Ошибка соединения: " . $conn->connect_error);

		} 
		
			 $allowed_filetypes = array('.jpg','.gif','.bmp','.png','.ico');
			 $max_filesize = 11524288;
			 $upload_path = 'W:/domains/progogo/app/img/';     
			 $upload_path2 = 'W:/domains/progogo/app/';
   			 $filename = $_FILES['fileimg']['name'];
   			 $filename2 = $_FILES['applec']['name'];
     		 $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
     		 if(!in_array($ext,$allowed_filetypes)) // Сверяем полученное расширение со списком допутимых расширений. 
			die('Данный тип файла не поддерживается.'.$filename);

			if(filesize($_FILES['fileimg']['tmp_name']) > $max_filesize) // Проверим размер загруженного файла.
			die('Фаил слишком большой.');

			if(!is_writable($upload_path)) // Проверяем, доступна ли на запись папка.
			die('Невозможно загрузить фаил в папку. Установите права доступа - 777.');

			// Загружаем фаил в указанную папку.
			if(move_uploaded_file($_FILES['fileimg']['tmp_name'],$upload_path . $filename) && move_uploaded_file($_FILES['applec']['tmp_name'],$upload_path2 . $filename2))
			{
				$sql = "INSERT INTO apps(id,name, photo, razel,app,about) VALUES (0,'".$filename3."','http://progogo/app/img/".$filename."','".$razdel."','".$filename2."','".$about."')";
			    
			} else {
			    echo 'При загрузке возникли ошибки. Попробуйте ещё раз.';
			}
		
		
		
		if ($conn->query($sql) === TRUE) {
			mysqli_close($conn);
			
			header('Location: http://progogo/php/pages/profile.php');
   		exit();
   		}
	}
	else{
		echo'введены не все поля';
		echo $_POST['razdel'],$_POST['filename'],$_POST['about'], $_FILES['applec'],$_FILES['fileimg'];
		header('refresh:0.1;url= http://progogo/php/pages/profile.php');
		
	}

?>