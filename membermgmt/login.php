<?Php
session_start();
echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>
<head>
<title>Login to  Programming Forum Discussions </title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
</head>

<body>";

require "templates/top.php";  

$msg=$_GET['msg'];
echo $msg;
//////////////////////////////////////////////

echo "<form name='myForm' action='loginck.php' method=post>
<table class='t1'> <input type=hidden name=todo value='login-data'><input type=hidden name=redirect value='$_GET[redirect]'>
<tr><th colspan=2>Login</th></tr>
<tr class='r1'><td>User ID</td><td><input type=text name='userid'  size=15></td></tr>
<tr class='r0'><td>Password</td><td><input type=password name='password'></td></tr>
<tr class='r1'><td></td><td><input type=submit value='Submit'></td></tr>
<tr class='r0'><td></td><td><a href=signup.php>SignUp</a></td></tr>

</table></form>
";





//////////////////////////////////////////////




///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
