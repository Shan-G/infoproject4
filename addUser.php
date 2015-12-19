<?php

    session_start();

    if(isset($_SESSION['username'])){
    // Get entered fields
        $fname = $lname = $uname = $pword = "";
        $fnameErr = $lnameErr = $unameErr = $pwordErr = "";
       
        
        if (empty($_POST["firstname"])) {
            $fnameErr = "First name is required";
        } else {
            $fname = test($_POST["firstname"]);
        }

        if (empty($_POST["lastname"])) {
            $lnameErr = "Last name is required";
        } else {
            $lname = test($_POST["lastname"]);
        }

        if (empty($_POST["uname"])) {
            $unameErr = "Username is required";
        } else {
            $uname = test($_POST["uname"]);
        }
        
        if (empty($_POST["password"])) {
            $pwordErr = "Last name is required";
        } else {
            $pword = pwdC($_POST["password"]);
        }

        if ($fnameErr!="" || $lnameErr!="" || $unameErr!="" || $pwordErr!=""){
            echo "<br>".$fnameErr."<br>".$lnameErr."<br>".$unameErr."<br>".$pwordErr."<br>"; 
        }
        
        if ($fname!="" && $lname!="" && $uname!="" && $pword!=""){
            // Add to database
            $sql = "INSERT INTO Representatives(first_name, last_name, password, username) VALUES ('$fname', '$lname', '$pword', '$uname')";
   	        $result = mysql_query($sql);
        }
    }
        
    //Checks if input consist of only alpha characters
    function test($input) {
        if (preg_match("/^[-\sa-zA-Z]+$/", $input)){
            return $input;
        }else{
            echo $input. "isn't a valid entry <br>";
        }
    }

    //Checks if the password is valid
    function pwdC($input) {
        if (preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/", $input) && strlen($input)>7){
            return $input;
        }else{
            echo "Password is invalid";
        }
    } 
    
?>