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
	if(isset($_POST['message']) && $_POST['message'] != '' && isset($_COOKIE['ClientInfo']) && $access = 'true'){
		$conn = new mysqli('localhost','root','','progogo');
		$conn -> set_charset('utf8');
		$message = $_POST['message'];

		$userCookieInfo = $_COOKIE["ClientInfo"];
		$userCookieInfo =  explode('/', $userCookieInfo);

		$sql = 'SELECT photo FROM users WHERE email="'.$userCookieInfo[0].'"';
		$resultcomand = mysqli_query($conn, $sql);
		$thisrows = mysqli_fetch_row($resultcomand);
		$photo = $thisrows[0]; 

		$sql = 'SELECT name FROM users WHERE email="'.$userCookieInfo[0].'"';
		$resultcomand = mysqli_query($conn, $sql);
		$thisrows = mysqli_fetch_row($resultcomand);
		$name = $thisrows[0]; 

		$sql = 'SELECT admin FROM users WHERE email="'.$userCookieInfo[0].'"';
		$resultcomand = mysqli_query($conn, $sql);
		$thisrows = mysqli_fetch_row($resultcomand);
		$admin = $thisrows[0];

		$sql = "INSERT INTO chat(id,name, photo, message,admin) VALUES (0,'".$name."','".$photo."','".$message."','".$admin."')";

		if ($conn->query($sql) === TRUE) {
		mysqli_close($conn);
		header('Location: /index.php');
   		exit();
	}
	}
	else{
		header('Location: /index.php');
		echo "заполнены не все поля";
	}
?>