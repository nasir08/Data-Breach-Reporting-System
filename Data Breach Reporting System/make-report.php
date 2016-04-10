<?php
	require_once("inc/functions.php");
	session_start();
	if(isset($_SESSION['id']))
	{
		$user_id=$_SESSION['id'];
		$user_name=$_SESSION['name'];
		require_once("inc/header.php");
		$msg="";
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
      <li id="current"><a href="make-report.php">Make Report</a></li>
      <li><a href="change-password.php">Change Password</a></li>
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
        <h3>Detailed Report On Data Breach</h3>
        <form action="" method="post">
          <p>
          <?php
		  if(isset($_POST['submit']))
		  {
			  $type=$_POST['breach-type'];
			  $other=mysql_real_escape_string(trim(ucfirst($_POST['other'])));
			  $details=mysql_real_escape_string(trim(ucfirst($_POST['details'])));
			  
			  if(($type=="none") && ($other==""))
			  {
				  $msg="Select/Enter a breach type";
			  }
			  elseif($details=="")
			  {
				  $msg="Enter details about the breach";
			  }
			  else
			  {
				  if($type=="none")
				  {
					  $type=$other;
				  }
				  $today=date('Y')."-".date('m')."-".date('d');
				  $now=date('G:i');
				  mysql_query("INSERT INTO reports (user,date,time,type,details,status) VALUES('$user_id','$today','$now','$type','$details','unreviewed')");
				  $msg="Report sent";
			  }
			 
			  if($msg!="")
			       {
				     $msg=strtoupper($msg);
				     echo "<b>".$msg."</b><br /><br />";
			       }
		  }	
		  ?>
            <label>Breach Type</label>
            <select class="dropdown" name="breach-type">
            	<option value="none">---SELECT BREACH TYPE---</option>
            	<option value="Hacking">Hacking or Malware</option>
                <option value="Phishing">Phishing</option>
                <option value="Unintended Disclosure">Unintended Disclosure</option>
                <option value="Payment Card Fraud">Payment Card Fraud</option>
                <option value="Insider">Insider</option>
                <option value="Physical Loss">Physical Loss</option>
                <option value="Portable Device">Portable Device</option>
                <option value="Stationary Device">Stationary Device</option>
                <option value="Unknown">Unknown</option>
            </select>
            <label>Other (Please specify)</label>
            <input name="other" type="text" size="30" class="text" />
            <label>Details</label>
            <textarea rows="5" cols="5" name="details"></textarea>
            <br />
            <input class="button" type="submit" value="Submit" name="submit" />
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