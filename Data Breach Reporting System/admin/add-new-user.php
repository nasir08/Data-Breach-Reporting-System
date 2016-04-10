<?php
require_once("../inc/functions.php");
session_start();
if(!(isset($_SESSION['id'])))
{
	Redirect('index.php');
}
else
{
	$id=$_SESSION['id'];
	Require_once('inc/header.php');
}
?>

	<div id="content">
    <?php
		Require_once('inc/sidebar.php');
	?>
		<div id="main">
			<div class="clear"></div>
			<div class="full_w">
			  <div class="h_title">Manage Users</div>
				<h2>Add New User</h2>
				<div class="entry">
				  <div class="sep"></div>
				</div>
				<form action="" method="post">
                  <?php
                  if(isset($_POST['submit']))
                  {
					 $name=mysql_real_escape_string(trim($_POST['name']));
					 $uname=mysql_real_escape_string(trim($_POST['uname']));
					 $password=trim($_POST['password']);
					 if($name=="")
					 { echo"<b>Please enter the full name of the user.</b>"; }
					 elseif($uname=="")
					 { echo"<b>Please enter a username.</b>"; }
					 
					 elseif($password=="")
					 { echo"<b>Please enter a password.</b>"; }
					  
					 else
					 {
						 $result=mysql_query("SELECT COUNT(id) FROM users WHERE uname='$uname'");
						 $row=mysql_fetch_row($result);
						 if($row[0]>0)
						 { echo"<b>The username \"$uname\" belongs to another user.</b>"; }
						 else
						 {
						 $password=SHA1($password);
						 mysql_query("INSERT INTO users (name,uname,pword,status) VALUES('$name','$uname','$password','Unblocked')");
						Redirect('all-users.php');
						 }
					 }
                  }
				  elseif(isset($_POST['cancel']))
				  {
					  Redirect('all-users.php');
				  }
                  ?>
                  
					<div class="element">
						<label for="name">Full Name</label>
						<input id="name" name="name" class="text" type="text" />
                        <br><br>
						<label for="uname">Username</label>
						<input id="name" name="uname" class="text" type="text" />
                        <br><br>
						<label for="password">Password</label>
						<input id="name" name="password" class="text" type="text" />
					</div>
					<div class="entry">
                     <button type="submit" class="add" name="submit">Add User</button> <button class="cancel" type="submit" name="cancel">Cancel</button>
					</div>
				</form>
				<div class="entry">
                <div class="pagination">
                 
					</div>
					<div class="sep"></div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<?php
	Require_once('inc/footer.php');
?>