<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authraization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Element_attribute.php';

$database = new Database ();
$database->connect ();
$element_attribute = new ElementAttribute($database);

$data = json_decode(file_get_contents("php//input"));
$element_id = $data['element_id'];
$attribute_id = $data['attribute_id'];
$attribute_vlue = $data['attribute_value'];

if($element_attribute->create()){
    echo json_encode (
        array('message' => 'Element Attribute created' 
    ));
} else {
    echo json_encode (
        array('message' => 'Element Attribute not created')
        );

}

?>