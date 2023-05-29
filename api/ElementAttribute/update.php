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

// Extract the required data from the received data
$elementAttribute->element_id = $data->element_id;
$tagId = $data->tag_id;
$attributeValues = explode(', ', $data->attributesValue);
$attributeIds = $elementAttribute->getAttributeIdsByTagId($tagId);

// Iterate over the attributes and update each one
foreach ($attributeIds as $index => $attributeId) {
    // Check if attribute value exists for the given index
    if (isset($attributeValues[$index])) {
        $elementAttribute->attribute_id = $attributeId;
        $elementAttribute->attribute_value = $attributeValues[$index];
        $elementAttribute->update();
    }
}

echo json_encode(array('message' => 'Attributes Updated'));
?>
