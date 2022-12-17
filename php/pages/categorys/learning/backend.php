<!DOCTYPE html>

<html>
<head>

	<title>backend | progogo.com</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<link rel="stylesheet" type="text/css" href="http://progogo/scss/reset.css">

	<link rel="stylesheet" type="text/css" href="http://progogo/scss/animations.css">
	<link rel="stylesheet" type="text/css" href="http://progogo/scss/main.css">
	<link rel="stylesheet" type="text/css" href="http://progogo/scss/media.css">
	<meta name="description" content="progogo">
	
	<meta name="author" content="AlexanderOrange, batistagenius">
	<link rel="shortcut icon" type="image/png" href="http://progogo/scss/img/favicon.png">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
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
	$link = mysqli_connect("localhost", "root", "", "progogo");
	$sql = 'SELECT downloadcount FROM apps';
	$result = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$query = mysqli_query($link, 'SELECT COUNT(*) FROM users');
	$Num = mysqli_fetch_row($query)[0];
	mysqli_close($link);
	$app_download_count = 0;
	foreach ($rows as $row) {
   			$app_download_count += $row["downloadcount"];
   			

	}
	$link = mysqli_connect("localhost", "root", "", "progogo");
	$sql = 'SELECT ip,visits FROM online';
	$result = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$query = mysqli_query($link, 'SELECT COUNT(*) FROM online');
	$Num = mysqli_fetch_row($query)[0];
	
	$query2 = mysqli_query($link, 'SELECT COUNT(*) FROM apps');
	$files_count = mysqli_fetch_row($query2)[0];
	$users_count = $Num;
	foreach ($rows as $row) {
   		$user_ip[] = $row["ip"];
   		$user_visits[] = $row["visits"];
	}
	$no_ip = 'no';
	$visitor_ip = $_SERVER['REMOTE_ADDR'];
	for ($i=0; $i < $Num; $i++) { 
		if($visitor_ip == $user_ip[$i]){
			$visits =  $user_visits[$i];
			$visits +=1; 
			$no_ip = 'yes';
			$today = date("H:i:s");
			$sql2 = "UPDATE online SET visits='$visits',date='$today' WHERE ip='$visitor_ip'";
			if ($link->query($sql2) === TRUE) {}
			break;
		}
	}	
	if($no_ip == 'no'){

		$sql2 = "INSERT INTO online(id,ip, visits) VALUES (0,'".$visitor_ip."',1)";
		if ($link->query($sql2) === TRUE) {}
	}
	?>
	<header>
	<div id = "navbutton" class="close">
		<span class="navclose"></span>
		<span class="navclose"></span>
		<span class="navclose"></span>
	</div>
	<div id="secheaderpart">
	<div id="logoblock">
		<div id="logoimg"><div class="img"></div></div>
		<div id="logotext">
			<h2 id="brandname">progo go</h2>
			<h2 id="shortabout">ALL FOR ALL</h2>
		</div>
	</div>
	<div id="trandbuttons">
		<a href="http://progogo/" style="text-decoration: none;" class="toptrands"><img src="http://progogo/scss/img/fire2.png"> популярное</a>
		<a href="http://progogo/php/new.php" style="text-decoration: none;" class="toptrands"><img src="http://progogo/scss/img/new.png">новенькое</a>
		<h2 class="toptrands"><img src="http://progogo/scss/img/vk.png">наш вк</h2>
		<h2 class="toptrands"><img src="http://progogo/scss/img/telegram.png">наш телеграм</h2>
	</div>
	<form id="search" action="http://progogo/php/search.php" method="get">
		<input type="text" name="search">
		<button type="submit"></button>
	</form>
	<div id="search2"></div>
</div>
	<div id="scrollLength"></div>
</header>
<div id= "sort">
<div id="secContainer">	
<div id="navbar">
<form id="search3" action="http://progogo/php/search.php" method="get">
		<input type="text" name="search">
		<button type="submit"></button>
</form>
	<!--НАВИГАЦИЯ-->
<div id="programsinform">
	<div><span></span><?php echo $files_count; ?> файлов</div>
	<div><span></span> <?php echo $users_count; ?> пользователей</div>
	<div><span></span><?php echo $app_download_count; ?> скачиваний</div>
