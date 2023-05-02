<?php 
header('Access-Control-Allow-Origin : *');
header('Access-Control-Allow-Methods :DELETE');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers :Origin, X-Requested-With, Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods');

include_once '../../config/Database.php';
include_once '../../models/Element_attribute.php';

$db = new Database();
$db->connect();

$element_attribute = new ElementAttribute($db);
$data = json_decode(file_get_contents("php//input"));
$element_attribute->element_id = $data->element_id;
$element_attribute->attribute_id = $data->attribute_id;

if($element_attribute->delete()){
    echo json_encode(
        array('message' => 'Element Attribute Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Element Attribute Not Deleted')
        );
}
?>