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
      <li id="current"><a href="my-reports.php">My Reports</a></li>
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
	  if(isset($_GET['page']))
				{$page=$_GET['page'];}
				else{$page=1;}
				$from=(($page*10)-10);
	$result=mysql_query("SELECT * FROM REPORTS WHERE user='$user_id' ORDER BY id DESC LIMIT 0,10");
	while($row=mysql_fetch_assoc($result))
	{
		$result2=mysql_query("SELECT name from users WHERE id='$row[user]'");
		$row2=mysql_fetch_array($result2);
		
		
      echo"<div class='box'>
        <h1>$row[type]</h1>
        <p class='post-by'>Reported by <a>me</a></p>
        <p>$row[details]</p>
        <p class='post-footer align-left'>";
		list($y,$m,$d)=explode('-',$row['date']);
		$date=$d."-".$m."-".$y; 
		echo"<span class='date'>$row[time] $date</span>"; 
		
		$result3=mysql_query("SELECT COUNT(feedback) from feedbacks WHERE report='$row[id]'");
		$row3=mysql_fetch_row($result3);
		if($row3[0]>0)
		{ echo"<a href='readmore.php?report_id=$row[id]' class='readmore'>Feedbacks</a>"; }
		
		$result4=mysql_query("SELECT COUNT(comment) from comments WHERE report='$row[id]'");
		$row4=mysql_fetch_row($result4);
		echo"<a href='readmore.php?report_id=$row[id]' class='comments'>Comments ($row4[0])</a>
		<a href='delete-report.php?report_id=$row[id]' class='delete'>Delete</a>
		</p>
      </div>";
	}
	  ?>
      <br />
    </div>
    <!-- content-wrap ends here -->
  </div>
   <?php
  echo"<center>";
         $query="SELECT COUNT(id) FROM reports WHERE user='$user_id'";
         $rs=mysql_query($query);
         $row=mysql_fetch_row($rs);
         $totalRecords=$row[0];
         $total_pages=ceil($totalRecords/10);
         
		 
		 if($total_pages>1)
         {
		 $next=$page+1;
		 $prev=$page-1;
		 if($page>1){echo "<a href=my-reports.php?page=$prev>Prev</a>&nbsp;&nbsp;&nbsp;&nbsp;";}
         echo "Page ".$page." of ".$total_pages;
		 if($total_pages>$page){echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=my-reports.php?page=$next>Next</a>";}
        echo"</center>";
        echo"<br><br>";
		 }
  ?>
</div>
<?php
	require_once("inc/footer.php");
?>