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
//////////////////////////////////////////////
if((isset($_SESSION['userid']) and $_SESSION['userid']=="siteadmin")){
require "../config.php";
dataConnect(); // Connect to Database
///////////////////////
echo $_GET['msg'];
require "templates/top.php";  
/////////////




/////////////////////////////
}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
