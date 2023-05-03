<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Tag.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate tag object
  $tag = new Tag($db);

  // tag read query
  $result = $tag->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any tagegories
  if($num > 0) {
        // tag array
       $tag_arr = array();
       $tag_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

         $tag_item = array(
            'tag_id' => $tag_id,
            'tag_name' => $tag_name
          );

          // Push to "data"
          array_push($tag_arr['data'],$tag_item);
        }

        // Turn to JSON & output
           json_encode($tag_arr);

  } else {
        // No tagegories
        echo json_encode(
          array('message' => 'No tag Found')
        );
  }
