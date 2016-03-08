<?php 
include_once('connect.php');
session_start();


function search_results($keywords){
$returned_results = array();
$where = "";

$keywords = preg_split('/[\s]+/', $keywords);
$total_keywords = count($keywords);

foreach($keywords as $key=>$keyword){
    $where .= "title LIKE '%$keyword%'";
    if($key != ($total_keywords - 1)){
        $where .= " AND ";
    }   
}
$results ="SELECT * FROM user WHERE $user ";
echo $results;
$results_num = ($results = mysql_query($results)) ? mysql_num_rows($results) : 0;

if($results_num === 0){
    return false;
}else{
    while($row = mysql_fetch_assoc($results)){
        $returned_results[] = array(
            'name' => $row['name'],
            'age' => $row['age'],
            'gender' => $row['gender'],
            'interest' => $row['interest'],
            'image_location' => $row['image_location'],
            'availability' => $row['availability'],
            'rating' => $row['rating'],
        );
    }
    return $returned_results;
}   
}

?>