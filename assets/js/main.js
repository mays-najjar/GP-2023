// Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');
// var selected_tag =document.getElementById('selected_tag');
let tempElementID = "";
let counter = 0;
let initialPosition = null;
var myTags = [];// array to store data
var nelementsArray =[];
let tempElementName = "";
// Define the value to send to the session
let id_value = "";
// Define a variable to store the reference of the dragged element
let draggedElement;
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
    event.dataTransfer.setData('tagLevel', event.target.getAttribute('tag_level'));
    event.dataTransfer.setData('tagName', event.target.getAttribute('tag_name'));
    event.dataTransfer.setData('tagID', event.target.getAttribute('tag_ID'));
    const selectedElements = document.querySelectorAll(".selected");
    // Loop through each selected element and remove the "selected" class
    selectedElements.forEach(function (element) {
      element.classList.remove("selected");
    });
    // Update the temporary variable to remove the ID of the dragged element
    tempElementID = "";
    //console.clear(); 
  });
  // Set the value of the hidden input field to the updated temporary element ID
  // tempElementInput.value = tempElementID;
  // Add event listener for end dragging elements from toolbar
  element.addEventListener("dragend", function (event) {
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
var myTags = [];// array to store data
xhttp.open("GET", "http://localhost/GP-2023/api/tag/read.php");  // فتح اتصال مع السيرفر
xhttp.send();
xhttp.addEventListener('readystatechange', function () {
  if (this.readyState == 4 && this.status == 200) {
    myTags = JSON.parse(xhttp.response); //json.parse  convert string to array of objects
    console.log(myTags);
    console.log("result of function", getIDofTag(myTags, "h2"));

  }

  else console.log(this.readyState);
});
function getIDofTag(arrayOFTags, Name) {
  var desc = arrayOFTags.find(function (e) {
    return e.tag_name == Name
  })

  if (desc) {
    console.log("name ", desc.tag_id);
    return desc.tag_id;
  }
}
function canvasDrop(event){
// canvas.addEventListener('drop', (event) => {
  event.preventDefault();
  // const id = event.dataTransfer.getData('id');
  const tagLevel = event.dataTransfer.getData('tagLevel');
  console.log("tagLevel IS");
  console.log(tagLevel);
  const tagName = event.dataTransfer.getData('tagName');
  console.log("tagName IS");
  console.log(tagName);
  const tagID = event.dataTransfer.getData('tagID');
  console.log("tagID IS");
  console.log(tagID);
  const xhr1 = new XMLHttpRequest();
  // xhr1.onreadystatechange = function() {
  //    if (xhr1.readyState == 4 && xhr1.status == 200) {
  //     document.getElementById("demo").innerHTML = xhr1.responseText;
  //    }
  //  }; 
  xhr1.open("POST", "index.php", true);
  xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr1.send("tagID=1&itemID=2");

  counter = counter + 1;
  const elementText = tagName;  // retrieves the text data of the dragged element and assigns it to the elementText variable.
  console.log("tagName nn" + tagName);
  console.log(tagName);
  
//if (nelementsArray[this].length) is checking if the element in nelementsArray at the index specified by this has a length property that is not zero. If the length is not zero, the code within the if block will be executed.
  //  else{
  const newElement = document.createElement(tagName);
  //   داخل جواب الشرط مما يعني أنه لا يمكن الوصول إليه إلا داخلها بالتالي يسبب مشكلة عند استدعائها لاحقاً newElement لانه اذا عرفنا ال
  // if (tagName == 'footer') {
  //   newElement = document.createElement('div');
  // } else if (tagName == 'h2') {
  //   newElement = document.createElement('h2');
  // }else {
  //   newElement = document.createElement(tagName);
  // }
  newElement.className = 'nelement selected';                 //the DIV class IS (nelement),
  newElement.id = tagName + '_' + counter;
  id_value = tagName; //???????
  newElement.textContent = newElement.id;              //the DIV textContent property is set to the elementText value. 
  newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
  newElement.classList.add('selected');
  newElement.onclick = selected();
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('tag_name', tagName);
  newElement.setAttribute('tag_iD', tagID);
  newElement.setAttribute('tag_level', tagLevel);
  // draggable nelements ondrop=
  newElement.setAttribute('ondrop','drop(event)');
  newElement.setAttribute('ondragover','allowDrop(event)');
  newElement.setAttribute('ondragstart','drag(event)');

  //newElement.ondrag(draged());
  //selected_tag.textContent = tagName; 

  canvas.appendChild(newElement);
  nelementsArray.push(newElement);
console.log(nelementsArray);
  
  // Get the dropped element's HTML content
  const html = event.dataTransfer.getData("text/html");
  // Display the HTML code
  document.getElementById("codeBody").innerHTML += html;
  // Get the id and level of the element being dropped
  //nelement properties
  //
  // Deselect all the elements
  $(".nelement").removeClass('selected');


  const xhhr = new XMLHttpRequest();

  xhhr.onreadystatechange = function () {
    if (xhhr.readyState == 4 && xhhr.status == 200) {
      document.getElementById("element_properties").innerHTML = xhhr.responseText;
    }
  };

  xhhr.open("POST", "test.php", true);
  xhhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhhr.send("tagID=1&itemID=2");
  // updateProperties(newElement.id);
  // show the properties block and set its values based on the dropped element
  const propertiesBlock = document.getElementById('element_properties');
  //propertiesBlock.style.display = 'block';

  //  tempElementID =tagName;
  //  console.log("Temporary element ID:", tempElementID);
  //  id_value=newElement.id ;

  //------------------------------------

  // Remove the dragged element from its original position
  if (draggedElement) {
    draggedElement.remove();
  }

  // Rest of your existing code for dropping the element

  // // If dropping is not allowed or no element was dragged, return the dragged element to its original position
  // if (!droppingAllowed || !draggedElement) {
  //   canvas.appendChild(draggedElement);
  // }

  //--------------------------------
  // post ajax

  // Send an AJAX request to create the element on the server

  const xhr = new XMLHttpRequest();
  const url = 'http://localhost/GP-2023/api/element/create.php';
  const data = {
    "tag_id": tagID,
    "content": newElement.textContent,
    "parent_id": "11",
    "children_order": "1"
  };
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response.message);
    }
  };
  xhr.send(JSON.stringify(data));

