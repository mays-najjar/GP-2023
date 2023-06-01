<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Element.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Element object
$element = new Element($db);

// Get raw input data
$data = json_decode(file_get_contents("php://input"));

// Set properties
$element->element_id = $data->element_id;
$element->content = $data->content;

// Update content
if ($element->updateContent()) {
  echo json_encode(array('message' => 'Element content updated'));
} else {
  echo json_encode(array('message' => 'Failed to update element content'));
}