</div>	
<ul class="nav">
		<h2 class="cotegory">категории</h2>
		<li class="nav__item">
			<a href="#" tp = "first" class="nav__item-link">
			<span style="background: url(http://progogo/scss/img/windows.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/windows.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span> софт для windows</a>
			<div id="first" class="nav__submenu">
				<a href="http://progogo/php/pages/categorys/windows-soft/security.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/security.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/security.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -5px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>безопасность</a>
				<a href="http://progogo/php/pages/categorys/windows-soft/system.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/options.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/options.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>система</a>
				<a href="http://progogo/php/pages/categorys/windows-soft/WINdesign.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/sysdesign.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/sysdesign.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -5px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>внешний вид</a>
				<a href="http://progogo/php/pages/categorys/windows-soft/programmer.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/programmer.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/programmer.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>для програмиста</a>
				<a href="http://progogo/php/pages/categorys/windows-soft/other.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/folder.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/folder.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>разное</a>
			</div>
		</li>
		<li class="nav__item">
			<a href="#" tp = "second" class="nav__item-link"><span style="background: url(http://progogo/scss/img/programming.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/programming.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span>разработка</a>
			<div id="second" class="nav__submenu">
				<a href="http://progogo/php/pages/categorys/development/template.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/template.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/template.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>шаблоны</a>
				<a href="http://progogo/php/pages/categorys/development/scripts.php"  class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/java-script.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/java-script.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -5px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>скрипты</a>
				<a href="http://progogo/php/pages/categorys/development/effects.php"  class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/3d.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/3d.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>эффекты</a>
			</div>
		</li>
		<li class="nav__item">
			<a href="#" tp = "third" class="nav__item-link"><span style="background: url(http://progogo/scss/img/disgn.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/disgn.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span>дизайн</a>
			<div id="third" class="nav__submenu">
				<a href="http://progogo/php/pages/categorys/design/imgpacks.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/sunrise.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/sunrise.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>изображения</a>
				<a href="http://progogo/php/pages/categorys/design/icons.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/ico-file.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/ico-file.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>иконки</a>
				<a href="http://progogo/php/pages/categorys/design/fonts.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/font.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/font.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -3px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>шрифты</a>
			</div>
		</li>
		<li class="nav__item">
			<a href="#" tp = "four" class="nav__item-link"><span style="background: url(http://progogo/scss/img/hacking.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/hacking.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span>кибербезопастность</a>
			<div id="four" class="nav__submenu">
				<a href="http://progogo/php/pages/categorys/cyber-security/soft.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/console.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/console.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>софт</a>
				<a href="http://progogo/php/pages/categorys/cyber-security/database.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/server.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/server.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>база данных</a>
			</div>
		</li>
		<li class="nav__item">
			<a href="#" tp = "five" class="nav__item-link"><span style="background: url(http://progogo/scss/img/book.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/book.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span>обучение</a>
			<div id="five" class="nav__submenu">
				<a href="http://progogo/php/pages/categorys/learning/frontend.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/front.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/front.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>веб программист frontend</a>
				<a href="http://progogo/php/pages/categorys/learning/backend.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/back.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/back.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>веб программист backend</a>
				<a href="http://progogo/php/pages/categorys/learning/hacking.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/hacker.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/hacker.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -4px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>хакерство</a>
				<a href="http://progogo/php/pages/categorys/learning/other.php" class="nav__submenu-link"><span style="background: url(http://progogo/scss/img/folder.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: absolute;">
			<span style="background: url(http://progogo/scss/img/folder.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -5px;
			filter: blur(1px);
			opacity: 0.4;"></span>
			</span>другое</a>
			</div>
		</li>
		<li class="nav__item">
			<a href="http://progogo/php/pages/categorys/other.php" tp = "six" class="nav__item-link"><span style="background: url(http://progogo/scss/img/folder.png); height: 22px; width: 22px;
			background-size: cover;z-index: 5; position: relative;">
			<span style="background: url(http://progogo/scss/img/folder.png);height: 30px; width: 30px;
			background-size: cover; 
			z-index: 1; position: absolute;
			top: -4px;
			right: -14px;
			filter: blur(2px);
			opacity: 0.4;"></span>
			</span>другое</a>
		</li>