// element_properties ajax
const xxhr = new XMLHttpRequest();
const tag_ID = tagID;
xxhr.onreadystatechange = function() {
   if (xxhr.readyState == 4 && xxhr.status == 200) {
    console.log(xxhr.responseText);
    document.getElementById("element_properties").innerHTML = xxhr.responseText;
   }
 };
 
xxhr.open("POST", "test.php", true);
xxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
const datta = "tag_ID=" + encodeURIComponent(tag_ID);
xxhr.send(datta);



  // call functions

  createElement();
  //  // yazeed ajax

  //  tag_namee =tagName;
  //  const xhrr = new XMLHttpRequest();

  //  xhrr.onreadystatechange = function() {
  //     if (xhrr.readyState == 4 && xhrr.status == 200) {
  //       document.getElementById("element_properties").innerHTML = xhr.responseText;

  //       console.log(xhrr.responseText);
  //       console.log('tir');

  //     }
  //   };

  // xhrr.open("POST", "test.php", true);
  // xhrr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  // // convert the object to a JSON string
  // var json = JSON.stringify(data);

  // xhrr.send(json);

  // //send ajax to create element   true true
  // var tag_name =tagName;
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


//} // end if condition

// });// end drop event

}  //end canvasDrop function

//Initialize SortableJS on the canvas element:
Sortable.create(document.querySelector('.sortable'), {
  animation: 150
});


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


var demo = document.getElementById("demo");
//   function display_properties(id){
//   //  var targetElementId = $(".selected").attr('id');
// console.log("display");
//     // Get the properties div
//   const propertiesDiv = document.getElementById("element_properties");

//   // Make the AJAX request
// const xhr = new XMLHttpRequest();
// var data = "var1=" + id +  "&var2=" + id;

// xhr.open("GET", `http://localhost/GP-2023/api/ElementAttribute/read_single.php?element_id=${id}`, true);

// xhr.onload = function() {
//   if (xhr.status === 200) {
//     console.log("hi properties",JSON.parse(xhr.responseText));
//     const data = JSON.parse(xhr.responseText);
//     let html = '';
//     data.forEach((attribute) => {
//       html += `
//         <label for="${attribute.attribute_id}">${attribute.attribute_name}:</label>
//         <input type="text" id="${attribute.attribute_id}" name="${attribute.attribute_name}" value="${attribute.attribute_value}">
//       `;
//     });
//     // Use the data to populate the properties div
//     propertiesDiv.innerHTML = html;
//   } else {
//     console.error("Error fetching element properties");
//   }
// };
// xhr.send("element_id=1");
// }

//selected function for nelement

