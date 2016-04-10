<?php
	require_once("inc/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body{
	margin:0px;
	padding:0px;	
}

#login-wrap{
	height:650px;
	width:100%;
}
.login-box{
	background-color:#1183DA;
	border: 2px solid #ddd;
	border:1px solid #06F;
	border-radius:7px;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}
.logo {
	float: left; 
	margin: -70px -70px 0 -60px;
}
#field-container{
	min-height:20px;
	padding:0 70px 0 70px;
}


.login-box .text {  
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#000; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:220px;
}

.login-box .text:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
.login-box .text::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.login-box .button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:235px;
}

.login-box .button:hover { background:#ddd; }



.login-popup{
	display:none;
	background: #333;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:214px;
}

.button:hover { background:#ddd; }
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}
</style>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
</head>

<body>
<table id="login-wrap">
  <tr>
    <td align="center" valign="middle">
   	  <form id="form1" name="form1" method="post" action="">
   	    <table width="40%" border="0" class="login-box">
   	      <tr>
   	        <td><img class="logo" src="images/Babcock_University_Logo.jpg" width="128" height="140" alt="logo" /></td>
          </tr>
   	      <tr>
   	        <td id="field-container">
           	  <table width="100%" border="0">
              <?php
if(isset($_POST['login']))
{
	$uname=$_POST['uname'];
	$pword=sha1($_POST['pword']);
	$result=mysql_query("SELECT COUNT(name),status FROM users WHERE uname='$uname' and pword='$pword'");
	$row=mysql_fetch_row($result);
	if($row[0]>0)
	{
		if($row[1]=="Unblocked")
		{
		$result=mysql_query("SELECT * FROM users WHERE uname='$uname' and pword='$pword'");
	    $row=mysql_fetch_array($result);
		session_start();
		$_SESSION['name']=$row['name'];
		$_SESSION['id']=$row['id'];
		Redirect("timeline.php");
		}
		else
		{
			echo"<center><b>Account Blocked. See site administrator</b></center>";
		}
	}
	else
	{
		echo"<center><b>Invalid Username/Password</b></center>";
	}
}
?>
            	  <tr>
            	    <td>Username</td>
          	    </tr>
            	  <tr>
            	    <td><input type="text" name="uname" class="text" /></td>
          	    </tr>
            	  <tr>
            	    <td></td>
          	    </tr>
            	  <tr>
            	    <td>Password</td>
          	    </tr>
            	  <tr>
            	    <td><input type="password" name="pword" class="text" /></td>
          	    </tr>
            	  <tr>
            	    <td></td>
          	    </tr>
            	  <tr>
            	    <td><input type="submit" name="login" class="button" value="Sign in" /></td>
          	    </tr>
            	  <tr>
            	    <td>&nbsp;</td>
          	    </tr>
            </table></td>
          </tr>
        </table>
     </form></td>
  </tr>
</table>
    </div>
</div>
</body>
</html>
