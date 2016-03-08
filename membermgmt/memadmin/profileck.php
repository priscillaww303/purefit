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
$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$add1=$_POST['add1'];
$add2=$_POST['add2'];
$city=$_POST['city'];
$state=$_POST['state'];
$country=$_POST['country'];
$zip=$_POST['zip'];
$dtl=$_POST['dtl'];
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);



if($status=="OK"){

$sql=$dbo->prepare("update mem_signup set email=:email,fname=:fname,lname=:lname,add1=:add1,add2=:add2,city=:city,state=:state,country=:country,zip=:zip,dtl=:dtl where mem_id=$_SESSION[mem_id] and userid='$_SESSION[userid]'");
$sql->bindParam(':email',$email,PDO::PARAM_STR, 75);
$sql->bindParam(':fname',$fname,PDO::PARAM_STR, 50);
$sql->bindParam(':lname',$lname,PDO::PARAM_STR, 50);
$sql->bindParam(':add1',$add1,PDO::PARAM_STR, 100);
$sql->bindParam(':add2',$add2,PDO::PARAM_STR, 100);
$sql->bindParam(':city',$city,PDO::PARAM_STR, 100);
$sql->bindParam(':state',$state,PDO::PARAM_STR, 100);
$sql->bindParam(':country',$country,PDO::PARAM_STR, 100);
$sql->bindParam(':zip',$zip,PDO::PARAM_STR, 6);
$sql->bindParam(':dtl',$dtl,PDO::PARAM_STR);
if($sql->execute()){
echo "Successfully updated Profile";
}// End of if profile is ok 
else{
print_r($sql->errorInfo());
$msg=" Database problem, please contact site admin ";
}

}else{ // if status is OK
print "<script>";
print " self.location='profile.php?msg=$msg';";
print "</script>"; 
}

/////////////////////////////
}else{
echo "Please <a href='../login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
