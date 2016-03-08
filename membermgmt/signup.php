<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Signup to participate in Programming Forum Discussions </title>
<META NAME="DESCRIPTION" CONTENT=" ">
<META NAME="KEYWORDS" CONTENT="">
<link rel="stylesheet" href="style.css" type="text/css">
<script language="javascript" type="text/javascript">
var ajrequest= null;

try {
ajrequest= new XMLHttpRequest();
} catch (trymicrosoft) {
try {
ajrequest= new ActiveXObject("Msxml2.XMLHTTP");
} catch (othermicrosoft) {
try {
ajrequest= new ActiveXObject("Microsoft.XMLHTTP");
} catch (failed) {
ajrequest= null;
}
}
}

if (ajrequest== null)
alert("Error creating request object!");

///////////////////////////////
function stateChanged() 
{

if(ajrequest.readyState==4)
{
document.getElementById("txtHint").innerHTML=ajrequest.responseText;
}
}
/////////////////////////////////
function getFormData(myForm) { 
var myParameters = new Array(); 
for (var i=0 ; i < myForm.elements.length; i++) { 
var sParam = encodeURIComponent(myForm.elements[i].name); 
sParam += "="; 
sParam += encodeURIComponent(myForm.elements[i].value); 
myParameters.push(sParam); 
} 

return myParameters.join("&"); 

} 
////////////////////////////////////////////

function getInfo(){
var url="signupck.php";
var myForm = document.forms[0]; 
var parameters=getFormData(myForm);
ajrequest= new XMLHttpRequest();
//var ajrequest= newrequest();

ajrequest.onreadystatechange=stateChanged;
ajrequest.open("POST", url, true);
ajrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajrequest.send(parameters) ;

}

////////////////////////////////
</script>

</head>

<body>
<?Php
require "templates/top.php";  
//////////////////////////////////////////////
if($_GET['todo2']=="post-back"){
$userid=urldecode($_GET['userid']);
$email=urldecode($_GET['email']);
$fname=urldecode($_GET['fname']);
$lname=urldecode($_GET['lname']);
$add1=urldecode($_GET['add1']);
$add2=urldecode($_GET['add2']);
$city=urldecode($_GET['city']);
$state=urldecode($_GET['state']);
$country=urldecode($_GET['country']);
$zip=urldecode($_GET['zip']);
$msg=urldecode($_GET['msg']);
echo "$msg";
}
////////////////////////////////////////////


echo "<form name='myForm' action='signupck.php' method=post>
<table class='t1'><input type=hidden name=todo value='post-data'>
<tr class='r1'><td>User ID</td><td><input type=text name='userid' value='$userid' size=15>Minimum 6 & Maximum 15 (Alphanumeric only)</td></tr>
<tr class='r0'><td>Password</td><td><input type=password name='password'>Minimum 6 & Maximum 32</td></tr>

<tr class='r1'><td>Password ( Retype)</td><td><input type=password name='password2'></td></tr>
<tr class='r0'><td>Email</td><td><input type=text name='email'  size=40></td></tr>

<tr class='r1'><td>First Name</td><td><input type=text name='fname'  size=40></td></tr>
<tr class='r0'><td>Last Name</td><td><input type=text name='lname' ></td></tr>
<tr class='r1'><td>Address 1</td><td><input type=text name='add1' value='$add1'></td></tr>
<tr class='r0'><td>Address 2</td><td><input type=text name='add2' value='$add2'></td></tr>
<tr class='r1'><td>City </td><td><input type=text name='city' value='$city'></td></tr>
<tr class='r0'><td>State</td><td><input type=text name='state' value='$state'></td></tr>

<tr class='r1'><td>Country</td><td><input type=text name='country' value='$country'></td></tr>
<tr class='r0'><td>Zip / Postal Code</td><td><input type=text name='zip' value='$zip'></td></tr>
<tr class='r1'><td colspan=2><input type=checkbox value=yes name=terms>I Agree to <a href='http://www.plus2net.com/terms.html' target='new'>Terms & Conditions</a></td></tr>
<tr class='r0'><td></td><td ><input type=submit value='Signup'></td></tr>

</table></form>

";





//////////////////////////////////////////////




///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
