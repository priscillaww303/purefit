<?Php
session_start();
echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>

<head>
<title>Programming Forum Discussions on PHP SQL ASP HTML Web design SEO</title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
</head>

<body>";
require "templates/top.php";  
//////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
require "config.php";
dataConnect(); // Connect to Database
/////////////
$sql="select userid,mem_id from mem_signup order by userid";

echo "<table>";
foreach ($dbo->query($sql) as $row) {
echo "<tr ><td><a href=profile.php?mem_id=$row[mem_id]>$row[userid]</a></td></tr>";
}
echo "</table>";


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";






echo "</body></html>";
