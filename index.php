<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // User is logged in, perform necessary actions
  // For example, you can display a welcome message or redirect them to a member-only area
  echo "Welcome back, " . $_SESSION['username'] . "!";
} else {
  // User is not logged in

  // Check if the "remember me" cookie is set
  if (isset($_COOKIE['rememberme'])) {
      // Retrieve the user information from the cookie and log them in
      $username = $_COOKIE['rememberme'];

      // Perform any necessary validation or database lookup to verify the user

      // Set session variables
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;

      echo "Welcome back, " . $_SESSION['username'] . "!";
  } else {
      // // User is a guest, no session or cookie found
      // echo "Welcome, guest!";

      // Perform actions for guest users
      // Any work done by the guest will not be saved after the website is closed
  }
}

// Login function - to be called when the user submits the login form
function login($username, $remember) {
  // Perform validation and database lookup to verify the user

  // Set session variables
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $username;

  // Set "remember me" cookie if requested
  if ($remember) {
      $cookieExpiry = time() + (30 * 24 * 60 * 60); // Set cookie expiry to 30 days
      setcookie('rememberme', $username, $cookieExpiry);
  }

  // Redirect or perform other actions after successful login
  header('Location: member-area.php');
  exit;
}

// Logout function - to be called when the user logs out
function logout() {
  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();

  // Remove the "remember me" cookie if set
  setcookie('rememberme', '', time() - 3600);

  // Redirect or perform other actions after logout
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="icon" href="assets/img/GP.gif" sizes="16x16" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
     <link rel="stylesheet" href="assets/css/style.css" />   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <title >GP-2023 </title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="xxxx" crossorigin="anonymous">   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

      <script src="https://kit.fontawesome.com/5076f4faae.js" crossorigin="anonymous"></script>
    
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <!-- sortable  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>

<!-- bootstrab js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- interact js -->
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17"></script>

</head>

<body>
    <nav style="text-align: center;" id="nav">
         <div class='logo'>
         <img src='assets/img/logo.jpg'alt='logo' style="mix-blend-mode: multiply;width:200px ;" > </div>
         
   <form class="pageTitle " action=" " style="    padding: 0px;">
    <div class=" form-group" style="    padding: 0px;">
       <label for="title">Page title:</label>
       
      <input type="text" class="form-control" id="title" placeholder="Enter page title" name="title" style="display: inline-block;    width: 60%;">
    
    <button type="submit" name="title" class="btn" style=" width: 7%; padding: 0; " onclick="updateElement()">Save</button>
    </div>
  </form>
         <!-- 
         
        </div> -->

  <div  class="save-and-preview-buttons">
            <button class="save-button three_btns "  onclick="downloadHtml()"> 
            <i class="fa-solid fa-download" style="color: #ffffff; "></i>
            <span class="hedden-content" >Save as html</span></button>
            
            <button class="preview-button three_btns" onclick="codeModal()" >
            <i class="fa-solid fa-code" style="color: #ffffff;"></i>
              <span class="hedden-content">Show Code</span> </button>
            <button class="empty-button three_btns"  onclick="executeSQL()" >  
                <i class="fa-regular fa-trash-can" style="color: #ffffff; "></i>
                <span class="hedden-content" >Empty Page
            </button>
        </div>
    <script>
      function downloadHtml() {
      
        fetch('http://localhost/GP-2023/api/BuildGenerate/generate_code.php')
    .then(response => response.text())
    .then(html => {
      // create a new Blob object with the HTML content
      const blob = new Blob([html], {
        type: 'text/html'
      });

      // create a new URL object for the Blob
      const url = URL.createObjectURL(blob);

      // create a new anchor element to trigger the download
      const a = document.createElement('a');
      a.href = url;
      a.download = 'my_html_file.html';

      // append the anchor element to the document
      document.body.appendChild(a);

      // trigger the download
      a.click();

      // clean up the anchor element and URL object
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
    });
}



      function executeSQL() {
        $('#canvas').empty();
        refreshIframe();
        // create an XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // set up the request parameters
        xhr.open('DELETE', 'http://localhost/GP-2023/api/element/deleteAll.php'); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // set up the callback function
        xhr.onload = function() {
          if (xhr.status === 200) {
            // handle the response
            console.log(xhr.responseText);
          }
        };

        // send the request
        xhr.send(); // replace 'YOUR_SQL_QUERY' with your actual SQL query
      }

      // JavaScript code for code modal
      function codeModal() {
  // Get the modal element
  var modal = document.getElementById("codeModal");

  // Get the iframe element
  var iframe = document.getElementById("codeIframe");

  // Set the source URL for the iframe
  iframe.src = "code.php"; // Replace with your desired URL

  // Display the modal
  modal.style.display = "block";
}

function closeModal() {
  // Get the modal element
  var modal = document.getElementById("codeModal");

  // Hide the modal
  modal.style.display = "none";

  // Clear the iframe source URL
  var iframe = document.getElementById("codeIframe");
  iframe.src = "";
}

    </script>

        
    </nav>
    <!-- <iframe class="col-xs-12 platform" src="platform.php"  >     

</iframe> -->
<div class="col-xs-2">


  <div id="login"><a href="login.php">Log in / Sign Up</a></div>



    <script>
      function updateElement() {
        event.preventDefault(); // Prevent form submission

        // Get the input value
        var content = document.getElementById('title').value;
        var element_id = 4;
        // Create the data object
        var data = {
          element_id: element_id,
          content: content
        };
 // Send the AJAX request
 var xhr = new XMLHttpRequest();
        xhr.open('PUT', 'http://localhost/GP-2023/api/element/updateContent.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              alert('Title updated');
            } else {
              alert('Error updating element');
            }
          }
        };
        xhr.send(JSON.stringify(data));
      }
    </script>


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
        $m=1;

        echo '<div class="tags">';

        echo 'Basic <br>';
             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
               extract($row);
               $tag_item = array(
                 'tag_id' => $tag_id,
                 'tag_name' => $tag_name,
                 //'tag_level' => $tag_level
               );
               array_push($tag_arr, $tag_item);
               
               if ($tag_name != 'head' && $tag_name != 'body' && $tag_name != 'title'&& $tag_name != 'html' && $tag_name != 'header' && $tag_name != 'footer'){
                 echo ' <div class="element"  draggable="true" style="margin-left:5px" tag_name="' . $tag_name . '" tag_ID="' . $tag_id . '" tag_level="4">' . $tag_name . '</div>';
                    } elseif ($tag_name == 'header' || $tag_name == 'footer' ){
                      if($m == 1){
                     echo '<br> 
                     Extra <br>';
                     $m--;}
                     echo ' <div class="element"  draggable="true" style="margin-left:5px" tag_name="' . $tag_name . '" tag_ID="' . $tag_id . '" tag_level="4">' . $tag_name . '</div>';
                    }
            
             }}
               
     
            
            
             echo '</div>';
      // Encode the array without the "data" key

      ?>
    </div>

  </div>
   <br>
 <!-- <button class="btn selectBody nelement" id="selectBody" >body</button>  -->
 </div> 

    <!-- --------------------CANVAS----------------------- -->
    
    <div id="displayDesign" class="col-xs-8" style="padding: 0px;">
      <div class="design-area"style="    margin-top: -1%;">
      <div class="canvas-head canvas-tool" >
      <button id="sortButton" onclick="toggleSortable()"><i class="fa-solid fa-sort" style="color: #2055b9;"></i> Enable Sorting</button>
      <button id="delete-element" onclick="deleteElement()" ><i class="fa-regular fa-trash-can" style="color: #2055b9;"></i></button>
      </div>
      <div class="canvas-head" style="margin-left: 0.1%;">
    <div class="three-circle">
  <span class="left " style="background-color: #E74C3C;"></span>
  <span class="left " style="background-color: #F4A62A;"></span>
  <span class="left " style="background-color: #16A085;"></span>
