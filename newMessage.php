<?php 
    
    session_start(); //Start session

    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $body = $_POST['message_content'];
    
	if(isset($_SESSION['username'])){
		$current_user = $_SESSION['username'];
		$useridquery =  "SELECT id FROM user WHERE username = '$current_user'";
		$recidquery =  "SELECT id FROM user WHERE username = '$recipient'";
		$userres = mysql_query($useridquery);
		$recres = mysql_query($recidquery);
		if ($userres === false || $resrec === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }
		
		while($row=mysql_fetch_array($userres)){
			$userid= $row['id'];
		}
		while($row2=mysql_fetch_array($userres)){
			$recid= $row['id'];
		}
		
		
    
        if(mysql_fetch_array($recres)==0){
            echo "Invalid Recipient Username";
        }else{
            while(mysql_fetch_array($recres)){
                $sql = "INSERT INTO message (body,subject,user_id,recipient_ids) VALUES ($body,$subject,$userid, $recid);";
            
                $query = mysql_query($sql);

                if ($query === false) {
                    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
                }else{
	    		    echo "1 record added";
  	    		}
            }
        }
    }else{
        echo "Session not set";
    }
  
?>