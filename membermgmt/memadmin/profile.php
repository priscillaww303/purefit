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

$count=$dbo->prepare("select * from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$_SESSION['mem_id'],PDO::PARAM_INT,1);

if($count->execute()){
//echo " Success <br>";
$row = $count->fetch(PDO::FETCH_OBJ);
//print_r($row);
//echo "<hr><br>email  = $row->email";
//echo "<hr>";

}else{
print_r($dbo->errorInfo());
}



echo "<form name='myForm' action='profileck.php' method=post>
<table class='t1'> <input type=hidden name=todo value='change-data'>
<tr><th colspan=2>Update Profile $row->userid</th></tr>
<tr class='r1'><td>Email</td><td><input type=text  name='email' value='$row->email'></td></tr>
<tr class='r0'><td>First Name</td><td><input type=text name='fname' value='$row->fname'></td></tr>
<tr class='r1'><td>Last Name</td><td><input type=text name='lname' value='$row->lname'></td></tr>
<tr class='r0'><td>Address 1</td><td><input type=text name='add1' value='$row->add1'></td></tr>
<tr class='r1'><td>Address 2</td><td><input type=text name='add2' value='$row->add2'></td></tr>
<tr class='r0'><td>City </td><td><input type=text name='city' value='$row->city'></td></tr>
<tr class='r1'><td>State</td><td><input type=text name='state' value='$row->state'></td></tr>
<tr class='r0'><td>Country</td><td><input type=text name='country' value='$row->country'></td></tr>
<tr class='r1'><td>Zip</td><td><input type=text name='zip' value='$row->zip'></td></tr>
<tr class='r0'><td>Details</td><td><textarea rows=5 cols=60 name=dtl>$row->dtl</textarea></td></tr>
<tr class='r1'><td></td><td><input type=submit value='Submit'></td></tr>

</table></form>
";





/////////////////////////////
}else{
echo "Please <a href='login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
