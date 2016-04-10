<?php
	require_once("inc/functions.php");
	session_start();
	if(isset($_SESSION['id']))
	{
		$user_id=$_SESSION['id'];
		$user_name=$_SESSION['name'];
	}
?>
<div id="content-wrap">
  <div id="content">
    <div id="main">
    <?php
	if(isset($_GET['page']))
				{$page=$_GET['page'];}
				else{$page=1;}
				$from=(($page*10)-10);
	$result=mysql_query("SELECT * FROM REPORTS ORDER BY id DESC LIMIT 0,10");
	while($row=mysql_fetch_assoc($result))
	{
		$result2=mysql_query("SELECT name from users WHERE id='$row[user]'");
		$row2=mysql_fetch_array($result2);
		
		
      echo"<div class='box'>
        <h1>$row[type]</h1>
        <p class='post-by'>Reported by <a>$row2[name]</a></p>
        <p>$row[details]</p>
        <p class='post-footer align-left'> 
		<span class='date'>$row[time] $row[date]</span>"; 
		
		$result3=mysql_query("SELECT COUNT(feedback) from feedbacks WHERE report='$row[id]'");
		$row3=mysql_fetch_row($result3);
		if($row3[0]>0)
		{ echo"<a href='readmore.php?report_id=$row[id]#feedbacks' class='readmore'>Feedbacks</a>"; }
		
		$result4=mysql_query("SELECT COUNT(comment) from comments WHERE report='$row[id]'");
		$row4=mysql_fetch_row($result4);
		echo"<a href='readmore.php?report_id=$row[id]#comments' class='comments'>Comments ($row4[0])</a>
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
         $query="SELECT COUNT(id) FROM reports";
         $rs=mysql_query($query);
         $row=mysql_fetch_row($rs);
         $totalRecords=$row[0];
         $total_pages=ceil($totalRecords/10);
         
		 
		 if($total_pages>1)
         {
		 $next=$page+1;
		 $prev=$page-1;
		 if($page>1){echo "<a href=timeline.php?page=$prev>Prev</a>&nbsp;&nbsp;&nbsp;&nbsp;";}
         echo "Page ".$page." of ".$total_pages;
		 if($total_pages>$page){echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=timeline.php?page=$next>Next</a>";}
        echo"</center>";
        echo"<br><br>";
		 }
  ?>
</div>