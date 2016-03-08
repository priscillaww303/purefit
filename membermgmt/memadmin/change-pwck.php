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
$password=$_POST['password'];
$password2=$_POST['password2'];
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);


if ( strlen($password)< 6 OR strlen($password2) > 32) {
$msg=$msg."Password should not be less than 6 and more than 32 character length<BR>";
$status= "NOTOK";}

if ( $password <> $password2) {
$msg=$msg."Password does not match with re-typed password<br>"; 
$status= "NOTOK";}

if($status=="OK"){

$sql=$dbo->prepare("update mem_signup set password=:password where mem_id=$_SESSION[mem_id] and userid='$_SESSION[userid]'");
$new_password=md5($password);
$sql->bindParam(':password',$new_password,PDO::PARAM_STR, 32);
if($sql->execute()){
echo "Successfully updated password";
}// End of if updae passwrod is true
else{
print_r($sql->errorInfo());
$msg=" Database problem, please contact site admin ";
}

}else{ // if status is OK
print "<script>";
print " self.location='change-pw.php?msg=$msg';";
print "</script>"; 
}

/////////////////////////////
}else{
echo "Please <a href='../login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "../templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
