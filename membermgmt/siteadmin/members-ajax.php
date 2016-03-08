<?Php
session_start();
if((isset($_SESSION['userid']) and $_SESSION['userid']=="siteadmin")){
require "../config.php";
dataConnect(); // Connect to Database

///////////////////////

$mem_id=$_GET['mem_id'];// To take care global variable if OFF
if(strlen($mem_id) > 0 and !is_numeric($mem_id)){
echo "Data Error";
exit;
} 

$status=$_GET['status'];// To take care global variable if OFF
if(strlen($status) <> 1){
echo "Data Error";
exit;
} 
if($status=='A'){$status='B';}
else{$status='A';}

$count=$dbo->prepare("update mem_signup set status='$status' where mem_id=:mem_id and userid<>'siteadmin'");
$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
if ($count->rowCount()==1){
//echo "record updated" ;
$message="Updated";

$result="updated";
}else { $result="Fail";
$message="Fail";
}
//$row = $count->fetch(PDO::FETCH_OBJ);
//echo $row->status;

$str="{\"value\" : [{\"message\" :\" $message \",\"status\" :\"$status\",\"result\" : \"$result\",\"mem_id\" : $mem_id}]}";

echo $str;



}else{
echo "Please <a href='../login.php'>Login</a>";
}


?>