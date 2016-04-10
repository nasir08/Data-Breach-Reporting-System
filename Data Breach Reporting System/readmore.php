<link rel="stylesheet" href="images/layout.css" type="text/css" />
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
      <li><a href="make-report.php">Make Report</a></li>
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
    <?php
    if(isset($_GET['report_id']))
	{
		$rid=$_GET['report_id'];
	$result=mysql_query("SELECT * FROM feedbacks WHERE report='$rid' ORDER BY id DESC");
	$result2=mysql_query("SELECT COUNT(id) FROM feedbacks WHERE report='$rid' ORDER BY id DESC");
	$row2=mysql_fetch_row($result2);
	if($row2[0]>0)
	{
		echo"<div class='box'>
		<h3>Admin's Feedback</h3>";
	while($row=mysql_fetch_assoc($result))
	{
      echo"<p>$row[feedback]</p>
        <p class='post-footer align-left'>";
		list($y,$m,$d)=explode('-',$row['date']);
		$date=$d."-".$m."-".$y; 
		echo"<span class='date'>$row[time] $date</span>
		</p>";
	}
	echo"</div><br><br>";
	}
	}
	else
	{
		Redirect("timeline.php");
	}
	  ?>
    
    <?php
	echo"<a name=comments>";
	$result=mysql_query("SELECT * FROM comments WHERE report='$rid'");
	$result2=mysql_query("SELECT COUNT(id) FROM comments WHERE report='$rid'");
	$row2=mysql_fetch_row($result2);
	if($row2[0]==0)
	{ echo"No comments yet."; }
	else
	{
	while($row=mysql_fetch_assoc($result))
	{
		echo"<div class='box'>";
		$result2=mysql_query("SELECT name from users WHERE id='$row[user]'");
		$row2=mysql_fetch_array($result2);
		
        echo"<p class='post-by'><a>$row2[name]</a> said</p>
        <p>$row[comment]</p>
        <p class='post-footer align-left'>";
		list($y,$m,$d)=explode('-',$row['date']);
		$date=$d."-".$m."-".$y; 
		echo"<span class='date'>$row[time] $date</span>
		</p>
		</div>";
	}
	}
	  ?>
      <div class="box">
      <form action="" method="post" enctype="multipart/form-data">
          <p>
          <?php
		  if(isset($_POST['submit']))
		  {
			  $comment=mysql_real_escape_string(trim($_POST['comment']));
			  
			   $today=date('Y')."-".date('m')."-".date('d');
			   $now=date('G:i');
			   
			   if($comment=="")
			   { }
			   else
			   {
				   mysql_query("INSERT INTO comments (comment,report,date,time,user) VALUES('$comment','$rid','$today','$now','$user_id')");
				  Redirect("readmore.php?report_id=".$rid); 
			   }
		  }	
		  ?>
            <label>Your Comment</label>
            <textarea rows="5" cols="5" name="comment"></textarea>
            <br />
            <input class="button" type="submit" value="Comment" name="submit" />
          </p>
          </form>
      </div>
      </a>
      <br />
      
    </div>
    <!-- content-wrap ends here -->
  </div>
</div>
<?php
	require_once("inc/footer.php");
?>