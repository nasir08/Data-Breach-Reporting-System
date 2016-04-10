<?php
	require_once("inc/functions.php");
	session_start();
	if(isset($_SESSION['id']))
	{
		$user_id=$_SESSION['id'];
		if(isset($_GET['report_id']))
		{
			$rid=$_GET['report_id'];
			mysql_query("DELETE FROM feedbacks WHERE report='$rid'");
			mysql_query("DELETE FROM comments WHERE report='$rid'");
			mysql_query("DELETE FROM reports WHERE id='$rid'");
			Redirect("my-reports.php");
		}
		else
		{
			Redirect("my-reports.php");
		}
	}
	else
	{
		Redirect("index.php");
	}
?>
  