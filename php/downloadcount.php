<?php
if ( isset($_POST['action']) && $_POST['action'] != ''){
	$name = $_POST['action'];
	$conn = mysqli_connect("localhost", "root", "", "progogo");
	$sqlcomand = "SELECT downloadcount FROM apps WHERE app = '".$name."'";
	$resultcomand = mysqli_query($conn, $sqlcomand);
	$thisrow = mysqli_fetch_row($resultcomand);
	$count = $thisrow[0] + 1;
	$sql = "UPDATE apps SET downloadcount='$count' WHERE app='$name'";
	
	if ($conn->query($sql) === TRUE) {
		mysqli_close($conn);
		
   
	}
}

if (isset($_COOKIE['ClientInfo'])){
	$link = mysqli_connect("localhost", "root", "", "progogo");
	$userCookieInfo = $_COOKIE["ClientInfo"];
	$userCookieInfo =  explode('/', $userCookieInfo);
	$log = $userCookieInfo[0];
	$pass = $userCookieInfo[1];
	$sql = 'SELECT email, password FROM users';
	$result = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$query = mysqli_query($link, 'SELECT COUNT(*) FROM users');
	$Num = mysqli_fetch_row($query)[0];
	foreach ($rows as $row) {
   			 $user_password[] = $row["password"];
   			 $user_login[] = $row["email"];
	}
	
		
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
					


	if  ($access == 'true'){
		$sql = "SELECT downloads FROM users WHERE email = '$log'";
		$resultcomand = mysqli_query($link, $sql);
		$thisrows = mysqli_fetch_row($resultcomand);
		$sql = "SELECT name FROM apps WHERE app = '$name'";
		$resultcomand = mysqli_query($link, $sql);
		$thisrows2 = mysqli_fetch_row($resultcomand);
		$downloadsname = $thisrows[0] . '/' . $thisrows2[0]; 
		$sql = "UPDATE users SET downloads='$downloadsname' WHERE email='$log'";
	}
	if ($link->query($sql) === TRUE) {
	}
	mysqli_close($link);
}	

?>