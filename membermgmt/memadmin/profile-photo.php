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
$profile_photo_path="../profile-photo/";


$count=$dbo->prepare("select profile_photo from mem_signup where mem_id=:mem_id");
$count->bindParam(":mem_id",$_SESSION['mem_id'],PDO::PARAM_INT,1);

if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
}else{
print_r($dbo->errorInfo());
}



echo "<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"profile-photock.php\" METHOD=POST>
 <INPUT NAME=\"userfile\" TYPE=\"file\">
<INPUT TYPE=\"submit\" VALUE=\"Upload Photo\"></FORM>
";
if(strlen($row->profile_photo) > 1 ){
$tsrc=$profile_photo_path.$row->profile_photo; // Path where thumb nail image will be stored
echo "<img src=$tsrc>";
}
/////////////////////////////
}else{
echo "Please <a href='login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
