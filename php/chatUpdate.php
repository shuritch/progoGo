<?php		
			$link = mysqli_connect("localhost", "root", "", "progogo");
			$sql = 'SELECT message, name,photo,admin, time FROM chat ORDER BY id DESC';
			$result = mysqli_query($link, $sql);
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			$query = mysqli_query($link, 'SELECT COUNT(*) FROM chat');
			$Num = mysqli_fetch_row($query)[0];
			mysqli_close($link);
			foreach ($rows as $row) {
   			 $user_photo[] = $row["photo"];
   			 $user_name[] = $row["name"];
   			 $message_time[] = $row["time"];
   			 $user_message[] = $row["message"];
   			 $user_admin[] = $row["admin"];
			}

			for ($i=$Num; $i != -1; $i--) { 
			if($user_admin[$i] == 'true'){$style = "style=color:#f90;";}
			else if($user_admin[$i] == 'bot'){$style = "style=color:#0ae;";}
			else{$style = "style=color:#fff;";}
			$timem =  explode('.', $message_time[$i]);
			echo '<div class="message">
			<div class="userimg" style = "background:url('.$user_photo[$i].') no-repeat center center; background-size:contain;"></div>
			<div class="userinfo">
				<div '.$style.' class="usernamewithdate">'.$user_name[$i].' <span style = "font-size:0.5em;">'.$timem[0].'</span></div>
				<div class="usermessage"><p>'.$user_message[$i].'</p></div>
			</div>
		</div>';

	}


?>