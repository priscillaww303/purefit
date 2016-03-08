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

$count=$dbo->prepare("select userid,profile_photo from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);

if($row->userid=="siteadmin"){
echo " You can't delete siteadmin ";
exit;
}



switch($_GET['status'])
{
case "user_only":


$count=$dbo->prepare("delete from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
echo "<br>Deleted user table ";


case "user_all":
$count=$dbo->prepare("delete from mem_cmt_post where mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
echo "<br>Deleted comments  ";

$count=$dbo->prepare("delete from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
echo "<br>Deleted user table ";
break;
}
$tsrc='../profile-photo/'.$row->profile_photo;
unlink($tsrc);
}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";