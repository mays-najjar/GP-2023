<?php
include('config/Database.php');
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

$result= mysqli_query($conn ,"SELECT * FROM tag ");  // رح يجبلي كل البيانات  result 
// يحط البيانات في اريه 
?>
<head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
   
<div id="toolbar" class="col-xs-3">
    <span style="color:#Fff ;">TOOLBAR</span>
    <br>
<!-- -->
<div class='tags'>
<?php
   while($row= mysqli_fetch_array($result)){
    echo"
    <div class='element '  draggable='true' style=' margin-left:5px; '>
    $row[tag_name]
    </div> 
   ";}?>
</div>
  

    <!-- <div class="tool" onclick="showNestedBlock('tool-1')">
        Block 1
        <div id="tool-1">
            <div class="tool-item">
                1
            </div>
            <div class="tool-item">
                2
            </div>
        </div>
    </div> -->

   


    <script>
        function showNestedBlock() {
            var nestedBlock = event.currentTarget.querySelector("tool-item");

// Toggle the display of the nested block
nestedBlock.style.display =
nestedBlock.style.display === "none" ? "block" : "none";

            
            
        }

        function stopPropagation() {
    // Prevent the click event from bubbling up to the main block
    event.stopPropagation();
  }
    </script>
</div>

    

    <!-- --------------------CANVAS----------------------- -->
    <div id="Canvas"class="col-xs-8" >
        
<div class="canvas-head "  >
    <div class="three-circle">
  <span class="left red" style="background-color: #E74C3C;"></span>
  <span class="left yellow" style="background-color: #F4A62A;"></span>
  <span class="left green" style="background-color: #16A085;"></span>
</div>                    
<div class="title">
  <span id="pageTitle">index</span>
</div> 
</div>
  
   <div id="canvasBody"></div>
</div>

<div id="proparities" class="col-xs-3">
        <span style="color:#Fff ;">PROPERITIES</span>

</div>


<style>
*{

    overflow-y: hidden;
}
.canvBody{

  overflow: hidden;
    min-height: 530px;
    background-color: #444;
    border-radius: 10px;
    min-width: 500px;
}
</style>
<script src="assets/js/main.js">
    
</script>