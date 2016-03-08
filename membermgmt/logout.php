<?Php
session_start();
//session_register("session");
session_unset();
session_destroy();

echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>

<head>
<title>Signup to participate in Programming Forum Discussions </title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
</head>

<body>";
require "templates/top.php";  
//////////////////////////////////////////////
////////////////////////////////////////////


echo "
<table>
<tr class='r1'><td>Successfully Logged out , <a href=login.php>Login</a> </td></tr>
</table>

<br><br><br><br><br><br><br><br><br><br><br><br>
";





//////////////////////////////////////////////




///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
