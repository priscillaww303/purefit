<?php
include_once('connect.php');
session_start();


if (isset($_GET['keywords'])){
$keywords = mysql_real_escape_string(htmlentities(trim($_GET['keywords']))); 

$errors = array();

if(empty($keywords)){
    $errors[] = 'Please enter a search term';
}else if(strlen($keywords)<3){
    $errors[] = 'Your search term must be at least 3 characters long';
}else if(search_results($keywords) == false){
            $errors[] = 'Your search for'.$keywords.' returned no results';
}
if(empty($errors)){
function diplay_results($keywords){
    $results = search_results($keywords);
    $results_num = count($results);


    foreach($results as $result ){
        echo '
            <div id="user_result">
                <a href= search_id.php?user_id='.$result['user_id'].'>
                <img src= '.$result['image_location'].' id="image" /></a>
                <div id="main_title">
                <a href= search_id.php?user_id='.$result['user_id'].'>
                <h2 id="user_name">'.$result['name'].'&nbsp; &nbsp;</h2></a>
                    <h3 id="user_interest">for  &nbsp;'.$result['interest'].'</h3>
                </div>
                <p id=user_age>'.$result['age'].'</p>
                <div id="right_side">
                <h4 id="user_rating">'.$result['rating'].'</h4>
                </div>
                <hr id="hr"/>
            </div>  
        ';
}
}
}else{
    foreach($errors as $error){
        echo $error, '<br />';
    }
}

}
?>