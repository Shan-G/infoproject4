window.onload=function(){
	document.getElementById("Compose").onclick= compose_message;
	document.getElementById("Inbox").onclick= view_messages;
	document.getElementById("Other Users").onclick= view_users;
	document.getElementById("Add User").onclick= enter_user;
	document.getElementById("logout").onclick = logout;
}


function compose_message(){
	console.log("The on click works");
	var compose_panel=[
		'<div id ="compose_window">',
		'<div class="new">',
		'<div id="header"><strong> New Message </strong></div>',
		'</div>',
		'<form method="post">',
		'<fieldset>',
		'<strong>To</strong><br> <input type="text" id ="recipient" name="recipient" class="textfield"> <br>',
		'<strong>Subject</strong><br> <input type="text" id="subject" name="subject" class="textfield"> <br><br>',
		'<strong>Message</strong><br> <textarea  id = "message_content" name="message_content" cols="40" rows="5"></textarea> <br>',
		'<button id="Send"> <strong> Send </strong> </button>',
		'</fieldset>',
		'</form>',
		'</div>',
		'<div id="Response"></div>',
		
	].join('');
	document.getElementById("pagecontent").innerHTML= compose_panel;
	document.getElementById("Send").onclick= insert_data;
	
}

function enter_user(){
	console.log("The on click works");
	var user_panel=[
	    '<div>',
		'<div class="new">',
		'<div id="header"><strong> Add A User </strong></div>',
		'</div>',
		'<form method="post">',
		'<fieldset>',
		'<strong>First Name</strong><br> <input type="text" id ="firstname" name="firstname" class="textfield"> <br><br>',
		'<strong>Last Name</strong><br> <input type="text" id="lastname" name="lastname" class="textfield"> <br><br>',
		'<strong>Username</strong><br> <input type="text" id ="uname" name="uname" class="textfield"> <br><br>',
		'<strong>Password</strong><br> <input type="password" id="password" name="password" class="textfield"> <br><br>',
		'<button id="Enter" onclick="add_user();"> <strong> Add New User </strong> </button>',
		'</fieldset>',
		'</form>',
		'</div>',
		'<div id="Response"></div>',
		
	].join('');
	document.getElementById("pagecontent").innerHTML= user_panel;
// 	document.getElementById("Enter").onclick= add_user;
	
}

function insert_data(){
    
    alert("working");
    var rec = document.getElementById("recipient").value;
    var sub = document.getElementById("subject").value;
    var bod = document.getElementById("message_content").value;
    var req_mes = "recipient="+rec+"&subject="+sub+"&body="+bod;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
            document.getElementById("Response").innerHTML= responseMessage;
            view_messages();
        }
    };
    
    xmlHttp.open("POST", "newMessage.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlHttp.send(req_mes);
    var responseMessage = xmlHttp.responseText;
    alert(responseMessage);
}

function view_messages(){
    console.log("the message list");
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
            document.getElementById("pagecontent").innerHTML= responseMessage;
        }
    };
    xmlHttp.open("POST","messages.php",true);
    xmlHttp.send();

}

function add_user(){
    alert("Working");
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var uname = document.getElementById("username").value;
    var pword = document.getElementById("password").value;
    
    var req_mes = "first_name="+fname+"&last_name="+lname+"&password="+pword+"&username="+uname;
    
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
            document.getElementById("Response").innerHTML= responseMessage;
            alert(responseMessage);
            view_users();
        }
    };
    
    xmlHttp.open("POST", "addUser.php", true);
    xmlHttp.send(req_mes);    
}
    
    
function view_users(){
    console.log("the user list");
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
            document.getElementById("pagecontent").innerHTML= responseMessage;
             
        }
    };
    xmlHttp.open("GET","vUsers.php",true);
    xmlHttp.send();   
}

function logout(){
    console.log("logging out");
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
            alert(responseMessage);
             window.location.href="index.php";
        }
    };
    xmlHttp.open("GET","logOut.php",true);
    xmlHttp.send();
    
}
function read(){
    console.log("reading");
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            var responseMessage = xmlHttp.responseText;
           
            document.getElementById("pagecontent").innerHTML= responseMessage;
        }
    };
    xmlHttp.open("GET","read.php",true);
    xmlHttp.send();
    
}