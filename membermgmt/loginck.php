<?Php
session_start();
//session_register("session");

////////////////////////////////////////////
require "config.php";
dataConnect(); // Connect to Database
///////////////////////
if($_POST['todo']=="login-data"){
$userid=$_POST['userid'];
$password=$_POST['password'];
$ip=$_SERVER['REMOTE_ADDR'];
}
/////////////////
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);

$count=$dbo->prepare("select password,mem_id,userid from mem_signup where userid=:userid and status='B'");
$count->bindParam(":userid",$userid,PDO::PARAM_STR);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);
print_r($count->errorInfo()); 
if($row->password==md5($password)){
// Start session n redirect to last page
$_SESSION['id']=session_id();
$_SESSION['userid']=$row->userid;
$_SESSION['mem_id']=$row->mem_id;
echo " Inside session  ". $_SESSION['userid'];
$redirect=$_POST['redirect'];

if(strlen($redirect) <4){$redirect="index.php";}


header ("Location: $redirect"); 

}else{

header ("Location: login.php?msg=Wrong Login"); 

}

?>



