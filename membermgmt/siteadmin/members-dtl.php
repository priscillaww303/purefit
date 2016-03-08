<?Php
session_start();
echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>
<head>
<title>Members of the forum </title>
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
require "templates/top.php";  

$mem_id=$_GET['mem_id'];// To take care global variable if OFF
if(strlen($mem_id) > 0 and !is_numeric($mem_id)){
echo "Data Error";
exit;
} 



$count=$dbo->prepare("select mem_id,userid,email,fname,lname,add1,add2,city,state,zip,country,ip,dtj,status from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);

$i=1;
echo "<table class='t1'>";
echo "<tr class='r2'><td>$row->userid</td><td>$row->mem_id</td><td>$row->email</td><td>$row->fname</td><td>$row->lname</td><td>$row->status</td><td>$row->ip</td><td>$row->dtj</td></tr>";
echo "<tr class='r1'><td>$row->add1</td><td>$row->add2</td><td>$row->city</td><td>$row->state</td><td>$row->country</td><td>$row->zip</td><td>$row->ip</td><td>$row->dtj</td></tr>";

echo "</tr></table>";
$mem_id=$row->mem_id;
/////////////
$count=$dbo->prepare("select count(post_id) as no from mem_cmt_post where  mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
$row1 = $count->fetch(PDO::FETCH_OBJ);
echo "Total comments at profile : $row1->no";
/////////////////////////////



/////////////////////////////



echo "<br><br><a href='users-delete.php?status=user_only&mem_id=$mem_id'>Delete</a> this user only.   <a href='users-delete.php?status=user_all&mem_id=$mem_id'>Delete user and all comments</a> ";





}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";