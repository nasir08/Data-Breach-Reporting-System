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
			  <div class="h_title">Manage Reports</div>
				<h2>All Reports</h2>
				<div class="entry">
				  <div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">S/N</th>
							<th scope="col">Breach Type</th>
							<th scope="col">User</th>
							<th scope="col">Date</th>
							<th scope="col">Time</th>
                            <th scope="col">Status</th>
							<th scope="col" style="width: 65px;">Action</th>
						</tr>
					</thead>
						
					<tbody>
                    <?php
					if(isset($_GET['page']))
				{$page=$_GET['page'];}
				else{$page=1;}
				$from=(($page*15)-15);
					
					
					$sn=1;
					$result=mysql_query("SELECT * FROM reports ORDER BY id DESC LIMIT 0,15");
					while($row=mysql_fetch_assoc($result))
					{
						$user_id=$row['user'];
						$result4=mysql_query("SELECT * FROM users WHERE id = '$user_id'");
					    $row4=mysql_fetch_array($result4);
						$name=base64_encode($row4['name']);
						list($y,$m,$d)=explode('-',$row['date']);
						$date=$d."-".$m."-".$y;
						echo"<tr>
							<td align=center valign=middle class=align-center>$sn</td>
							<td align=center valign=middle>$row[type]</td>
							<td align=center valign=middle>$row4[name]</td>
							<td align=center valign=middle>$date</td>
							<td align=center valign=middle>$row[time]</td>
							<td align=center valign=middle>$row[status]</td>
							<td align=center valign=middle>
								<a href=landing.php?page=$page&report_id=$row[id]&reporter=$name&continue=all-reports.php class=\"table-icon edit\" title=\"View & Send Feedback\"></a>	  
							</td>
						</tr>";
						$sn++;
					}
					?>
					</tbody>
				</table>
				<div class="entry">
                <div class="pagination">
                 <?php
  echo"<center>";
         $query="SELECT COUNT(id) FROM reports";
         $rs=mysql_query($query);
         $row=mysql_fetch_row($rs);
         $totalRecords=$row[0];
         $total_pages=ceil($totalRecords/15);
         
		 
		 if($total_pages>1)
         {
		 $next=$page+1;
		 $prev=$page-1;
		 if($page>1){echo "<a href=all-reports.php?page=$prev>« Prev</a>";}
         echo "<span class=active>Page $page</span>";
		 if($total_pages>$page){echo "<a href=all-reports.php?page=$next>Next »</a>";}
        echo"</center>";
        echo"<br><br>";
		 }
  ?>     
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