<?php 
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Import the Element class from the model folder
include_once '../../models/Element.php';
include_once '../../config/Database.php';

// Instantiate a new Element object
$database = new Database();
$db = $database->connect();

$element = new Element($db);
ini_set('display_errors', true);
error_reporting(E_ALL);

// Build the DOM tree for the given root node ID
$dom_tree = $element->generate_html_from_database3();
print $dom_tree;


?>