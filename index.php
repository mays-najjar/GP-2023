<!DOCTYPE html>
<?php
include('config/Database.php');
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

$result= mysqli_query($conn ,"SELECT * FROM tag ");  // رح يجبلي كل البيانات  result 
// يحط البيانات في اريه 


?>
  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="icon" href="assets/img/GP.gif" sizes="16x16" >
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title >GP-2023 </title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="xxxx" crossorigin="anonymous">   -->

      <script src="https://kit.fontawesome.com/5076f4faae.js" crossorigin="anonymous"></script>
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/ddr-icon/css/ddr-icon.css"> -->
 
       <!-- jquery -->
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- sortable  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

</head>

<body>
    <nav style="text-align: center;" id="nav">
         <div class='logo'>
         <img src='assets/img/logo.jpg'alt='logo' style="mix-blend-mode: multiply;width:200px ;" > </div>
        
         <div class="modes" >
            <input type="radio" id="designMode" name="mode" value="design" checked="">
            <label for="design">Design Mode</label>
            <input type="radio" id="codeMode" name="mode" value="code">
            <label for="css">Code Mode</label>

        </div>
        <div  class="save-and-preview-buttons">
            <button class="save-button three_btns " > 
            <i class="fa-solid fa-download" style="color: #ffffff; "></i>
            <span class="hedden-content">Save as html</span></button>
            
            <button class="preview-button three_btns" >
            <i class="fa-regular fa-eye" style="color: #ffffff; "></i>
              <span class="hedden-content">Preview</span> </button>
            <button class="empty-button three_btns" >  
                <i class="fa-regular fa-trash-can" style="color: #ffffff; "></i>
                <span class="hedden-content" >Empty Page
            </button>
        </div>
         
       

        
    </nav>
    <!-- <iframe class="col-xs-12 platform" src="platform.php"  >     

</iframe> -->
<div class=" col-xs-2">
<form class="pageTitle " action="/action_page.php">
    <div class=" form-group">
       <label for="title">Page title:</label>
      <input type="text" class="form-control" id="title" placeholder="Enter page title" name="title">
    </div>
    <button type="submit" name="title" class="btn" style=" width: 25%; padding: 0;">Save</button>
  </form>

<div id="toolbar" >
    <span style="color:#Fff ;">TOOLBAR</span>
    <br>

    <div class='tags'>
      <?php
      include_once 'config/Database.php';
      include_once 'models/Tag.php';

      // Instantiate DB & connect
      $database = new Database();
      $db = $database->connect();

      // Instantiate tag object
      $tag = new Tag($db);

      // tag read query
      $result = $tag->read();

      // Get row count
      $num = $result->rowCount();
      if ($num > 0) {
        // tag array
        $tag_arr = array();
        echo '<div class="tags">';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $tag_item = array(
            'tag_id' => $tag_id,
            'tag_name' => $tag_name,
            //'tag_level' => $tag_level
          );
          array_push($tag_arr, $tag_item);
          if ($tag_name != 'head' && $tag_name != 'body' && $tag_name != 'title'&& $tag_name != 'html')
            echo ' <div class="element"  draggable="true" style="margin-left:5px" tag_name="' . $tag_name . '" tag_ID="' . $tag_id . '" tag_level="4">' . $tag_name . '</div>';

          // Push to array

        }
        echo '</div>';
      }
      // Encode the array without the "data" key

      ?>
    </div>

  </div>
   
   </div> 

    <!-- --------------------CANVAS----------------------- -->
    
    <div id="displayDesign" class="col-xs-8">
      <div><div class="canvas-head " >
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>
  
</div>
    <div id="canvas" class=" sortable" ondrop="canvasDrop(event)">
        

   <div id="canvasBody">
   
   </div>
</div>
<div id="preview" ></div>
</div>   
</div>
<div id="displayCode" class="col-xs-8">
<div>
  <div class="canvas-head " >
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>
                
<div class="title">
  <span id="pageTitle" style="padding-right: 12%;">index</span>
</div>
  </div>  
<div id="codeCanvas" >

<div id="codeBody"></div>
code
</div>
</div>
</div></div>
<div  id="properties" class="col-xs-3">
        <span style="color:#Fff ;">PROPERTIES</span>
        <!-- form to enter element id to Retrieve its properties -->
        <!-- <form method="post" action="properties_info.php">
  <label for="element_id">Element ID:</label>
  <input type="text" id="element_id" name="element_id">
  <button type="submit">Get Properties</button>
</form> -->

 <div id="element_properties">



         </div>
            <!-- <iframe src="properties_info.php" title="properties_info" class="col-xs-12" name="my-iframe">

</iframe> -->
         <div id="demo" style="background-color:#E74C3C ; height: 6px;">

    </div>

<!-- <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js">
  // Get a reference to the element you want to move
var element = document.getElementById('nelement');

// Initialize interact.js
interact(element)
  .draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of its parent
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
    },
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: function (event) {
      var target = event.target,
          // keep the dragged position in the data-x/data-y attributes
          x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
          y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      // snap to a grid
      x = Math.round(x / grid) * grid;
      y = Math.round(y / grid) * grid;

      // translate the element
      target.style.webkitTransform =
      target.style.transform =
        'translate(' + x + 'px, ' + y + 'px)';

      // update the element's attributes
      target.setAttribute('data-x', x);
      target.setAttribute('data-y', y);
    }
  })
  .on('move', function (event) {
    var interaction = event.interaction;
    if (interaction.pointerIsDown && !interaction.interacting()) {
      interaction.start({ name: 'drag' }, event.interactable, event.currentTarget);
    }
  });

</script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>  
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>