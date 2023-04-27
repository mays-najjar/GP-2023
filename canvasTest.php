    <!-- <script>  <link rel="icon" type="image/gif" href="animated_favicon1.gif" /> </script>
    
    <link rel="shortcut icon" href="favicon.ico" /> -->

<!-- db= html_tag -->
<?php
include('config/Database.php');
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

$result= mysqli_query($conn ,"SELECT * FROM tag ");  // رح يجبلي كل البيانات  result 
// يحط البيانات في اريه 


?>


<!-- <html>

<style> 
      .test{
        width: 163px;
        height: fit-content;
      }
     .toolbar {
            justify-content: center;
            align-items: center;
            height: 80px;
            background-color: #f2f2f2;
            padding-left: 50px;
            border-color: black;
            display: inline-block;
            margin: 10px;
            box-sizing:border-box;
        }

        .test .element {
            margin: 0 10px;
            padding: 10px;
            cursor: pointer;
            width: 50px;
            height: 50px;
            background-color: #aaa;
            cursor: pointer;
            border: violet;
            border-width: 5;
            border-style: inset;
            /* display: inline-block; */
        }

        /* Styles for canvas */
        .canvas {
            width: 500px;
            height: 300px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }

        /* Styles for draggable elements */
       .element {
            /* position: absolute; */
            width: 50px;
            height: 50px;
            background-color: #aaa;
            cursor: pointer;
            border: violet;
            border-width: 5;
            border-style: inset;
           
        }

        .nelement{
            position: absolute;
            width: 50px;
            height: 50px;
            background-color: #aaa;
            cursor: pointer;
        }
  </style>
  <body>
  <div class="test">
       <?php
       while($row= mysqli_fetch_array($result)){
        echo"
        <div class='element' draggable='true' style=' margin-left:10px; '>
        $row[tag_name]
       </div>
       ";}?>
  
    </div>
    <div class="canvas" id="canvas"></div>

    <script>
        // Get the canvas element
        const canvas = document.getElementById('canvas');

        // Add event listener for dragging elements from toolbar
        document.querySelectorAll('.element').forEach(element => {           
            element.addEventListener('dragstart', (event) => {                                                   //يعني نفّذ أمر معيّن لما تتغير قيمة readyState
                // Set the data being dragged
                event.dataTransfer.setData('text/plain', event.target.textContent);                                //the event object is used to access information about the drag event. 
            });                                                                                                      // The event.target property refers to the element that triggered the event, which is the element being dragged in this case.   
        });                                                                                                              // The textContent property of the dragged element is used as the data being dragged.  ,,,The event.dataTransfer object is used to set the data being dragged. In this case, the setData method is called with two arguments: the first argument is the data type, which is set to 'text/plain', and the second argument is the data itself, which is set to the textContent of the dragged element.

        // Add event listener for dropping elements onto canvas
        canvas.addEventListener('dragover', (event) => {
            event.preventDefault();
        });

        canvas.addEventListener('drop', (event) => {
            event.preventDefault();
            const elementText = event.dataTransfer.getData('text/plain');
            const newElement = document.createElement('div');
            newElement.className = 'nelement';
            newElement.textContent = elementText;
            newElement.style.left = event.clientX.canvas + 'px';
            newElement.style.top = event.clientY.canvas + 'px';
            newElement.addEventListener('mousedown', startDrag);
            canvas.appendChild(newElement);
        });

        // Function to handle dragging of elements on canvas
        function startDrag(event) {
            const element = event.target;
            const offsetX = event.clientX.canvas - element.getBoundingClientRect().left;
            const offsetY = event.clientY.canvas - element.getBoundingClientRect().top;

            document.addEventListener('mousemove', moveElement);
            document.addEventListener('mouseup', stopDrag);

            function moveElement(event) {
                const x = event.clientX.canvas - offsetX;
                const y = event.clientY.canvas - offsetY;
                element.style.left = x + 'px';
                element.style.top = y + 'px';
            }

            function stopDrag() {
                document.removeEventListener('mousemove', moveElement);
                document.removeEventListener('mouseup', stopDrag);
            }
        }
    </script>
</body>

</html> -->
1111111111111111

 <!-- <div id="toolbar">
   <div class="element" draggable="true" data-properties="width,height,color">
      Rectangle
   </div>
   <div class="element" draggable="true" data-properties="radius,color">
      Circle
   </div>
</div>

<div id="canvas" ondrop="drop(event)" ondragover="allowDrop(event)">
   Drop elements here
</div>

<script>
   function allowDrop(event) {
      event.preventDefault();
   }
   
   function drop(event) {
      event.preventDefault();
      var element = event.dataTransfer.getData("text");
      var properties = event.target.getAttribute("data-properties");
      var message = "Set properties for " + element + ": " + properties;
      alert(message);
      // create and insert element into the canvas
   }
   
   var elements = document.querySelectorAll(".element");
   for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener("dragstart", function(event) {
         event.dataTransfer.setData("text", event.target.textContent);
      });
   }
</script> -->
222
<!-- Toolbar with draggable elements
<div id="toolbar">
   <div class="element" draggable="true">Element 1</div>
   <div class="element" draggable="true">Element 2</div>
   <div class="element" draggable="true">Element 3</div>
</div>

// Canvas where the elements will be dropped 
<div id="canvas" style="height: 100px;"></div>

// Block that will appear when an element is dropped 
<div id="block" style="display: none;">
   <h3>Please set the element's properties:</h3>
   <label for="property1">Property 1:</label>
   <input type="text" id="property1"><br>
   <label for="property2">Property 2:</label>
   <input type="text" id="property2"><br>
   <button id="save">Save</button>
   <button id="cancel">Cancel</button>
</div>

<script>
    // Get the toolbar and canvas elements
const toolbar = document.getElementById("toolbar");
const canvas = document.getElementById("canvas");

// Add an event listener to each element in the toolbar
const elements = toolbar.querySelectorAll(".element");
elements.forEach(element => {
   element.addEventListener("dragstart", () => {
      // Hide the block when dragging starts
      const block = document.getElementById("block");
      block.style.display = "none";
   });
});

// Add an event listener to the canvas to show the block when an element is dropped
canvas.addEventListener("drop", (event) => {
   // Prevent the default behavior of dropping
   event.preventDefault();
   
   // Get the element that was dropped
   const element = document.getElementById(event.dataTransfer.getData("text"));
   
   // Show the block and position it relative to the dropped element
   const block = document.getElementById("block");
   block.style.display = "block";
   block.style.left = `${event.clientX}px`;
   block.style.top = `${event.clientY}px`;
   
   // Add event listeners to the save and cancel buttons
   const saveButton = document.getElementById("save");
   const cancelButton = document.getElementById("cancel");
   saveButton.addEventListener("click", () => {
      // TODO: Save the element's properties and add it to the canvas
      block.style.display = "none";
   });
   cancelButton.addEventListener("click", () => {
      // TODO: Remove the element from the canvas
      block.style.display = "none";
   });
});

// Add an event listener to the canvas to prevent the default behavior of dragging over it
canvas.addEventListener("dragover", (event) => {
   event.preventDefault();
});

</script> -->

333