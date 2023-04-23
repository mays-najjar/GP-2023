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
    <script>  <link rel="icon" type="image/gif" href="animated_favicon1.gif" /> </script>
    
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="assets/img/GP.gif" sizes="16x16">
    <title >GP-2023 </title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="xxxx" crossorigin="anonymous">   -->
      <link rel="stylesheet" href="assets/css/style.css" />
      <script src="https://kit.fontawesome.com/5076f4faae.js" crossorigin="anonymous"></script>
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/ddr-icon/css/ddr-icon.css"> -->
</head>

<body>
    <nav style="text-align: center;" id="nav">
        <div class="modes" style="display:inline-block ">
            <input type="radio" id="designMode" name="mode" value="design" checked="">
            <label for="design">Design Mode</label>
            <input type="radio" id="codeMode" name="mode" value="code">
            <label for="css">Code Mode</label>

        </div>
        <div  class="save-and-publish-buttons">
            <button class="save-button " >SAVE</button>
            <button class="publish-button" >Publish  <span style="display: none;">yyy</span> </button>
            <button class="empty-button" >  
                <i class="fa-regular fa-trash-can" style="color: #ffffff; "></i>

                <span class="hedden-content" >Empty Page</span>
            </button>
        </div>
         
       

        
    </nav>
        
        <div id="toolbar">
        <span style="color:#Fff ;">TOOLBAR</span>
        <br>
<!-- -->
<div class='tool'>
  <?php
       while($row= mysqli_fetch_array($result)){
        echo"
        <div class='element' draggable='true' style=' margin-left:10px; '>
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
    
        <div id="proparities">
            <span style="color:#Fff ;">PROPERITIES</span>

    </div>

        <!-- --------------------CANVAS----------------------- -->
        <div id="canvas" >
            
        <div class="canvas-head">
            <div class="three-circle">
          <span class="left red" style="background-color: #E74C3C;"></span>
          <span class="left yellow" style="background-color: #F4A62A;"></span>
          <span class="left green" style="background-color: #16A085;"></span>
      </div>                    
      <div class="title">
          <span id="pageTitle">index</span>
      </div> 
     </div>
     <i class="bi bi-trash"></i>

    </div>
</body>
</html>