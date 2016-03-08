<?Php
session_start();
//session_register("session");
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

echo @$_GET['msg'];
$table=@$_GET['table'];
if($table<>"forum_reply"){
$table="forum_topics";
}
echo $table;
$sql="SELECT count( mem_id ) AS no, userid, mem_id FROM $table GROUP BY mem_id ORDER BY no  ";
//$row=$dbo->prepare($sql);
//$row->execute();
//print_r($row->errorInfo());

$i=1;
echo "<table class='t1'>";
foreach ($dbo->query($sql) as $row) {$m=$i%2;
//print_r($dbo->errorInfo());
echo "<tr class='r$m'><td><a href=''><a href=users-dtl.php?mem_id=$row[mem_id]>$row[userid]</a></td><td>$row[mem_id]</td><td>$row[no]</td></tr>";
$i=$i+1;
}
echo "</tr></table>";
/////////////




/////////////////////////////
}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
