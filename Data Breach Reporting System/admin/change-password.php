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
			  <div class="h_title">Profile Settings</div>
				<h2>Change Password</h2>
				<div class="entry">
				  <div class="sep"></div>
				</div>
				<form action="" method="post">
                  <?php
                  if(isset($_POST['submit']))
                  {
					 $oldPword=trim($_POST['oldPword']);
					 $newPword=trim($_POST['newPword']);
					 $cnewPword=trim($_POST['cnewPword']);
					 if($oldPword=="")
					 { echo"<b>Please enter your current password.</b>"; }
					 elseif($newPword=="")
					 { echo"<b>Please enter new password.</b>"; }
					 
					 elseif($cnewPword=="")
					 { echo"<b>Confirm your new password.</b>"; }
					  
					 else
					 {
						 $result=mysql_query("SELECT pword FROM admin WHERE id='$id'");
						 $row=mysql_fetch_array($result);
						 if($row['pword']!=SHA1($oldPword))
						 { echo"<b>The current password you entered is incorrect.</b>"; }
						 elseif($cnewPword!=$newPword)
						 { echo"<b>Your new passwords don't match.</b>"; }
						 else
						 { 
						 $newPword=SHA1($newPword);
						 mysql_query("UPDATE admin SET pword='$newPword' WHERE id='$id'");
						 echo"<b>Password changed successfully.</b>";
						 }
					 }
                  }
                  ?>
                  
					<div class="element">
						<label for="oldPword">Current Password</label>
						<input id="name" name="oldPword" class="text" type="password" />
                        <br><br>
						<label for="newPword">New Password</label>
						<input id="name" name="newPword" class="text" type="password" />
                        <br><br>
						<label for="cnewPword">Confirm New Password</label>
						<input id="name" name="cnewPword" class="text" type="password" />
					</div>
					<div class="entry">
                     <button type="submit" class="add" name="submit">Change Password</button>
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