function selected() {
  $(document).ready(function () {
    // Add click event listener to each element
    $(".nelement").on('click', function () {
      // Deselect all the elements
      $(".nelement").removeClass('selected');

      // Select the clicked element
      $(this).addClass('selected');
      //display_properties($(this).attr('id'));

  //    // Get the selected element's tag_ID
  // const tagID = $(this).attr('tag_ID');
  // // Send an AJAX request to the PHP page with the selected element's tag_ID
  // $.ajax({
  //   url: 'properties_info.php',
  //   method: 'POST',
  //   data: { tag_ID: tagID },
  //   success: function(response) {
  //     // Display the nelement properties on the page
  //     $('#nelement_properties').html(response);
  //   }
  // });


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
$("#designMode").click(function () {
  $("#displayDesign").css("display", "inline-block")
  $("#displayCode").css("display", "none")
});
$("#codeMode").click(function () {
  $("#displayCode").css("display", "inline-block")
  $("#displayDesign").css("display", "none")
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

// // // Make the elements sortable
// $(document).ready(function() {
//   const canvas = document.getElementById('canvas');
//   $(canvas).sortable({
//     items: ".nelement",
//     tolerance: "pointer",
//     connectWith: ".nelement",
//     update: function(event, ui) {
//       // code to handle sorting update
//       $(".nelement").each(function(index) {
//         // update element position here
//         $(this).css({
//           left: $(this).position().left,
//           top: $(this).position().top
//         });
//       });
//     }
//   });
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
function createElement() {


}

// -------------------------------nelement dragging-----------------------------//
// // Add event listener for dragging elements from toolbar
// function handleDropBetweenTags(event){
// document.querySelectorAll('.nelement').forEach(nelement => {    

//   nelement.addEventListener('dragstart', (event) => {  
//     draggedElement = event.target;
//     initialPosition = {
//       x: event.clientX - canvas.offsetLeft,
//       y: event.clientY - canvas.offsetTop
//     };
//       console.log("start nelement drag");         
//       // Set the data being dragged
//       event.dataTransfer.setData('text/plain', event.target.textContent);     
//       event.dataTransfer.setData('tagLevel', event.target.getAttribute('tag_level'));
//       event.dataTransfer.setData('tagName', event.target.getAttribute('tag_name'));
//       event.dataTransfer.setData('tagID', event.target.getAttribute('tag_ID'));
//       event.dataTransfer.setData('initialTop', event.target.style.top);
//       console.log("data trans");
//       console.log(initialTop);
//       const selectedElements = document.querySelectorAll(".selected");
//       // Loop through each selected element and remove the "selected" class
//       selectedElements.forEach(function(nelement) {
//        nelement.classList.remove("selected");
//        });
//         // Update the temporary variable to remove the ID of the dragged element
//   tempElementID = "";
//    //console.clear(); 
//       });
//   // Set the value of the hidden input field to the updated temporary element ID
//   // tempElementInput.value = tempElementID;
//    // Add event listener for end dragging elements from toolbar
// nelement.addEventListener("dragend", function(event) {
//     draggedElement = null;
//   const droppedOnValidLocation = event.dataTransfer.dropEffect !== 'none';

//   if (!droppedOnValidLocation) {
//     event.target.style.left = event.dataTransfer.getData('initialLeft');
//     event.target.style.top = event.dataTransfer.getData('initialTop');
//   }

// });                                                                                                                       //the event object is used to access information about the drag event. 
//              });   
// }

// ------------------------------drag over nelement-----------------------------
// select all the elements to add the event listener to
const nelements = document.querySelectorAll('.nelement');

// iterate over each nelement and add the event listener
nelements.forEach(nelement => {
  nelement.addEventListener('dragover', function (event) {
    // handle the dragover event here
    nelement.setAttribute('border', doted)
    console.log("nelement dragover")
  });
});


//
function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("text");
  event.target.appendChild(document.getElementById(data));
}




















////////// drop function on canvas ( js code) , if dropped element have a class ="nelement"  (its already appenden to canvas & added to  nelements array ) then will change its order on array ; 
// else will create new nelement and append to canvas & added it to nelements array 
 
//Here's an example of how you can modify the drop function to achieve the desired behavior:

// function drop(event) {
//   event.preventDefault();
//   // get the data transferred in the drag event
//   var data = event.dataTransfer.getData("text/plain");
//   var element = document.getElementById(data);
//   var canvas = document.getElementById("canvas");

//   // check if the dropped element is a "nelement"
//   if (element.classList.contains("nelement")) {
//     // get the index of the dropped element in the "nelements" array
//     var index = nelements.indexOf(element);

//     // check if the element is being dropped onto another "nelement" with a lower level
//     var targetElement = event.target;
//     while (targetElement != canvas && !targetElement.classList.contains("nelement")) {
//       targetElement = targetElement.parentNode;
//     }
//     if (targetElement != canvas && targetElement.getAttribute("level") >= element.getAttribute("level")) {
//       // do nothing if the element is being dropped onto another "nelement" with a higher or equal level
//       return;
//     }

//     // remove the element from its current position in the "nelements" array
//     nelements.splice(index, 1);

//     // add the element to its new position in the "nelements" array
//     if (targetElement == canvas) {
//       // if the element is being dropped onto the canvas, append it to the end of the "nelements" array
//       nelements.push(element);
//     } else {
//       // otherwise, insert it before the target element in the "nelements" array
//       var targetIndex = nelements.indexOf(targetElement);
//       nelements.splice(targetIndex, 0, element);
//     }

//     // redraw all the "nelements" on the canvas
//     redraw();
//   } else {
//     // create a new "nelement" element
//     var newElement = document.createElement("div");
//     newElement.setAttribute("class", "nelement");
//     newElement.setAttribute("draggable", "true");
//     newElement.setAttribute("id", "nelement" + nelementCount++);
//     newElement.setAttribute("level", "1");
//     newElement.style.left = (event.clientX - canvas.offsetLeft) + "px";
//     newElement.style.top = (event.clientY - canvas.offsetTop) + "px";
//     newElement.textContent = "New Element";
//     canvas.appendChild(newElement);

//     // add the new element to the "nelements" array
//     nelements.push(newElement);

//     // redraw all the "nelements" on the canvas
//     redraw();
//   }
// }




