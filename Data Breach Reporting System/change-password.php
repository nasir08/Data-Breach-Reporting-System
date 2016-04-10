<?php
	require_once("inc/functions.php");
	session_start();
	if(isset($_SESSION['id']))
	{
		$user_id=$_SESSION['id'];
		$user_name=$_SESSION['name'];
		require_once("inc/header.php");
	}
	else
	{
		Redirect("index.php");
	}
?>
<!-- navigation starts here -->
<div id="nav-wrap">
  <div id="nav">
    <ul>
      <li><a href="timeline.php">Timeline</a></li>
      <li><a href="my-reports.php">My Reports</a></li>
      <li><a href="make-report.php">Make Report</a></li>
      <li id="current"><a href="change-password.php">Change Password</a></li>
      <li><a href="support.php">Support</a></li>
      <li><a href="signout.php">Sign Out</a></li>
    </ul>
  </div>
</div>
<!-- content-wrap starts here -->
<div id="content-wrap">
  <div id="content">
    <div id="main">
      <div class="box">
        <form action="" method="post">
          <p>
          <?php
                  if(isset($_POST['submit']))
                  {
					 $oldPword=trim($_POST['oldPword']);
					 $newPword=trim($_POST['newPword']);
					 $cnewPword=trim($_POST['cnewPword']);
					 if($oldPword=="")
					 { echo"<b>Please enter your current password.</b><br><br>"; }
					 elseif($newPword=="")
					 { echo"<b>Please enter new password.</b><br><br>"; }
					 
					 elseif($cnewPword=="")
					 { echo"<b>Confirm your new password.</b><br><br>"; }
					  
					 else
					 {
						 $result=mysql_query("SELECT pword FROM users WHERE id='$user_id'");
						 $row=mysql_fetch_array($result);
						 if($row['pword']!=SHA1($oldPword))
						 { echo"<b>The current password you entered is incorrect.</b>"; }
						 elseif($cnewPword!=$newPword)
						 { echo"<b>Your new passwords don't match.</b><br><br>"; }
						 else
						 { 
						 $newPword=SHA1($newPword);
						 mysql_query("UPDATE users SET pword='$newPword' WHERE id='$user_id'");
						 echo"<b>Password changed successfully.</b><br><br>";
						 }
					 }
                  }
                  ?>
            <label>Current Password</label>
            <input name="oldPword" type="password" size="30" class="text" />
            <label>New Password</label>
            <input name="newPword" type="password" size="30" class="text" />
            <label>Confirm New Password</label>
            <input name="cnewPword" type="password" size="30" class="text" />
            <br /><br>
            <input class="button" type="submit" value="Change Password" name="submit" />
          </p>
        </form>
      </div>
      <br />
    </div>
    <!-- content-wrap ends here -->
  </div>
</div>
<?php
	require_once("inc/footer.php");
?>