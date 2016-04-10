<?php
$db_hostname='localhost';
$db_database='dbcrs';
$db_username='root';
$db_password='';
$server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$server)
{
  echo "Cannot connect to mysql at the moment";
}
$found=mysql_select_db($db_database);
if(!$found)
{
   echo"Cannot find database at the moment";
}


function Redirect($url) { 
       if(headers_sent()) { 
               echo "<script type='text/javascript'>location.href='$url';</script>"; 
       } else { 
               header("Location: $url"); 
       } 
}  
 
 
function destroySession()
{
$_SESSION=array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
}

function sanitizeString($var)
{
 $var = stripslashes($var);
 $var = htmlentities($var);   
 $var = strip_tags($var);
return $var;
}

function sanitizeMySQL($var)
{
$var = mysql_real_escape_string($var);
$var = sanitizeString($var);
return $var;
}
?>





<?php
    function gen_Password()
    {
    //start by defining ref length
$length = 6;
  		// start with a blank password
  		$pass = "";

 		 // define possible characters
  		$possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    
  		// set up a counter
  		$i = 0; 
    
  		// add random characters to $password until $length is reached
  		while ($i < $length) { 

   		 // pick a random character from the possible ones
  		  $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
  		  // we don't want this character if it's already in the password
  		  if (!strstr($pass, $char)) { 
  		    $pass .= $char;
   		   $i++;
			}
		
 		 }
		 
		 $passcode = $pass;
         return $passcode;
   }
?>