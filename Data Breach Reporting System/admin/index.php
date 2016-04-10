<?php
	require_once("../inc/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title>SimpleAdmin</title>
<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w">
            <?php
			if(isset($_POST['login']))
			{
				$username=mysql_real_escape_string(trim($_POST['user']));
				$pass=SHA1(trim($_POST['pass']));
				if($username=="")
				{ echo "<br /><center><b>Please enter your username</b></center>"; }
				elseif($pass=="")
				{ echo "<br /><center><b>Please enter your password</b></center>"; }
				else
				{
					$result=mysql_query("SELECT COUNT(id) FROM admin WHERE uname='$username' and pword='$pass'");
					$row=mysql_fetch_row($result);
					if($row[0]==0)
					{  echo "<br /><center><b>Invalid Username/Password</b></center>"; }
					else
					{
					$result=mysql_query("SELECT * FROM admin WHERE uname='$username' and pword='$pass'");
					$row=mysql_fetch_array($result);
					session_start();
					$_SESSION['name']=$row['name'];
					$_SESSION['id']=$row['id'];
					Redirect('dashboard.php');
					}
				}
			}
            
			?>
				<form action="" method="post">
					<label for="login">Username:</label>
					<input id="login" name="user" class="text" />
					<label for="pass">Password:</label>
					<input id="pass" name="pass" type="password" class="text" />
					<div class="sep"></div>
					<button type="submit" class="ok" name="login">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
