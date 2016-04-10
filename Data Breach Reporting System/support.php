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
      <li><a href="my-reports.php">My Reports</a></li>
      <li><a href="make-report.php">Make Report</a></li>
      <li><a href="change-password.php">Change Password</a></li>
      <li id="current"><a href="support.php">Support</a></li>
      <li><a href="signout.php">Sign Out</a></li>
    </ul>
  </div>
</div>
<!-- content-wrap starts here -->
<div id="content-wrap">
  <div id="content">
    <div id="main">
      <div class="box">
        <h1>What's all these ?</h1>
        <p>Breach of Data in the world today is fast rising as there is increasing need for the use of more computers and the need to transfer resources, such as files, documents, etc. This aspect is not the most common aspect as only a few pay attention to it. In the world of today, only Security inclined businesses pay attention to Breach of their Data as it might lead to serious loss of money or other damaging effects.
The topic, Data Breach Capture and Reporting System, looks to Capture all kinds of Data Breaches there are and then try to report them for possible correction or prevention. To explicitly explain this topic, it is better explained word by word. 
Data can be viewed as the lowest level of abstraction from which information and then knowledge are derived. (www.wikipedia.org/data, retrieved 1st August 2013). In lay terms, Data to the Department of Computer Science, Babcock University could be the results of the students to be sent to the IT Department for upload on the school’s website. Breach on the other hand refers to a violation or infraction. (www.thefreedictionary.com/_/dict.aspx?rd=1&word=breach, retrieved 1st August 2013). In lay terms, breach to the above data could be, getting into the hands of students before arrival at the IT Office.
From the above, explanations, it is easy to understand Data Breach Capture. It basically, describes identifying the various ways a Data can be Breached by who or whom and how.
<br><br>
The effect of a data breach could be really expensive to fix, so the key to reducing data breaches for the vast majority of reasons is really to educate employees, therefore, developing a system like the Data Breach Capture And Reporting System where they can view the history of data breach and ways to prevent it in form of feeds, and also have a means of making a report of data breach which they might have experienced to the administrative body. This is one way of educating employees on data breach, therefore reducing the occurrence.
<br><br>
The main aim of this project is to develop a system which is meant for successfully management data breach reports and most especially, to educate the users on measures that would help them prevent future occurrences of data breach.
<ul>
<li>The software will provide a user-friendly avenue for reporting data breaches.</li>
<li>The software will provide a means of getting useful feedbacks from the administrative body, stating the precautions to help prevent another occurrence of data breach in future.</li></ul> 

</p>
      </div>
      <br />
    </div>
    <!-- content-wrap ends here -->
  </div>
</div>
<?php
	require_once("inc/footer.php");
?>