</div>
<!-- <button style="background-color: #333; color:dimgrey;" onclick="zoomIn()">&#43;</button>  -->
 <!-- <button style="background-color: #333; color:dimgrey;" onclick="zoomOut()">&#8722;</button>   -->
 
 <script>
    function zoomIn() {
  var iframe = document.getElementById('preview');
  if (iframe) {
    iframe.contentDocument.body.style.zoom = parseFloat(iframe.contentDocument.body.style.zoom) + 1;
  }
  
}

function zoomOut() {
  var iframe = document.getElementById('preview');
  if (iframe) {
  iframe.contentDocument.body.style.zoom = parseFloat(iframe.contentDocument.body.style.zoom) - 1;
}}
  </script>
  <button id="reload" onclick="refreshIframe()"><i class="fa-solid fa-rotate-right" style="color: #ffffff;"></i></button>
</div>
    <div id="canvas" class=" sortable" ondrop="canvasDrop(event)">

</div>

<!-- <button id="myBtn">Open Modal</button> -->

<!-- The Modal -->
<div id="myModal" class="modal" style="height:100px ; background-color: red;">

  <!-- Modal content -->
  <div class="modal-content"> 
  <span id="close">&times;</span>
    <input>
  </div>

</div>
  
  <?php
  // echo '<button id="save-button">Save Canvas</button>'
  ?>
  <iframe src="http://localhost/GP-2023/api/BuildGenerate/generate_code.php" id="preview" onload="initializeZoom()">

  </iframe>



 <?php
