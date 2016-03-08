<?Php
session_start();

echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>
<head>
<title>Signup to participate in Programming Forum Discussions </title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">
</head>

<body>";
if((isset($_SESSION['userid']) and strlen($_SESSION['userid']) > 5)){
require "../config.php";
dataConnect(); // Connect to Database

require "templates/top.php";  
//////////////////////////////////////////////
echo $_GET['msg'];

echo "<form name='myForm' action='change-pwck.php' method=post>
<table class='t1'> <input type=hidden name=todo value='change-data'>
<tr><th colspan=2>Change Password </th></tr>
<tr class='r1'><td>Password</td><td><input type=password name='password'>Minimum 6 & Maximum 32</td></tr>
<tr class='r0'><td>Password ( Retype) </td><td><input type=password name='password2'></td></tr>
<tr class='r1'><td></td><td><input type=submit value='Submit'></td></tr>

</table></form>
";





/////////////////////////////
}else{
echo "Please <a href='login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "../templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
