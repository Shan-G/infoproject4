<table id="table_header">
	<tr>
		<th id ="header1">From</th>
		<th id ="header2">Subject</th>
		<th id ="header3">Body</th>
	</tr>

<?php 

	session_start();
	
	if(isset($_SESSION['username'])){
		$current_user = $_SESSION['username'];
		$useridquery =  "SELECT id FROM user WHERE username = '$current_user'";
		$userres = mysql_query($useridquery);
		
		if ($userres === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }
		
		while($row=mysql_fetch_array($userres)){
			$userid= $row['id'];
		}
		
		$messagestring= "SELECT * from message where recipient_ids = ".$userid.";";
		$messagequery = mysql_query($messagestring);
		while($row2=mysql_fetch_array($messagequery)){
		    $senderid= $row2['user_id'];
		    
		    $senderstring =  "SELECT username FROM user WHERE id = '$senderid'";
		    $senderquery = mysql_query($con,$senderstring);
		    while($row3 = mysql_fetch_array($senderquery)){
		        $sender_username= $row3['username'];
		    }
			echo 'tr onclick="read();">';
			echo "<td>".$sender_username."</td>";
			echo "<td>".$row2['subject']."</td>";
			echo "<td>".$row2['body']."</td>";
			echo "</tr>";
		}
	}else{
		echo "Not logged in";
	}
?>
</table>