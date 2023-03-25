<?php
// Step 1: Create the API endpoint
// This could be any URL that will receive the API request, such as example.com/api/dom-tree

// Step 2: Parse any parameters
$root_node_id = $_GET['root_node_id'] ?? 1; // default to root node ID of 1

// Step 3: Call the PHP function
//$dom_tree = build_dom_tree($pdo, $root_node_id);

// Step 4: Format the response as JSON
$response = json_encode($dom_tree);

// Step 5: Set the HTTP headers
header('Content-Type: application/json');

// Step 6: Send the response
echo $response;
echo "afnan";