<?php 
header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../models/Element_attribute.php';
include_once '../../config/Database.php';

$db = new Database();
$db->connect();

$element_attribute  = new ElementAttribute($db);
$element_attribute->element_id = isset($_GET['element_id']) ? $_GET['element_id'] : die();

$element_attribute->read_single();

$element_attribute_arr = array(
    'element_id' => $element_attribute->element_id,
    'attribute_id' => $element_attribute->attribute_id,
    'attribute_value' => $element_attribute->attribute_value

);
print_r(json_encode($element_attribute_arr));
?>
