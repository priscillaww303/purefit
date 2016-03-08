<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";

// Create connection
$conn = mysql_connect($servername, $username, $password);
mysql_select_db ($dbname);