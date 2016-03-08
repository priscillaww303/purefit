<?Php
session_start();
echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">
<html>
<head>
<title>Upload Profile Photo</title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">
</head>

<body>";
if((isset($_SESSION['userid']) and strlen($_SESSION['userid']) > 5)){
require "../config.php";
dataConnect(); // Connect to Database

require "templates/top.php";  
/////////////////////////
//////start ////////////////////////////////////////
$profile_photo_path="../profile-photo/";
// To display file name, temp name and file type , use them for testing your script only//////
//echo "File Name: ".$_FILES['userfile']['name']."<br>";
//echo "tmp name: ".$_FILES['userfile']['tmp_name']."<br>";
//echo "File Type: ".$_FILES['userfile']['type']."<br>";
//echo "<br><br>";
///////////////////////////////////////////////////////////////////////////
$add=$profile_photo_path.$_FILES['userfile']['name']; // the path with the file name where the file will be stored. 
//echo $add;
if(move_uploaded_file ($_FILES['userfile']['tmp_name'],$add)){
//echo "<br>Successfully uploaded the image<br>";
chmod("$add",0777);

}else{echo "<br>Failed to upload file Contact Site admin to fix the problem<br>";
@unlink($add);
exit;}
/////////////////////////
if (!($_FILES['userfile']['type'] =="image/jpeg" OR $_FILES['userfile']['type']=="image/gif")){
echo "<br>Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
unlink($add);
exit;}
//////////////////

///////// Start the thumbnail generation//////////////
$n_width=100; // Fix the width of the thumb nail images
$n_height=100; // Fix the height of the thumb nail image


if($_FILES['userfile']['type']=="image/gif")
{
$im=ImageCreateFromGIF($add);
$width=ImageSx($im); // Original picture width is stored
$height=ImageSy($im); // Original picture height is stored
$newimage=imagecreatetruecolor($n_width,$n_height);
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
$profile_file_name=$_SESSION['mem_id'].".gif";
$tsrc=$profile_photo_path.$profile_file_name; // Path where thumb nail image will be stored
if (function_exists("imagegif")) {
Header("Content-type: image/gif");
ImageGIF($newimage,$tsrc);
}
elseif (function_exists("imagejpeg")) {
Header("Content-type: image/jpeg");
ImageJPEG($newimage,$tsrc);
}
chmod("$tsrc",0777);
}////////// end of gif file thumb nail creation//////////

////////////// starting of JPG thumb nail creation//////////
if($_FILES['userfile']['type']=="image/jpeg"){
$im=ImageCreateFromJPEG($add); 
$width=ImageSx($im); // Original picture width is stored
$height=ImageSy($im); // Original picture height is stored
$newimage=imagecreatetruecolor($n_width,$n_height); 
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
$profile_file_name=$_SESSION['mem_id'].".jpg";
$tsrc=$profile_photo_path.$profile_file_name; // Path where thumb nail image will be stored
ImageJpeg($newimage,$tsrc);
chmod("$tsrc",0777);
}

$sql=$dbo->prepare("update mem_signup set profile_photo=:profile_photo where mem_id=$_SESSION[mem_id] and userid='$_SESSION[userid]'");
$sql->bindParam(':profile_photo',$profile_file_name,PDO::PARAM_STR, 199);
if($sql->execute()){
echo "<br>Successfully updated Profile photo<br>";
echo "<img src=$tsrc>";
}// End of if profile is ok 
else{
print_r($sql->errorInfo());
$msg=" <br>Database problem, please contact site admin <br>";
}
unlink($add);
echo $msg;
////////////////////////
/////end ////////////////////////
///////////////////
}else{
echo "Please <a href='../login.php?redirect=post.php'>Login</a> to post any topics";
}


///////////////////////////////////////////Common part for all pages /////////
require "templates/footer.php";



//$tracking_page_name="Forum-HOME";
//require "tracking/track.php";



echo "</body></html>";
