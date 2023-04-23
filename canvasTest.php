<!-- db= html_tag -->
<?php
include('config/Database.php');
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

$result= mysqli_query($conn ,"SELECT * FROM tag ");  // رح يجبلي كل البيانات  result 
// يحط البيانات في اريه 


?>


<html>

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

</html>


