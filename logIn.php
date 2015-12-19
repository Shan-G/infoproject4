<?php
    //session_start();
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	
	$host = getenv('IP');
    $uname = getenv('C9_USER');
    $pword = "";
    $dbase = "CheapoMail";

    // Create connection
    $con = mysql_connect($host, $uname, $pword);
    mysql_select_db($dbase);
    
	if (!$con) {
		echo "Connection failed";
		return false;
	}
	
   
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $results= mysql_query($sql);
    
    if (sizeof(mysql_fetch_array($results))==0){
    	// sends something to javascript if it fails
    	echo "fail";
    }else{
    	// sends something to javascript if it succeeds
    	
    	session_start();
    	$_SESSION['username']=$username;
    	echo "pass";
    	header('Location: homePage.html');
    }
?>