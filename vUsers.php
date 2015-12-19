<?php 

session_start(); //Start session

?>

<table id="people" border=1>
    <tr>
        <h2> Cheapomail Users </h2>
    </tr>
    <tr>
        <th><h3> First Name </h3></th>
        <th><h3> Last Name </h3></th>
        <th><h3> Username </h3></th>
    </tr>

<?php 

    if(isset($_SESSION['username'])){
	
		$userlistq =  "SELECT * FROM user";
		$userlistres = mysql_query($userlistq);
		while($row = mysql_fetch_array($userlistres)){
		    
			echo "<tr>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
		
		}
		
		
	}else{
	    echo "Not logged in";
	}
?>

</table>