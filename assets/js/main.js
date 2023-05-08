// Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');
// var selected_tag =document.getElementById('selected_tag');
let tempElementID = "";
let counter = 0;
var myTags =[];// array to store data
let tempElementName = "";
// Define the value to send to the session
let id_value = "";
// Get the hidden input field from the form
const tempElementInput = document.getElementById("temp-element-id");

// Add event listener for dragging elements from toolbar
document.querySelectorAll('.element').forEach(element => {    
       
    element.addEventListener('dragstart', (event) => {  
        console.log("start");                                                 //يعني نفّذ أمر معيّن لما تتغير قيمة readyState
        // Set the data being dragged
        event.dataTransfer.setData('text/plain', event.target.textContent);                                //the event object is used to access information about the drag event. 
        // dataTransfer>> prperity >>is an object that contains the data being transferred during a drag and drop operation. It has several methods that can be used to set and retrieve data, including 'setData', 'getData', and 'clearData'.
        //setDta>> method
        const selectedElements = document.querySelectorAll(".selected");
        // Loop through each selected element and remove the "selected" class
        selectedElements.forEach(function(element) {
         element.classList.remove("selected");
         });
          // Update the temporary variable to remove the ID of the dragged element
    tempElementID = "";
     //console.clear(); 
        });
    // Set the value of the hidden input field to the updated temporary element ID
    // tempElementInput.value = tempElementID;
     // Add event listener for end dragging elements from toolbar
element.addEventListener("dragend", function(event) {
    // Get the ID of the dragged element and update the temporary variable
    const draggedElementID = element.id;
    tempElementID = draggedElementID;
          // Set the value of the hidden input field to the updated temporary element ID
    //   tempElementInput.value = tempElementID;
  console.log("dasfsaf");

 
});                                                                                                                       //the event object is used to access information about the drag event. 
               });                                                                                                                     //***  The 'event.target' property is then used to access the z element that triggered the event  
                                                                                                            // The textContent property of the dragged element is used as the data being dragged.  ,,,The event.dataTransfer object is used to set the data being dragged. In this case, the setData method is called with two arguments: the first argument is the data type, which is set to 'text/plain', and the second argument is the data itself, which is set to the textContent of the dragged element.


// Add event listener for dropping elements onto canvas
canvas.addEventListener('dragover', (event) => {
    event.preventDefault();  //In this case, the default behavior is to disallow dropping the dragged element onto the canvas element.
    event.dataTransfer.dropEffect = 'copy';

});
//get ajax
var xhttp = new XMLHttpRequest();
var myTags =[];// array to store data
xhttp.open("GET","http://localhost/GP-2023/api/tag/read.php");  // فتح اتصال مع السيرفر
xhttp.send();
xhttp.addEventListener('readystatechange', function() {
    if (this.readyState == 4 && this.status == 200) {
      myTags=JSON.parse(xhttp.response); //json.parse  convert string to array of objects
      console.log(myTags);
    }

    else console.log(this.readyState);
  });
canvas.addEventListener('drop', (event) => {
    event.preventDefault();
    
    counter = counter+1;
    const elementText = event.dataTransfer.getData('text/plain');  // retrieves the text data of the dragged element and assigns it to the elementText variable.
    const  newElement = document.createElement(elementText.trim());
    //   داخل جواب الشرط مما يعني أنه لا يمكن الوصول إليه إلا داخلها بالتالي يسبب مشكلة عند استدعائها لاحقاً newElement لانه اذا عرفنا ال
    // if (elementText.trim() == 'footer') {
    //   newElement = document.createElement('div');
    // } else if (elementText.trim() == 'h2') {
    //   newElement = document.createElement('h2');
    // }else {
    //   newElement = document.createElement(elementText.trim());
    // }
    newElement.className = 'nelement' ;                 //the DIV class IS (nelement),
    newElement.id =elementText.trim()+'_'+counter;
    id_value=elementText.trim();
    newElement.textContent = newElement.id;              //the DIV textContent property is set to the elementText value. 
    newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
    newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
    newElement.addEventListener('mousedown', startDrag);
    canvas.appendChild(newElement);
    
    //nelement properties
    //
    
    newElement.classList.add('selected');
    newElement.onclick=selected();
    newElement.setAttribute('draggable' , 'true' );
    //newElement.ondrag(draged());
    //selected_tag.textContent = elementText.trim(); 
  
    // updateProperties(newElement.id);
      // show the properties block and set its values based on the dropped element
  const propertiesBlock = document.getElementById('element_properties');
  //propertiesBlock.style.display = 'block';
  
  //  tempElementID =elementText.trim();
  //  console.log("Temporary element ID:", tempElementID);
  //  id_value=newElement.id ;

   // post ajax
   
  // Send an AJAX request to create the element on the server

  const xhr = new XMLHttpRequest();
  const url = 'http://localhost/GP-2023/api/element/create.php';
  const data = {
    "tag_id" : id_value,
    "content" : newElement.textContent,
    "parent_id" : "11",
    "children_order" : "1"
 };
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response.message);
    }
  };
  xhr.send(JSON.stringify(data));
  
//    $.ajax({
//     url: 'http://localhost/GP-2023/api/element/create.php',
//     method: 'POST',
//     data: {
//       element_id: newElement.id,
//       tag_id: 1,
//       parent_id : canvas,
//       // x: elementX,
//       // y: elementY,
//       children_order: 2
//       },
//     error: function(jqXHR, textStatus, errorThrown) {
//       console.error(errorThrown);
//   }
// });

  