//    // Import the Element class from the model folder
//     include_once 'models/Element.php';
//     include_once 'config/Database.php';

//     // Instantiate a new Element object
//     $database = new Database();
//     $db = $database->connect();

//     $element = new Element($db);
//     ini_set('display_errors', true);
//     error_reporting(E_ALL);

//     // Build the DOM tree for the given root node ID
//    echo  $html = $element->generate_html_from_database3(); 
//     ?>

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
</div>
</div></div>
<div>
<!-- <div class="modes" >
            <input type="radio" id="designMode" name="mode" value="design" checked="">
            <label for="design">Design Mode</label>
            <input type="radio" id="codeMode" name="mode" value="code">
            <label for="css">Code Mode</label>
</div> -->
<div  id="properties" class="col-xs-3">

                    <div class="form-btn">
                        <label style="color:#Fff ;" onclick="properties()">Properties</label>
                        <label style="color:#Fff ;" onclick="show_style()">Style</label>
                        <hr id="indicator">
                    </div>
                    
                  
               
          <script> 
            //   var properties=document.getElementById("element_properties");
            // var style=document.getElementById("style");
            var indicator=document.getElementById("indicator");
            function properties(){
                  $("#element_properties").css("display", "inline-block");
                 $("#style").css("display", "none") ;
                indicator.style.transform="translatex(-18px)";
            }
            function show_style(){
              $("#element_properties").css("display", "none");
                 $("#style").css("display", "inline-block");
                indicator.style.transform="translatex(47px)";

            }
            </script>   
  

  <div id="element_properties" style="display: none;">         </div>
  <div id="style" style="display: inline-block;">        </div>

 
            <!-- <iframe src="properties_info.php" title="properties_info" class="col-xs-12" name="my-iframe">

</iframe> -->
  
         
  
    </div>
</div>

<!-- Table Modal -->
<div id="tableModal" class="tableModal">
  <div class="tableModal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <label for="rowInput">Number of Rows:</label>
    <input type="number" id="rowInput" min="1" value="1">
    <label for="colInput">Number of Columns:</label>
    <input type="number" id="colInput" min="1" value="1">
    <button onclick="generateTable()">Generate Table</button>
  </div>
</div>
     
 <!-- code modal -->
 <div id="codeModal" class="modal">
  <div class="modal-content" style="background-color: #c6cedd; height:90%;">
    <span class="close" onclick="closeModal()">&times;</span>
    <iframe id="codeIframe" frameborder="0" style="width: 100%; height: 90%;">
  </iframe>
  </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>  
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
