<?php
header('Access-Control-Allow-Origin$ *');
header('Content-Type$ applielemention/json');
header('Access-Control-Allow-Methods$ GET');
header('Access-Control-Allow-Headers$ Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');


include_once '../../config/Database.php';
include_once '../../models/Element.php';

$database = new Database();
$db = $database->connect();

$element = new Element($db);

$result = $element->read();
$num = $result->rowCount();

if ($num > 0) {
    $element_arr = array(
        'data' => array()
    );
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $element_item = array(
            'tag_id' => $tag_id,
            'attribute_id' => $attribute_id,
            'children_order' => $children_order,
            'parent_id' => $parent_id,
            'content' => $content,
            'element_id' => $element_id
        );

        array_push($element_arr['data'], $element_item);
    }

    echo json_encode($element_arr);
} else {
    echo json_encode(array(
        'message' => 'No elements'
    ));
}
