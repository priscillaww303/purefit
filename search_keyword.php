<?php

include_once('connect.php');
session_start();


mysql_query("SELECT * FROM cs_profiles WHERE user_type =" .  $_GET['user_type'] . ' AND state = ' . $_GET['state'] . ' AND interest = ' . $_GET['interest'] . ' AND age = ' . $_GET['age'] . ' AND availability = ' . $_GET['availability']);

foreach ($users as $user) {
    echo '<h1>' . $user['name'] . '</h1>';
    echo '<img src="uploads/' . $user['profilePicture'] . '" />'};

?>