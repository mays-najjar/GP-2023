<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authraization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Element_attribute.php';

$database = new Database ();
$database->connect();
$elementAttribute = new ElementAttribute($database);

// Get data from the request body
$data = json_decode(file_get_contents("php://input"));

// Extract the required data from the received data
$elementAttribute->element_id = $data->element_id;
$tagId = $data->tag_id;
 // Replace with the desired tag ID
$attributeIds = $elementAttribute->getAttributeIdsByTagId($tagId);

// Iterate over the attributes and create each one
foreach ($attributeIds as $index => $attributeId) {
        $elementAttribute->attribute_id = $attributeId;
        $elementAttribute->create();
}

echo json_encode(array('message' => 'Attributes Created'));


?>