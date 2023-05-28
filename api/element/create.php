<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Element.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $element = new Element($db);
  $data = json_decode(file_get_contents("php://input"));
  $element->element_id= $data->element_id;
  $element->content = $data->content;
  $element->tag_id = $data->tag_id;
  $element->parent_id =$data->parent_id;
  $element->children_order = $data->children_order;
  if($element->create()) {
    echo json_encode(
      array('message' => 'Element Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Element Not Created')
    );
  }
?>
