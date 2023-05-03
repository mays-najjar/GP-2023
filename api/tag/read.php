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
// Check if any tag
// Check if any tag
if ($num > 0) {
    // Loop through the tags and encode each one separately
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $tag_item = array(
            'tag_id' => $tag_id,
            'tag_name' => $tag_name
        );

        // Encode the tag item as a JSON object
        echo json_encode($tag_item);

        // Add a comma separator if not the last item
        if ($row !== $result->fetch(PDO::FETCH_ASSOC)) {
            echo ",";
        }
    }
} else {
    // No tags found
    echo json_encode(array('message' => 'No tag found'));
}


