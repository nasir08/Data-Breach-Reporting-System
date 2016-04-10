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
			  <div class="h_title">Main Control</div>
				<h2>Data Breach History</h2>
				<div class="entry">
				  <div class="sep"></div>
				</div>
				<form action="" method="post">
                  <?php
                  if(isset($_POST['submit']))
                  {
					 $sdate=$_POST['sdate'];
					 $edate=$_POST['edate'];
					 if($sdate=="")
					 { echo"<b>Please enter a start date.</b>"; }
					 elseif($edate=="")
					 { echo"<b>Please enter an end date.</b>"; }
					  
					 else
					 {
						 
						 $result=mysql_query("SELECT * FROM reports WHERE date BETWEEN '$sdate' AND '$edate'");
						 $fp = fopen("history_files/".$sdate."-to-".$edate.".doc", 'w');
						 while($row=mysql_fetch_assoc($result))
						 {   
						 	$result2=mysql_query("SELECT name FROM users WHERE id ='$row[id]'");
							$row2=mysql_fetch_array($result2);
							$name=$row2['name'];
						 	
    						fwrite($fp, "$row[date] - $name:\n $row[details]\n\n\n"); 
						 }
						 fclose($fp);
						 Redirect('download.php?filename='.$sdate."-to-".$edate.".doc");  
					 }
                  }
                  ?>
                  
					<div class="element">
						<label for="sdate">Start Date</label>
						<input id="name" name="sdate" class="text" type="date" />
                        <br><br>
						<label for="edate">End Date</label>
						<input id="name" name="edate" class="text" type="date" />
					</div>
					<div class="entry">
                     <button type="submit" class="add" name="submit">Download</button>
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