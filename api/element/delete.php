<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Element.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog element object
  $element = new Element($db);

  // Get raw elemented data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $element->element_id = $data->element_id;

  // Delete element
  if($element->delete()) {
    echo json_encode(
      array('message' => 'element Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'element Not Deleted')
    );
  }