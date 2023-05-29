<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, children_orderization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Element.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Element object
  $element = new Element($db);

  // Get raw Elemented data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $element->element_id = $data->element_id;
  $element->parent_id = $data->parent_id;
 // Update parent
 if($element->updateParent()) {
    echo json_encode(
      array('message' => 'Parent id Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Element Not Updated')
    );
  }

