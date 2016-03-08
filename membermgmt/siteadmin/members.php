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
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">";
?>
    <script type="text/javascript">
        function ajaxFunction(mem_id, status1) {
            var httpxml;
            try {
                // Firefox, Opera 8.0+, Safari
                httpxml = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer
                try {
                    httpxml = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        httpxml = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        alert("Your browser does not support AJAX!");
                        return false;
                    }
                }
            }

            function stateChanged() {
                if (httpxml.readyState == 4) {
                    var myObject = eval('(' + httpxml.responseText + ')');
                    var msg = myObject.value[0].message

                    if (msg.length > 0) {
                        document.getElementById("msg").style.background = '#ffff00';
                        document.getElementById("msg").style.display = 'inline';
                        document.getElementById("msg").innerHTML = msg;
                        setTimeout("document.getElementById('msg').style.display='none'", 1000)

                    } else {
                        document.getElementById("msg").style.display = 'none';
                    }
                    var mem_id = myObject.value[0].mem_id
                    var status = myObject.value[0].status
                    if (myObject.value[0].result == "updated") {
                        var str = "<a href=# onClick=ajaxFunction(" + mem_id + ",'" + status + "')>" + status + "</a>";
                        document.getElementById(mem_id).innerHTML = str;
                    }
                }
            }
            var url = "users-ajax.php";
            url = url + "?mem_id=" + mem_id;
            url = url + "&status=" + status1;


            url = url + "&sid=" + Math.random();
            httpxml.onreadystatechange = stateChanged;
            httpxml.open("GET", url, true);
            httpxml.send(null);
            document.getElementById("msg").style.display = 'inline';
            document.getElementById("msg").style.background = '#ff00ff';
            document.getElementById("msg").innerHTML = "Please Wait... ";
        }

        ////////////////////////////////////////
    </script>

    <?Php
echo "</head>

<body>";

//////////////////////////////////////////////
if((isset($_SESSION['userid']) and $_SESSION['userid']=="siteadmin")){
require "../config.php";
dataConnect(); // Connect to Database

///////////////////////
require "templates/top.php";  

echo "<div id=msg style=\"position:absolute; width:300px; height:25px; 
z-index:1; left: 500px; top: 0px; 
 border: 1px none #000000\"></div>";



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


$count=$dbo->prepare("select count(mem_id) as no from mem_signup ");
//$count->bindParam(":mem_id",$mem_id,PDO::PARAM_INT);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);
$nume=$row->no;

$sql="select mem_id,userid,email,fname,lname,country,ip,dtj,status from mem_signup order by dtj desc limit $eu, $limit ";
//$row=$dbo->prepare($sql);
//$row->execute();
//print_r($row->errorInfo());

$i=1;
echo "<table class='t1'>";
foreach ($dbo->query($sql) as $row) {$m=$i%2;
//print_r($dbo->errorInfo());
echo "<tr class='r$m'><td><a href=''><a href=users-dtl.php?mem_id=$row[mem_id]>$row[userid]</a></td><td>$row[mem_id]</td><td>$row[email]</td><td>$row[fname]</td><td>$row[lname]</td><td><div id=$row[mem_id]><a href=# onClick=ajaxFunction($row[mem_id],\"$row[status]\")>$row[status]</a></div></td><td>$row[ip]</td><td>$row[dtj]</td>";
$i=$i+1;
}
echo "</tr></table>";

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

/////////////
echo "<br><br><br><table align = 'center' width='100%'><tr><td align='left' >
A : Fresh or just signed ( can't login ) waiting for approval <br>
B : Approved ( can login )
</td></tr></table>";


/////////////////////////////


/////////////////////////////
}else{
echo "Please <a href='../login.php'>Login</a>";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";