<?php

include_once('connect.php');
session_start();

//$showquery = “SELECT cs_profiles * FROM sql”;
//$showresult = mysql_query($showquery);
//echo “Match Result:”;
//
//while($profilearray = mysql_fetch_assoc($showresult))
//{
//extract($profilearray);
//echo $name.” “.$age.” : “.$status.” “.$rate.” “.$gender;
//}

$users = ['user_name'];
if (!isset($_SESSION['user'])) {
    header("location: /login.php");
    die();
};

if ($_POST['user']){
    $result = mysql_query("SELECT * FROM cs_profiles WHERE id = {$_SESSION['user']}");
    
    $user_data = [];
		while ($row = mysql_fetch_assoc($result)) {
			$user_data[] = $row;
		}
		
		if ($all_fields_are_validated) {
			header("Location: /index.php");
			die();
		}
}


$user_id = $_GET['user_id'];
$user_type = $_GET['user_type'];
$state = $_GET['state'];
$interest = $_GET['interest'];
$age = $_GET['age'];
$availability = $_GET['availability'];

mysql_query("SELECT * FROM cs_profiles WHERE user_id =" .  $_GET['user_id']);

foreach ($users as $user) {
    echo '<h1>' . $user['name'] . '</h1>';
    echo '<img src="uploads/' . $user['profilePicture'] . '" />';}


mysql_query("SELECT * FROM cs_profiles WHERE user_type =" .  $_GET['user_type'] . ' AND state = ' . $_GET['state'] . ' AND interest = ' . $_GET['interest'] . ' AND age = ' . $_GET['age'] . ' AND availability = ' . $_GET['availability']);

foreach ($users as $user) {
    echo '<h1>' . $user['name'] . '</h1>';
    echo '<img src="uploads/' . $user['profilePicture'] . '" />';}
    
    
 ?>