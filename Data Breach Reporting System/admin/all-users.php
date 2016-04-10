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
				<h2>All Users</h2>
				<div class="entry">
				  <div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">S/N</th>
							<th scope="col">Name</th>
							<th scope="col">Username</th>
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
					$result=mysql_query("SELECT * FROM users ORDER BY id DESC LIMIT 0,15");
					while($row=mysql_fetch_assoc($result))
					{
						echo"<tr>
							<td align=center valign=middle class=align-center>$sn</td>
							<td align=center valign=middle>$row[name]</td>
							<td align=center valign=middle>$row[uname]</td>
							<td align=center valign=middle>$row[status]</td>
							<td align=center valign=middle>";
							if($row['status']=="Unblocked")
							{echo"<a title=\"Block User\" href=blocker.php?id=$row[id]&action=block&page=$page><img src=img/i_block_users.png></a>";}	 	  
							elseif($row['status']=="Blocked")
							{echo"<a title=\"Unblock User\" href=blocker.php?id=$row[id]&action=unblock&page=$page><img src=img/approve.gif></a>";}	 	  
							echo"</td>
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
         $query="SELECT COUNT(id) FROM users";
         $rs=mysql_query($query);
         $row=mysql_fetch_row($rs);
         $totalRecords=$row[0];
         $total_pages=ceil($totalRecords/15);
         
		 
		 if($total_pages>1)
         {
		 $next=$page+1;
		 $prev=$page-1;
		 if($page>1){echo "<a href=all-users.php?page=$prev>« Prev</a>";}
         echo "<span class=active>Page $page</span>";
		 if($total_pages>$page){echo "<a href=all-users.php?page=$next>Next »</a>";}
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