</ul>
<div id="webchat">
	<h2 class="cotegory" style="color: #0ae;" id="chatname">онлайн чат</h2>
	<div id="chatWindow">
		
	
	</div>
	<div id="writing">
		<form id="messageform" autocomplete="off" style="display: inline-flex; width: 100%; height: 50%; position: relative;" method="post">
		<input style="position: relative;outline: none; width: 75%; height: 100%; position: relative;float: left;" id="messinput" type="text" name="message" placeholder="Пишите здесь">
		<button style="outline: none; position: relative; width: 25%; height: 100%; float: right;" id="messsendbut" type="submit" ></button>
		</form>
		<div id="messagebauttons">
		<?php 
		if ($access == 'true') {
			
		
		echo '<a href ="http://progogo/php/pages/profile.php" class="animabut"';
		}
		else{
			echo '<a href ="#" class="animabut"';
		}
		?>
		<?php 
		if(isset($_COOKIE['ClientInfo']) and $access == 'true'){

			$connection = mysqli_connect("localhost", "root", "", "progogo");
			$userCookieInfo = $_COOKIE["ClientInfo"];
			$userCookieInfo =  explode('/', $userCookieInfo);
			$sqlcomand = 'SELECT photo FROM users WHERE email="'.$userCookieInfo[0].'"';
			$resultcomand = mysqli_query($connection, $sqlcomand);
			$thisrows = mysqli_fetch_row($resultcomand);
			mysqli_close($connection);
			echo 'style="background: url('.$thisrows[0].') no-repeat center center; background-size:contain; "';}?> id="sign"><?php if(isset($_COOKIE['ClientInfo']) and $access = 'true'){echo '
		<form id="ex" method ="post" action ="http://progogo/php/login.php">
		<input name="exitfromacc" value="" type="submit" class = "accexit">
		</form>
		';}?></a>
		<!--smiles <div class="animabut" id="smileselect"></div> -->
		<!-- <input name ="photo" value = "" type="file"  class="animabut"  id="photoselect"> 
		<label class="animabut" for="photoselect"></label>-->
		<div id="lastbutnvis"></div>
		<div id="lastbutnvis"></div>
		<div id="lastbutnvis"></div>
		</div>

		<style type="text/css">
			<?php 
				if(isset($_COOKIE['ClientInfo']) and $access == 'true'){
					echo "
					.accexit{
						outline:none;
						border:none;
						cursor:pointer;
						height:30px;
						width:30px;
						position:absolute;
						bottom:0;
						left:50%;
						transform:translate(0,50%);
						border-radius:50%;
						background:#fff url(http://progogo/scss/img/exit.png) no-repeat center center;
						background-size:contain;

					}
					";
				}
			?>
		</style>

	</div>
	<div id="imgplace">
		
	</div>
</div>
<div id="reklamablock">
	<h2 style="display: none;"  class="cotegory">Реклама</h2>
	<div class="reklama">Здесь могла быть ваша реклама</div>
	<div class="reklama">Здесь могла быть ваша реклама</div>
</div>
<div id="animalogosection">
	<div id="animalogo">
		<div class="circle2"><div class="img"></div></div>
	</div>
</div>
<div id="websiteversion" style="text-align: center;">V0.1 codename: <span>born</span></div>
<div class="empty"></div>

</div>	
</div>
<div id = "container">
<section id="main">
<div class="circle"><div class="img"></div></div>

<svg>
	<filter id="wavy">
		<feTurbulence x="0" y="0" baseFrequency= "0.009" numOctaves="5" seed="2">
			<animate attributeName = "baseFrequency" dur = "60s" values = "0.02;0.05;0.02" repeatCount = "indefinite">
		</feTurbulence>
		<feDisplacementMap in="SourceGraphic" scale = "30">
	</filter>		
</svg>
<style type="text/css">
	
</style>

	

</section>
<div class="headcap">
	<h2>backend</h2>
</div>
<section id = "sec" style="min-height:1000px; height: auto; display: flex; justify-content: flex-start; align-items: center; flex-direction: column;">
	<?php 
	
	$conn = mysqli_connect("localhost", "root", "", "progogo");
	$sql = 'SELECT name,about,date,downloadcount,photo,razel,app FROM apps';	
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$query = mysqli_query($conn, 'SELECT COUNT(*) FROM apps');
	$Num = mysqli_fetch_row($query)[0];
	mysqli_close($conn);
	foreach ($rows as $row) {
   		$app_name[] = $row["name"];
   		$app_about[] = $row["about"];
   		$app_date[] = $row["date"];
   		$app_downloadcount[] = $row["downloadcount"];
   		$app_photo[] = $row["photo"];
   		$app_razel[] = $row["razel"];
   		$app_downloader[] = $row["app"];

	}
	for ($i=0; $i < $Num; $i++) { 
		if($app_razel[$i] == 'backend'){
		echo '
		<div class="app">
		<div style="background: url('.$app_photo[$i].') no-repeat center center; background-size:contain; " class= "appimg">
		</div>
		<div class="appinfo">
			<h2 class="appname">'.$app_name[$i].'</h2>
			<div class="appmoreinfo"><p class="appdate">'.$app_date[$i].'</p><p class="apprazel">'.$app_razel[$i].'</p><p class="appdownloadcount">скачиваний:'.$app_downloadcount[$i].'</p></div>
			<div class="appabout">'.$app_about[$i].'</div>
			<form action = "http://progogo/php/pages/appPage.php" method = "get"><input name="application" value='.$app_photo[$i].' readonly="readonly" style="display:none;"><button type="submit" class="apppage">Скачать</button></form>
		</div>
	</div>
		';
	}
}

	?>
	

</section>
<section id = "lastSection">

</section>

<div id="navmenu"></div>
<div id="profileblock">
	
</div>
</div>

<footer>
	<div id="aboutBlock">
		<div id="logoshortabout">
			<div id="logo2"><div class="img" style="height: 80px;transform:translate(0);top: 0;
			left: 50px; "></div></div>
			<div id="shortabout2">
				<h2>progo go</h2>
				<h2>ALL FOR ALL</h2>
			</div>
		</div>
		<div id="aboutus">
			<h2 style="margin-left: 55px;">Наш сайт «progo go» занимается сбором важных для пользователей материалов из различных сфер деятельности.
		Мы не целенаправленно незаконно распространяем материалы, поэтому если Вы являетесь правообладателем, сообщите нам о нарушении по указанным здесь контактам.</h2>
		</div>
	</div>
	<div id="createdBy">
	<h2 >
		<span id="Createdwhen">C</span>2020. 
		Created by: <a id="AlexanderOrange" href="http://visitcard2/">AlexanderOrange</a>
		batistagenius
		<a href="#" id="company">progogo@gmail.com</a>
	</h2>
	</div>

</footer>
</div>
<div id="loginingmenu">
	<div class="containerr" id="containerr">
	<div id="loginingmenuExit"></div>
	<div class="form-container sign-up-container">
		<form action="http://progogo/php/login.php" method="post">
			<h2 id="create">Create Account</h2>
			<span style="font-size: 0.8em">or use your email for registration</span>
			<input type="text" name="User" placeholder="Name" />
			<input type="email" name="Email" placeholder="Email" />
			<input type="password" name="Password" placeholder="Password" />
			<button class="butr" type="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="http://progogo/php/login.php" method="post">
			<h2 id="signinn">Sign in</h2>
			
			<span style="font-size: 0.8em">or use your account</span>
			<input type="email" placeholder="Email"name="EmailL" />
			<input type="password" placeholder="Password"name="PasswordL" />
			<a href="#" style="font-size: 0.6em;">Forgot your password?</a>
			<button class="butr" type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
 
$('#messageform').submit(function(e) {
	
	e.preventDefault();
	$.ajax({
  	  type: "POST",
  	  url: 'http://progogo/php/chat.php',
  	  data: $(this).serialize(),

      success: function(data) {
      
         

      },
      error: function() {
        alert('There was some error performing the AJAX call!');
      }
   });
setTimeout("$('#chatWindow').scrollTop(1000000)",800);
$('#messinput').val('');
});

for (var i = 1; i < 50; i++) {
		let imgg = $('<img class= "emoji" src= "http://progogo/scss/smiles/img ('+i+').png">'); 
		$('#imgplace').append(imgg);
	}


prepespons = 0;
function load_messages(){
    // Let's use AJAX also to get chatroom's users

    $.ajax({
        url: "http://progogo/php/chatUpdate.php",
        cache: false,
        success: function(response) {
        	if (prepespons == 0){
        		setTimeout("$('#chatWindow').scrollTop(1000000)",1000);
        		prepespons = 1;
   			 }
   			
            $("#chatWindow").html(response);

        }
    });

}
/* emoji if add
$('.emoji').on('click', function(){
	let text = $('#messinput').val();
	let smile = $(this).innerHtml;
	$('#messinput').val(text +' '+ smile);
});
*/

setInterval(load_messages, 500);  

	<?php

	 if(!isset($_COOKIE['ClientInfo']) and $access != 'true'){
		echo "$('.animabut').on('click', function(){
	id = this.id;
	if(id = 'sign'){
		$('#loginingmenu').css('display', 'block');
	}
});
$('#loginingmenuExit').on('click', function(){
	$('#loginingmenu').css('display', 'none');
});
const signUpButton = $('#signUp');
const signInButton = $('#signIn');
const containers = $('#containerr');

signUpButton.on('click', () => {
	containers.addClass('right-panel-active');
	

});
$('#messsendbut').on('click', () =>{
	$('#loginingmenu').css('display', 'block');
});
$('#messinput').on('click', () =>{
	$('#loginingmenu').css('display', 'block');
});
signInButton.on('click', () => {
	containers.removeClass('right-panel-active');
});";
	}
	
	
	/* emoji if add
	else{
		echo "
		$('#smileselect').on('click', () => {
			if ($('#imgplace').css('display') == 'none') {
	$('#imgplace').css('display', 'block');
}else{
	$('#imgplace').css('display', 'none');
}
	});
		";
	}*/
	?>
	
</script>
<script type="text/javascript" src="http://progogo/scripts/script.js"></script>
</body>
</html>