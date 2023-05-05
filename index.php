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
            <button class="save-button " ><span>Save as html</span></button>
            <button class="preview-button" >Preview  <span style="display: none;">yyy</span> </button>
            <button class="empty-button" >  
                <i class="fa-regular fa-trash-can" style="color: #ffffff; "></i>
                <span class="hedden-content" ><span>Empty Page</span>
            </button>
        </div>
         
       

        
    </nav>
    <!-- <iframe class="col-xs-12 platform" src="platform.php"  >     

</iframe> -->
   
<div id="toolbar" class="col-xs-3">
    <span style="color:#Fff ;">TOOLBAR</span>
    <br>
<!-- -->
<div class='tags'>
<?php
   while($row= mysqli_fetch_array($result)){
    if (trim($row['tag_name']) != 'head' && trim($row['tag_name']) != 'body' && trim($row['tag_name']) != 'title'){
    echo"
    <div class='element'  draggable='true' style=' margin-left:5px; '>
    $row[tag_name]
    </div> 
   ";}}?>
</div>
<div id="demo" style="background-color:#F4A62A ; height: 20px;">
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the "dropped tag id" value from the AJAX request
    $droppedTagId = $_POST['id_value'];

    // Do something with the dropped tag ID value
    echo "The dropped tag ID is: ".$droppedTagId;
}


?>
</div>
</div>
    

    <!-- --------------------CANVAS----------------------- -->
    <div id="canvas" class="col-xs-8" >
        
<div class="canvas-head "  >
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>                    
<div class="title">
  <span id="pageTitle">index</span>
</div> 
</div>
  
   <div id="canvasBody"></div>
</div>
<div id="codeCanvas" class="col-xs-8">
<div class="canvas-head "  >
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>                    
<div class="title">
  <span id="pageTitle">index</span>
</div> 
</div>
code
</div>
<div id="properties" class="col-xs-3">
        <span style="color:#Fff ;">PROPERTIES</span>
        
        <form id="element_properties" style="display:none ;">
    <div  class="form-group " id="properties_info">
    <?php
  $conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

  $attribute_name= mysqli_query($conn ,"SELECT * FROM attribute	 ");  
  $attribute_value= mysqli_query($conn ,"SELECT * FROM element	 ");  

  while(($row= mysqli_fetch_array($attribute_name) )&&( $str=mysqli_fetch_array($attribute_value)) ){ 
    echo"
    <label for='$str[attribute_value]' class='attribute $row[attribute_name]' >
    $row[attribute_name]
    </label>
    <input type='text' class='form-control' placeholder='Enter.$row[attribute_name]'> ";
    }?>
  
    </div>
  </form>

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
<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>