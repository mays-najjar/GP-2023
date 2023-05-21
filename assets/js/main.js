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
let draggedIndex=0;
// Get the hidden input field from the form
const tempElementInput = document.getElementById("temp-element-id");
// variable to store value if dropped element is have nelement Class or not
var hasNelementClass = 0 ;
// Add event listener for dragging elements from toolbar
document.querySelectorAll('.element').forEach(element => {

  element.addEventListener('dragstart', (event) => {
    console.log("start");    
    const droppedElement= event.target;   
    console.log("droppedElement"); 
    console.log(droppedElement);
     hasNelementClass = 0;                                                                     //يعني نفّذ أمر معيّن لما تتغير قيمة readyState
    // Set the data being dragged
    event.dataTransfer.setData('text/plain', event.target.textContent);                                //the event object is used to access information about the drag event. 
    // dataTransfer>> prperity >>is an object that contains the data being transferred during a drag and drop operation. It has several methods that can be used to set and retrieve data, including 'setData', 'getData', and 'clearData'.
    //setDta>> method
    event.dataTransfer.setData('tagLevel', event.target.getAttribute('tag_level'));
    event.dataTransfer.setData('tagName', event.target.getAttribute('tag_name'));
    event.dataTransfer.setData('tagID', event.target.getAttribute('tag_ID'));
    event.dataTransfer.setData('droppedElement', event.target);
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
    console.log("dragend");


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
  // const droppedElement = event.dataTransfer.getData('droppedElement');
  //  console.log("droppedElement  cc"); 
  //   console.log(droppedElement.outerHTML);
  if (hasNelementClass==1) {
    // The dropped element has the class "nelement"
    console.log('Dropped element has class "nelement"');
    drop(event);
  } else {
    // The dropped element does not have the class "nelement"
    console.log('Dropped element does not have class "nelement"');
  
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

  newElement.className = 'nelement';                 //the DIV class IS (nelement),
  newElement.id = tagName + '_' + counter;
  id_value = tagName; //???????
  newElement.textContent = tagName;              //the DIV textContent property is set to the elementText value. 
  newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
  newElement.classList.add('selected');
  newElement.onclick = selected(newElement);
  newElement.ondblclick = handleDoubleClick;
  newElement.setAttribute('data-content', newElement.textContent)
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('tag_name', tagName);
  newElement.setAttribute('tag_iD', tagID);
  newElement.setAttribute('tag_level', tagLevel);
  // draggable nelements ondrop=
  newElement.setAttribute('ondrop','drop(event)');
  newElement.setAttribute('ondragover','allowDrop(event)');
  newElement.setAttribute('ondragstart','drag(event)');

  newElement.setAttribute("data-toggle", "tooltip");
  newElement.setAttribute("title", "double click to edit content");

  //newElement.ondrag(draged());
  //selected_tag.textContent = tagName; 

  canvas.appendChild(newElement);

nelementsArray.push(newElement);
console.log(nelementsArray);
const index=nelementsArray.indexOf(newElement);
console.log("index IS");
console.log(index);

const targetElement = event.target;

  // if (targetElement === draggedElement) {
  //   return;
  // }
  const targetIndex = parseInt(targetElement.getAttribute('index'));
  console.log(targetIndex);
  newElement.setAttribute('index',index);

  // $(".nelement").removeClass('selected');


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
element_properties(tagID);




  // call functions

  createElement();
 
//} // end if condition

// });// end drop event
}
 // end else pracits
} 
 //end canvasDrop function

//Initialize SortableJS on the canvas element:
// Sortable.create(document.querySelector('.sortable'), {
//   animation: 1
// });


var demo = document.getElementById("demo");
// 
function element_properties(tagID) {
const xxhr = new XMLHttpRequest();
var tag_ID = tagID;
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
}
//selected function for nelement

function selected(tag) {
  $(document).ready(function () {
    // Add click event listener to each element
    $(".nelement").on('click', function () {
      // Deselect all the elements
      $(".nelement").removeClass('selected');
      // Select the clicked element
      $(this).addClass('selected');
        //  console.log(tagID);
   var tag_ID = tag.getAttribute("tag_id");
   console.log(tag_ID);
     // element_properties ajax
     element_properties(tag_ID);
    //  document.getElementById("myModal").style.display = "block";
    


    });
  });
}



// ---------------------- dispaly modes--------------------
$("#designMode").click(function () {
  $("#displayDesign").css("display", "inline-block")
  $("#displayCode").css("display", "none")
});
$("#codeMode").click(function () {
  $("#displayCode").css("display", "inline-block")
  $("#displayDesign").css("display", "none")
});




function createElement() {


}

// -------------------------------nelement dragging-----------------------------//
function drag(event) {
  hasNelementClass =1;
  draggedElement = event.target;
  console.log(draggedElement);
  console.log("dragged Index IS");
  console.log(nelementsArray.indexOf(draggedElement));  // true 
   draggedIndex=parseInt(nelementsArray.indexOf(draggedElement)); //true
  console.log("dragged Index IS");
  console.log(parseInt(draggedIndex));

  event.dataTransfer.setData("text", event.target.id);
  event.dataTransfer.setData('tagLevel', event.target.getAttribute('tag_level'));
    event.dataTransfer.setData('tagName', event.target.getAttribute('tag_name'));
    event.dataTransfer.setData('tagID', event.target.getAttribute('tag_ID'));
    event.dataTransfer.setData('draggedIndex', event.target.getAttribute('index'));

    // console.log(event.dataTransfer.setData('draggedIndex', event.target.getAttribute('nelementsArray.indexOf(draggedElement)')));
    // console.log("dragged Index IS");  
    const selectedElements = document.querySelectorAll(".selected");
    // Loop through each selected element and remove the "selected" class
    selectedElements.forEach(function (element) {
      element.classList.remove("selected");
    });

    
}
// ------------------------------drag over nelement-----------------------------
function allowDrop(event) {
  event.preventDefault();
}
// ------------------------------drop nelement-----------------------------
function drop(event) {
  // event.preventDefault();
  console.log("hi nelement on canvas");
  const targetElement = event.target;
  console.log("dragged Index IS");
  console.log (draggedIndex);

  // if (targetElement === draggedElement) {
  //   return;
  // }
  if (targetElement=== canvas) {
    console.log("you in canvas");  
  const targetIndex = nelementsArray.indexOf(targetElement);
  console.log ("targetIndex"); console.log (targetIndex);
    // const removedElement=nelementsArray.splice(draggedIndex, 1);
    // canvasElements.splice(targetIndex, 0, removedElement);
    // const draggedIndex = parseInt(draggedElement.getAttribute('data-index'));
    // const removedElement = canvasElements.splice(draggedIndex, 1)[0];
    // canvasElements.splice(targetIndex, 0, removedElement);
    // updateCanvas();
  } else {
    console.log("you not in canvas");
    targetElement.appendChild(draggedElement);


  var data = event.dataTransfer.getData("text");
  // event.target.appendChild(document.getElementById(data));
  const tagLevel = event.dataTransfer.getData('tagLevel');
  console.log("tagLevel IS");
  console.log(tagLevel);
  const tagName = event.dataTransfer.getData('tagName');
  console.log("tagName IS");
  console.log(tagName);
  const tagID = event.dataTransfer.getData('tagID');
  console.log("tagID IS");
  console.log(tagID);
 
  const nodElement = document.createElement(tagName);
  nodElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  nodElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style

  nodElement.onclick = selected(tagID);
  targetElement.setAttribute('draggable', 'true');
  nodElement.setAttribute('tag_name', tagName);
  nodElement.setAttribute('tag_iD', tagID);
  nodElement.setAttribute('tag_level', tagLevel);
  // draggable nelements ondrop=
  nodElement.setAttribute('ondrop','drop(event)');
  nodElement.setAttribute('ondragover','allowDrop(event)');
  nodElement.setAttribute('ondragstart','drag(event)');

  //newElement.ondrag(draged());
  //selected_tag.textContent = tagName; 

  // event.appendChild(nodElement); 
 }
}
// for edit content

var modal = document.getElementById("myModal");
var close = document.getElementById("close");
function handleDoubleClick (){
  let person = prompt("Please enter new element content", "new");
  modal.display = "block";
}
close.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});




