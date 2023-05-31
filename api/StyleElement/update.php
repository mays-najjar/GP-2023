<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Style_element.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate element attribute object
$style_element = new StyleElement($db);

// Get data from the request body
$data = json_decode(file_get_contents("php://input"));

// Extract the required data from the received data
$style_element->element_id = $data->element_id;
$styleValues = explode(', ', $data->styleValues);
// Iterate over the attributes and update each one
for ($i = 1; $i <= 9; $i++) {
    // Check if attribute value exists for the given index
    if (isset($styleValues[$i-1])) {
        $style_element->style_id = $i;
        $style_element->style_value = $styleValues[$i-1];
        $style_element->update();
    }
}


echo json_encode(array('message' => 'Style Updated'));
?>