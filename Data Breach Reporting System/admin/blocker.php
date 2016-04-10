<?php
require_once("../inc/functions.php");
session_start();
if(!(isset($_SESSION['id'])))
{
	Redirect('index.php');
}
else
{
	if(isset($_GET['id']))
	{
		if(isset($_GET['action']))
		{
			if($_GET['action']=="block")
			{
				mysql_query("UPDATE users SET status='Blocked' WHERE id='$_GET[id]'");
			}
			elseif($_GET['action']=="unblock")
			{
				mysql_query("UPDATE users SET status='Unblocked' WHERE id='$_GET[id]'");
			}
			Redirect('all-users.php?page='.$_GET['page']);
		}
		else
		{ Redirect('all-users.php'); }
	}
	else
	{ Redirect('all-users.php'); }
}
?>