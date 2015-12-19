window.onload = function(){

}


function verify(){
	var username = $("uname").value;
	var password = $("pword").value;
    var reg =/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/ ;
    if (username!='' && password!=''){ //Checks if any fields are blank
        if (reg.match(password)) { //Checks that password matches the reg expression
            var responseMessage;
        	var requeststring = "logIn.php?username="+username+"&password="+password;
	        var getstuff = new XMLHttpRequest();
	        getstuff.onreadystatechange = function(){
                if(getstuff.readyState==4 && getstuff.status==200 ){
                    responseMessage = getstuff.responseText;
                    console.log(responseMessage);
                    if (responseMessage=="fail") {
                        document.getElementById("login_status").innerHTML= "<div class='loginstatus'><strong> Login Failed </strong></div>";
                    }else if(responseMessage=="pass"){
                        document.getElementById("login_status").innerHTML= "<div class='loginstatus'><strong> Login Success </strong></div>";
                        window.location.href="homePage.html";
                    }
                }
	        };
	    }else{
	        alert("Your password must consist of a number and a capital letter.");  
	    }
    }else{
        alert ("Please sure both username and password are field");
    }
    
	getstuff.open("get",requeststring ,true);
    getstuff.send();
};