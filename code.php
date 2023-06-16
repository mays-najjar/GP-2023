<link rel="stylesheet" href="assets/css/style.css" />   

<div class="canvas-head " style="width: 200%;">
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>
                
<div class="title">
  <span id="pageTitle" style="padding-right: 12%;"></span>
</div>
  </div>  
<div id="codeCanvas" >
    <div id="codeBody"></div>
<pre>
    <?php

    // Import the Element class from the model folder
    include_once 'models/Element.php';
    include_once 'config/Database.php';

    // Instantiate a new Element object
    $database = new Database();
    $db = $database->connect();

    $element = new Element($db);
    ini_set('display_errors', true);
    error_reporting(E_ALL);

    // Build the DOM tree for the given root node ID and store the generated HTML in a variable
   $element->codeMode();

    ?> </pre>
</div>
<style>
html body{
  /* background-color: #484a72; */
  background:#444;
  min-width: 760px;
  /* overflow: hidden; */
}
  </style>