<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Element_attribute.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate element attribute object
$elementAttribute = new ElementAttribute($db);

// Get data from the request body
$data = json_decode(file_get_contents("php://input"));

$elementAttribute->element_id = $data->element_id;
$tagId = $data->tag_id;
$attributeValues = explode(', ', $data->attributesValue);
$attributeIds = $elementAttribute->getAttributeIdsByTagId($tagId);
var_dump($attributeIds);
// Get the minimum count between attributeIds and attributeValues
$count = min(count($attributeIds), count($attributeValues));

// Iterate over the attributes and update each one
for ($i = 0; $i < $count; $i++) {
    $elementAttribute->attribute_id = $attributeIds[$i];
    $elementAttribute->attribute_value = $attributeValues[$i];
    $elementAttribute->update();
}


echo json_encode(array('message' => 'Attributes Updated'));
?>