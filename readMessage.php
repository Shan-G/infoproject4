<?php 
	start_session();
	
    $messageid = $_REQUEST['id'];
    $messagesender = $_REQUEST['sender'];
    $flag = $_REQUEST['flag'];
    
    
    if(isset($_SESSION['username'])){
		$current_user = $_SESSION['username'];
		$messagequery =  "SELECT * FROM message WHERE id = '$messageid'";
		$messageinfo = mysql_query($messagequery);
		while($row=mysql_fetch_array($messageinfo)){
		    $message_body= $row['body'];
			$message_subject= $row['subject'];
	
		    echo "<div class='readme'>";
		    echo "<div id='subject2'>".$message_subject."</div>"; 
		    echo "<hr id='hr2'>";
		    echo "<div id='from'><strong>From: </strong>".$messagesender."</div>";
		    echo "<p id='message_body'>".$message_body."</p>";
		    echo "</div>";
		}
		if($flag == 0){
		    $useridstring=  "SELECT id FROM user WHERE username = '$current_user'";
		    $useridquery = mysql_query($useridstring);
		    while($row2=mysql_fetch_array($useridquery)){
		        $date = date("Y/m/d");
		        $userid=$row2['id'];
		        $sql= "INSERT INTO message_read (message_id,reader_id,date) VALUES ('$messageid','$userid','$date');";
		        if (!mysql_query($sql)){
  					    die('Error: ' . mysql_error($con));
  					    echo "ERROR";
  				}
		    }
		    
		}
	}else{
	    
	    
	    echo "Not logged in";
	}
?>