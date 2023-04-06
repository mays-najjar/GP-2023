<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');


include_once '../../config/Database.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$result = $tag->read();
$num = $result->rowCount();

if($num > 0){
    $cat_arr = array(
        'data' => array()
    );
  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $cat_item = array(
        'tag_id' => $tag_id, 
        'tag_name' => $tag_name
    );

    array_push($cat_arr['data'], $cat_item);

   }

   echo json_encode($cat_arr);
}else
{
    echo json_encode(array(
        'message' => 'No tags'
    )) ; 
}

