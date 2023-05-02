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

  // Instantiate blog post object
 $element_attribute = new ElementAttribute($db);
 $data = json_decode(file_get_contents("php://input"));
 $element_attribute->element_id = $data->element_id;
 $element_attribute->attribute_id = $data->attribute_id;
 $element_attribute->attribute_value = $data->attribute_value;

 if($element_attribute->update()){
    echo json_encode(
        array('message'=> 'Attributes Updated')
    );
    }else{
        echo json_encode(
            array('message'=> 'Attributes Update Failed')
        );
    }
 ?>
