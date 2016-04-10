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
		
		if(isset($_GET['page']))
		{
			if(isset($_GET['report_id']))
			{
				if(isset($_GET['reporter']))
				{
					$name=base64_decode($_GET['reporter']);
				}
				else
				{ Redirect('dashboard.php'); }
			}
			else
			{ Redirect('dashboard.php'); }
		}
		else
		{ Redirect('dashboard.php'); }
		
		$result=mysql_query("SELECT details FROM reports WHERE id='$_GET[report_id]'");
		$row=mysql_fetch_array($result);
	?>
<div id="main">
			<div class="full_w">
				<div class="h_title">Data Breach Report</div>
				<h2><?php echo $name; ?></h2>
				<p><?php echo $row['details']; ?></p>
			</div>
			<div class="clear"></div>
			<div class="full_w">
				<div class="h_title">Send a feedback</div>
				  <form action="" method="post">
                  <?php
                  if(isset($_POST['submit']))
                  {
					 $today=date('Y')."-".date('m')."-".date('d');
				     $now=date('G:i');
					 $feedback=mysql_real_escape_string(trim($_POST['feedback']));
					 if($feedback=="")
					 { echo"<center><b>Please enter feedback to send to the user.</b></center>"; } 
					 else
					 {
						 mysql_query("INSERT INTO feedbacks (feedback,date,time,report) VALUES('$feedback','$today','$now','$_GET[report_id]')");
						 
						 mysql_query("UPDATE reports SET status='reviewed' WHERE id='$_GET[report_id]'");
						 echo"<center><b>Feedback Sent</b></center>";
					 }
                  }
				  elseif(isset($_POST['cancel']))
				  {
					  Redirect($_GET['continue']."?page=".$_GET['page']);
				  }
                  ?>
                  
					<div class="element">
						<label for="content">Your Feedback</label>
						<textarea name="feedback" class="textarea" rows="10"></textarea>
					</div>
					<div class="entry">
                     <button type="submit" class="add" name="submit">Send</button> <button class="cancel" type="submit" name="cancel">Cancel</button>
					</div>
				</form>
			</div>
		</div>
        </div>
        <?php
	Require_once('inc/footer.php');
?>