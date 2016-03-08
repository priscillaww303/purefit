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

echo $_GET['msg'];

$start=$_GET['start'];// To take care global variable if OFF
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
} 
$eu = ($start - 0);
$limit = 10; // No of records to be shown per page.
$this1 = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;


$count=$dbo->prepare("select count(mem_id) as no from mem_cmt_post ");
//$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);
$nume=$row->no;

$sql="select post_id,mem_id,userid,dt,dtl from mem_cmt_post order by dt desc limit $eu, $limit ";

$i=1;
echo "<table class='t1'><th>Post By</th><th>Page ID ( owner )</th><th>Date of post</th><th>Detail</th></tr>";
foreach ($dbo->query($sql) as $row) {$m=$i%2;
//print_r($dbo->errorInfo());
echo "<tr class='r$m'><td><a href=''><a href=users-dtl.php?mem_id=$row[mem_id]>$row[userid]</a></td><td>$row[mem_id]</td><td>$row[dt]</td><td>$row[dtl]</td></tr>";
$i=$i+1;
}
echo "</tr></table>";
/////////////


echo "<table align = 'center' width='100%'><tr><td align='left' >";
if($back >=0) {
print "<a href='users.php?start=$back'><font face='Verdana' size='2'>PREV</font></a>";
}

echo "</td><td align=center >";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='users.php?start=$i'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";} /// Current page is not displayed as link and given font color red
$l=$l+1;
}
echo "</td><td align='right' >";
if($this1 < $nume) {
print "<a href='users.php?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";}
echo "</td></tr></table>";



/////////////////////////////
}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";