// post ajax
//      var xhttp = new XMLHttpRequest();
//      // Define the PHP page URL and set the HTTP method to POST
//   var url = "createElement.php";
//   xhttp.open("POST", url, true);
//  // xhttp.open("Content-type","http://localhost/GP-2023/api/tag/read.php");  // فتح اتصال مع السيرفر
// xhttp.open("Content-type","http://localhost/GP-2023/api/ElementAttribute/read_single.php");  // فتح اتصال مع السيرفر
//   xhttp.send(id_value);
  
// xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//           // Do something with the response text (if any)
//           console.log(xhttp.responseText);
//           console.log('uuu');
//     }
  
//   };
   
 createElement();
//  // yazeed ajax
//  tag_namee =elementText.trim();
//  const xhr = new XMLHttpRequest();

//  xhr.onreadystatechange = function() {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       console.log(xhr.responseText);
//       console.log('tir');
//      //document.getElementById("demo").innerHTML = xhr.responseText;
//     }
//   };
  
// xhr.open("POST", "createElement.php", true);
// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
// // convert the object to a JSON string
// var json = JSON.stringify(data);

// xhr.send(json);;

// //send ajax to create element   true true
// var tag_name =elementText.trim();
// var data = {  tag_id:3, parent_id:$("canvas"),children_order:0};
// $.ajax({
//   url: 'http://localhost/GP-2023/api/element/create.php',
//   type: 'POST',
//   data: data,
//   success: function(response) {
//     console.log(response);
//     console.log("hi from create element api consol");
//   },
//   error: function(xhr, status, error) {
//     console.log(error);
//   }
// });


// // check if create element api returns array
// var xhttp1 = new XMLHttpRequest();
// var myTags1 =[];// array to store data
// xhttp1.open("GET","http://localhost/GP-2023/api/element/create.php");  // فتح اتصال مع السيرفر
// xhttp1.send();
// xhttp1.addEventListener('readystatechange', function() {
//     if (this.readyState == 4 && this.status == 200) {
//       myTags1=JSON.parse(xhttp1.response); //json.parse  convert string to array of objects
//       console.log(myTags1);
//       consol.log("done");
//     }

//     else console.log(this.readyState);
//   });
 
 
// // ajax end 

//    // jum Create a new XMLHttpRequest object
// const xhr = new XMLHttpRequest();
// // Set the HTTP method and URL of the request
// xhr.open("POST", "index.php");
// console.log("end ",xhr);
// // Set the Content-Type header of the request
// xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

// xhr.onload =function  ( ){
// console.log(tempElementID);

// }
// // Send the request with the "value" parameter
// xhr.send("id_value=" + encodeURIComponent(tempElementID));
//   // Set the value of the hidden input field to the updated temporary element ID
//  tempElementInput.value = tempElementID;
// // Submit the form to the PHP file
// document.getElementById("temp").submit();

});
// end drop event

// function drop(event) {   alert(`You dropped a ${tagName} element onto the canvas.`);}

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

// canvas.addEventListener('click', (event) => {
// element.classList.remove('selected'); 
// });


var demo =document.getElementById("demo");
  function display_properties(){
    console.log(myTags.length);
    var data =``;
    for (var i=0;i<myTags.length;i++){
        data+=`
         <h2>${myTags[i].tag_name} </h2>
         <p>${myTags[i].tag_id}</p>
            `;
    demo.innerHTML=data;
     console.log('datafffffff');
   }
}

//selected function for nelement

  function selected(){
  $(document).ready(function() {
    // Add click event listener to each element
    $(".nelement").on('click', function() {
      // Deselect all the elements
      $(".nelement").removeClass('selected');
  
      // Select the clicked element
      $(this).addClass('selected');
    });
  });
  }

// // draged function for nelement
// nelement.set({
 
//   lockMovementX: false, // enable horizontal movement
//   lockMovementY: false // enable vertical movement
// });
// function draged(){
//   $(".nelement").setAttribute("draggable", "true");
// $(function() {
//   $(".nelement").draggable({
//     axis: "y",
//     grid: [0, 50],
//     stop: function() {
//       // Function to reposition elements after drag stops
//       // This function will be called after the dragging stops
//     }
//   });
// });

// }

  // ---------------------- dispaly modes--------------------
  $("#designMode").click( function(){
    $("#canvas").css("display","inline-block")
    $("#codeCanvas").css("display","none")
  });
   $("#codeMode").click( function(){
    $("#codeCanvas").css("display","inline-block")
    $("#canvas").css("display","none")
  });
  //  $("#codeMode").click( function(){
  //   alert("nnn");
  //  });

  // // in jquery
  // $( function() {
  //   $( "#canvasBody" ).sortable();
  // } );


  ////
  // Make the elements draggable
// $('.nelement').draggable({
//   containment: '#canvas'
// });

// // Make the canvas droppable
// $('#canvas').droppable({
//   drop: function(event, ui) {
//     // Get the dropped element
//     var droppedElement = ui.draggable;

//     // Set its position in the canvas
//     droppedElement.css({
//       top: ui.offset.top,
//       left: ui.offset.left
//     });
//   }
// });

// // Make the elements sortable
// $('#canvas').sortable({
//   axis: 'y', // Only allow vertical sorting
//   tolerance: 'pointer', // Sort when the mouse is over an element
//   containment: '#canvas', // Sort only inside the canvas
//   handle: '.nelement', // Use the .nelement class as the handle for sorting
//   start: function(event, ui) {
//     // Add a class to the element being sorted
//     ui.item.addClass('sorting');
//   },
//   stop: function(event, ui) {
//     // Remove the sorting class
//     ui.item.removeClass('sorting');
//   }
// });


// var data = {
//   tag_name: tagName,
//   tag_id: tagId,
//   attribute_name: attributeName,
//   attribute_id: attributeId,
//   attribute_value: attributeValue,
//   element_content: elementContent,
//   parent_id: parentId,
//   child_id: childId
// };

 // yazeed ajax
function createElement(){

 
}