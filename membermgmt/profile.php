<?Php
session_start();
echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">
<html>
<head>
<title>Programming Forum Discussions on PHP SQL ASP HTML Web design SEO</title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\"><script language=\"javascript\" src=\"cmt-ajax-code.js\"></script>
</head>
<body>";
require "templates/top.php";  
//////////////////////////////////////////////
////////////////////////////////////////////
require "config.php";
dataConnect(); // Connect to Database
/////////////
$mem_id=$_GET['mem_id'];
if(!is_numeric($mem_id)){
echo "Data Error";
exit;
}
/////////

//
$count=$dbo->prepare("select * from mem_signup where mem_id=:id");
$count->bindParam(":id",$mem_id,PDO::PARAM_INT,3);

if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
$dtl=nl2br($row->dtl);

if(strlen($row->profile_photo) > 1 ){
$profile_photo_path="profile-photo/";

$tsrc=$profile_photo_path.$row->profile_photo; // Path where thumb nail image will be stored
echo "<img src=$tsrc align=left><br><br>";
}


echo "<table class='t1'>
<tr class='r1'><td>User ID</td><td>$row->userid</td></tr>
<tr class='r0'><td>Email</td><td>$row->email</td></tr>

<tr class='r1'><td>First Name</td><td>$row->fname</td></tr>
<tr class='r0'><td>Last Name</td><td>$row->lname</td></tr>

<tr class='r1'><td>Address 1</td><td>$row->add1</td></tr>
<tr class='r0'><td>Address 2</td><td>$row->add2</td></tr>
<tr class='r1'><td>City</td><td>$row->city</td></tr>
<tr class='r0'><td>State</td><td>$row->state</td></tr>
<tr class='r1'><td>Country</td><td>$row->country</td></tr>
<tr class='r0'><td>Zip</td><td>$row->zip</td></tr>
<tr class='r1'><td colspan=2>$dtl</td></tr>
</table>";
echo "<hr>";
}else{
//$row=$count->fetchAll();
print_r($dbo->errorInfo());
}
require "cmt-display.php";
///#ending-cmt-display#////
if((isset($_SESSION['userid']) and strlen($_SESSION['userid']) > 5)){
require "cmt-ajax-form.php";
}

///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";






echo "</body></html>";
