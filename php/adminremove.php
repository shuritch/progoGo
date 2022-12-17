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
if(isset($_COOKIE['ClientInfo']) && isset($_POST['filename']) && $_POST['filename'] != '' && $access == 'true'){
	$conn = new mysqli('localhost','root','','progogo');
	$conn -> set_charset('utf8');

	if ($conn->connect_error) {
    		die("Ошибка соединения: " . $conn->connect_error);

	} 
	$filename = $_POST['filename'];	
	$sqlcomand = "SELECT app FROM apps WHERE name = '".$filename."'";
	$sql2 = "SELECT photo FROM apps WHERE name = '".$filename."'";	
	$resultcomand = mysqli_query($conn, $sqlcomand);
	$thisrow = mysqli_fetch_row($resultcomand);
	$resultcomand = mysqli_query($conn, $sql2);
	$thisrow2 = mysqli_fetch_row($resultcomand);
	$path = substr(strrchr($thisrow2[0], "/"), 1);
	if(unlink('W:/domains/progogo/app/'.$thisrow[0].''));
	if(unlink('W:/domains/progogo/app/img/'.$path.''));
	$sql = "DELETE FROM apps WHERE name = '$filename'"	;

	if ($conn->query($sql) === TRUE) {

		mysqli_close($conn);
		header('Location: http://progogo/php/pages/profile.php');
   	exit();
   	}
}
else{
		echo'введены не все поля';
		header('refresh:0.1;url= http://progogo/php/pages/profile.php');
}