<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";

$target_dir="uploads/";
$imageFileType = pathinfo(basename($_FILES["profilePhoto"]["name"]), PATHINFO_EXTENSION);
$target_file=$target_dir . $_POST['name'] . "." . $imageFileType;
$uploadOk = 1;

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}


// Check file size
if ($_FILES["profilePhoto"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["profilePhoto"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Create connection
$conn = mysql_connect($servername, $username, $password);
mysql_select_db ($dbname);


$username = $_POST['name'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$profilephoto = $username .".". $imageFileType;


mysql_query("INSERT INTO cs_profiles (name, password, gender, profilephoto) VALUES ('$username', '$password', '$gender', '$profilephoto')
");

echo mysql_error();


?>