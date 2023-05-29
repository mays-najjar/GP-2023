<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authraization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Style_element.php';

$database = new Database ();
$database->connect();
$style_element = new StyleElement($database);

$data = json_decode(file_get_contents("php://input"));
// Set the element ID in the style element object
$style_element->element_id = $data->element_id;

if ($style_element->create()) {
    echo json_encode(array('message' => 'Element style created'));
} else {
    echo json_encode(array('message' => 'Element style not created'));
}


?>