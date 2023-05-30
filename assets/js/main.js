// Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');
// var selected_tag =document.getElementById('selected_tag');
let tempElementID = "";
let counter = 7;
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
    draggedElement = event.target; 
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
    let newElement;
    if(tagName=="img"){
 newElement = document.createElement('img');
 document.getElementById('imgModal').style.display='block';
}
  else{   newElement = document.createElement(tagName);}
  

  newElement.className = 'nelement';                 //the DIV class IS (nelement),
  newElement.id =counter;
  id_value = tagName; //???????
  newElement.textContent = tagName;              //the DIV textContent property is set to the elementText value. 
  newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
  newElement.classList.add('selected');
  newElement.onclick = selected(newElement);
  newElement.setAttribute('data-content', newElement.textContent)
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('tag_name', tagName);
  newElement.setAttribute('tag_iD', tagID);
  newElement.setAttribute('element_iD', counter);
  newElement.setAttribute('tag_level', tagLevel);
  // draggable nelements ondrop=
  if(tagName!="img"){
    // console.log("you can drop on it , not image");
    newElement.setAttribute('ondrop','canvasdrop(event)');
  newElement.setAttribute('ondragover','allowDrop(event)');
  }
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
var order =index+1;
  // $(".nelement").removeClass('selected');


  // updateProperties(newElement.id);
  // show the properties block and set its values based on the dropped element
  const propertiesBlock = document.getElementById('element_properties');
  //propertiesBlock.style.display = 'block';

  //  tempElementID =tagName;
  //  console.log("Temporary element ID:", tempElementID);
  //  id_value=newElement.id ;

  //------------------------------------

  // Remove the dragged element from its original position
  // if (draggedElement) {
  //   draggedElement.remove();
  // }



  //--------------------------------
  // post ajax

  // Send an AJAX request to create the element on the server

  const xhr = new XMLHttpRequest();
  const url = 'http://localhost/GP-2023/api/element/create.php';
  const data = {
    "tag_id": tagID,
    "content": newElement.textContent,
    "parent_id": "5",
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




  // call functions on canvasDrop function

  createElement();

  addToDatabase(counter,tagID,newElement.textContent,5,order);
 // element_properties ajax
  element_properties(tagID,counter); 
  createElementAttribute(counter, tagID);
  createStyleElement(counter);
  
  //counter is set for auto-increment element_id
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

 var sortableInstance = null;
 var sort =true;


function toggleSortable() {
  if (sortableInstance ) { 
    if (sort==true) {sortableInstance.option("disabled", true);
    sort =false;
    document.getElementById('sortButton').textContent = "Enable sorting";
    console.log("sorting disable");
  } else {
    sortableInstance = Sortable.create(document.querySelector('.sortable'), {
      animation: 1
    });   
    console.log("sorting enable");
    sort=true;
    document.getElementById('sortButton').textContent = "Disable sorting";
  }
  } else {
    sortableInstance = Sortable.create(document.querySelector('.sortable'), {
      animation: 1
    });   console.log("sorting enable"); sort=true;
    document.getElementById('sortButton').textContent = "Disable sorting";
  }
}



var demo = document.getElementById("demo");
// 

function element_properties(tagID,elementID) {
const xxhr = new XMLHttpRequest();
var tag_ID = tagID;
var element_ID = elementID;
xxhr.onreadystatechange = function() {
   if (xxhr.readyState == 4 && xxhr.status == 200) {
    console.log(" tag_ID & element_ID");
    console.log(xxhr.responseText);
    document.getElementById("element_properties").innerHTML = xxhr.responseText;
   }
 };
 
xxhr.open("POST", "test.php", true);
xxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
const datta = "tag_ID=" + encodeURIComponent(tag_ID) + "&element_ID=" + encodeURIComponent(element_ID);
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
      console.log("parentID is:");
      console.log($(this).parent());
      console.log("parent tagName is:");
      console.log($(this).parent().prop('tagName'));
        //  console.log(tagID);
   var tag_ID = tag.getAttribute("tag_id");
   console.log(tag_ID);
     // element_properties ajax
     element_properties(tag_ID,8);
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


function addToDatabase(element_id,tag_id,content,parent_id,children_order){
 // Send an AJAX request to create the element on the server

 const xhr = new XMLHttpRequest();
const url = 'http://localhost/GP-2023/api/element/create.php';
let data = {
  "element_id": element_id,
  "tag_id": tag_id,
  "content": content,
  "parent_id": parent_id,
  "children_order": children_order
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

}

function createElement() {
  // const elements = document.getElementsByClassName('nelement');
  // for (let i = 0; i < elements.length; i++) {
  //   const element = elements[i];
  //   const arrowUp = document.createElement('div');
  //   arrowUp.className = 'arrow-up';
  //   arrowUp.onclick = () => {
  //     changeElementOrder(i, i - 1);
  //   };
  //   element.appendChild(arrowUp);

  //   const arrowDown = document.createElement('div');
  //   arrowDown.className = 'arrow-down';
  //   arrowDown.onclick = () => {
  //     changeElementOrder(i, i + 1);
  //   };
  //   element.appendChild(arrowDown);
  // }
}
function createElementAttribute(element_id, tag_id) {
  // Construct the URL for create.php
  const xhr = new XMLHttpRequest();
const url = 'http://localhost/GP-2023/api/ElementAttribute/create.php';
const data = {
  "element_id": element_id,
  "tag_id": tag_id
};

xhr.open('POST', url, true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4) {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response.message);
    } else {
      console.log('Error:', xhr.status);
    }
  }
};

xhr.send(JSON.stringify(data));

  
}

function createStyleElement(element_id) {
  // Construct the URL for create.php
  const xhr = new XMLHttpRequest();
const url = 'http://localhost/GP-2023/api/StyleElement/create.php';
const data = {
  "element_id": element_id,
};

xhr.open('POST', url, true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4) {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response.message);
    } else {
      console.log('Error:', xhr.status);
    }
  }
};

xhr.send(JSON.stringify(data));

  
}

function changeElementOrder(fromIndex, toIndex) {
  if (toIndex < 0 || toIndex >= nelementsArray.length) {
    return;
  }
  
  const [element] = nelementsArray.splice(fromIndex, 1);
  nelementsArray.splice(toIndex, 0, element);

  // Update the index attribute of elements in nelementsArray
  nelementsArray.forEach((el, index) => {
    el.setAttribute('index', index);
  });

  // Rearrange elements on the canvas
  canvas.innerHTML = '';
  nelementsArray.forEach((el) => {
    canvas.appendChild(el);
  });
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
  console.log("dragged id IS");
  console.log(event.target.id);
  event.dataTransfer.setData("id", event.target.id);
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


function addToDatabase(element_id,tag_id,content,parent_id,children_order){
  // Send an AJAX request to create the element on the server
 
  const xhr = new XMLHttpRequest();
 const url = 'http://localhost/GP-2023/api/element/create.php';
 let data = {
   "element_id": element_id,
   "tag_id": tag_id,
   "content": content,
   "parent_id": parent_id,
   "children_order": children_order
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
  console.log("targetElement:",targetElement);
  console.log("targetElement id:",targetElement.id);
  console.log("dragged Index IS");
  console.log (draggedIndex);

  var draggedElementId = draggedElement.id;
  var oldParentID = $('#' + draggedElementId).parent().attr('id');
  console.log("old parent ID of dragged element");
  console.log(oldParentID);

  var droppedElementId = targetElement.id;
  var newParentID = targetElement.id;
  console.log("new parent Element ID");
  console.log(newParentID);
  
  updateChildElementOrders(newParentID);
  // if (targetElement === draggedElement) {
  //   return;
  // }
  if (oldParentID==newParentID) {
    console.log("you already in in this parent "); 
    console.log("order must changed"); 

  const targetIndex = nelementsArray.indexOf(targetElement);
  console.log ("targetIndex"); console.log (targetIndex);
  //   // var parentElement = event.target.parentNode;
  // var droppedElementId = event.dataTransfer.getData("id");
  // var parentElementID = $('#' + droppedElementId).parent().id;
  // console.log("parent Element ID");
  // console.log(parentElementID);

  
    // const removedElement=nelementsArray.splice(draggedIndex, 1);
    // canvasElements.splice(targetIndex, 0, removedElement);
    // const draggedIndex = parseInt(draggedElement.getAttribute('data-index'));
    // const removedElement = canvasElements.splice(draggedIndex, 1)[0];
    // canvasElements.splice(targetIndex, 0, removedElement);
    // updateCanvas();
  } else {
    console.log("you not in canvas");
    targetElement.appendChild(draggedElement);
 
  //   var droppedElementId = event.dataTransfer.getData("id");
  // var parentElementID = targetElement.id;
  // console.log("Parent Element ID:", parentElementID);
  
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
  nodElement.id== event.dataTransfer.getData("id");
  nodElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  nodElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style

  nodElement.onclick = selected(tagID);
  targetElement.setAttribute('draggable', 'true');
  nodElement.setAttribute('tag_name', tagName);
  nodElement.setAttribute('tag_iD', tagID);
  nodElement.setAttribute('tag_level', tagLevel);
  // draggable nelements ondrop=
  if(tagName!="img"){
    // console.log("you can drop on it , not image");
  nodElement.setAttribute('ondrop','drop(event)');
  nodElement.setAttribute('ondragover','allowDrop(event)');
  }

  nodElement.setAttribute('ondragstart','drag(event)');

  //newElement.ondrag(draged());
  //selected_tag.textContent = tagName; 

  // targetElement.appendChild(nodElement); 
  // addToDatabase(targetElement);
 }
}
// ;

// refresh iframe
function refreshIframe() {
  var iframe = document.getElementById("preview");
     // Reload the iframe content
     iframe.contentWindow.location.reload();
     // call the Function to update the order 
    //  updateOrder(canvas);
}
function updateOrder(parentElement) {
  const childElements = parentElement.querySelectorAll('.nelement');
  const sortedChildElements = Array.from(childElements).sort((a, b) => {
    const aRect = a.getBoundingClientRect();
    const bRect = b.getBoundingClientRect();
    return aRect.top - bRect.top;
  });

  sortedChildElements.forEach((child, index) => {
    child.style.order = 6;
    const elementId = child.getAttribute('element_id'); // Assuming element_id is an attribute of the child element
    const previousContent = child.getAttribute('content'); // Assuming content is an attribute of the child element
    const parentElementId = child.getAttribute('parent_id'); // Assuming parent_id is an attribute of the child element

    // Send updated order value to the API
    const requestData = {
      element_id: elementId,
      tag_id: child.getAttribute('tag_id'), // Assuming tag_id is an attribute of the child element
      content: previousContent,
      parent_id: parentElementId,
      children_order: index + 1
    };

    // Use the appropriate URL for your API endpoint
    const apiUrl = 'http://localhost/GP-2023/api/element/update.php';

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    xhr.open('PUT', apiUrl);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        console.log(response.message);
      } else {
        // Handle errors if any
      }
    };

    xhr.onerror = function() {
      // Handle errors if any
    };

    xhr.send(JSON.stringify(requestData));

    updateOrder(child);
  });
}




function updateChildElementOrders(parentElementId) {
  // Get the parent element
  var parentElement = document.getElementById(parentElementId);
  
  // Get the direct children elements
  var childrenElements = parentElement.children;

  // Sort the children elements based on their vertical position
  var sortedElements = Array.from(childrenElements).sort(function(a, b) {
    var aTop = a.getBoundingClientRect().top;
    var bTop = b.getBoundingClientRect().top;
    return aTop - bTop;
  });
  
  // Prepare the data to be sent
  var requestData = {
    element_id: parentElementId,
    children_order: []
  };
  
  // Generate the updated order of children
  sortedElements.forEach(function(child, index) {
    requestData.children_order.push({
      child_id: child.id,
      order: index + 1
    });
  });

  // Make the AJAX call to update the orders
  $.ajax({
    url: 'http://localhost/GP-2023/api/element/update.php',
    type: 'PUT',
    dataType: 'json',
    data: JSON.stringify(requestData),
    success: function(response) {
      console.log(response.message);
      // Perform any additional actions upon successful update
    },
    error: function(xhr, status, error) {
      console.error('Failed to update element order:', error);
    }
  });
}

function saveData() {
  var select1Value = document.getElementById("inputGroupSelect01").value;
  var select2Value = document.getElementById("inputGroupSelect02").value;
  var select3Value = document.getElementById("inputGroupSelect03").value;
  var select4Value = document.getElementById("inputGroupSelect04").value;
  var select5Value = document.getElementById("inputGroupSelect05").value;
  var select6Value = document.getElementById("inputGroupSelect06").value;
  var select7Value = document.getElementById("inputGroupSelect07").value;

  var data = {
    element_id: counter,
    styleValues: select1Value + ", " + select2Value + ", " + select3Value + ", " + select4Value + ", " + select5Value + ", " + select6Value + ", " + select7Value
  };
console.log('Hellooooooooooooo');
  var xhr = new XMLHttpRequest();
  var url = "http://localhost/GP-2023/api/StyleElement/update.php";
  xhr.open("PUT", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        // Handle the response here
      } else {
        var error = JSON.parse(xhr.responseText);
        console.log("Error:", error);
      }
    }
  };
  xhr.send(JSON.stringify(data));
}




// // Refresh the iframe every 5 seconds (adjust the interval as needed)
// setInterval(refreshIframe, 5000);



// ///////////////////////
// const updateElementOrder = (parentElement) => {
//   const childElements = Array.from(parentElement.children).filter(element => element.classList.contains('nelement'));
//   childElements.forEach((element, index) => {
//     element.style.order = index + 1;
//   });
// };

// updateElementOrder(canvas);
// // Function to update the order of each nelement
// function updateElementOrder(parentElement) {
//   const childElements = Array.from(parentElement.children).filter(element => element.classList.contains('nelement'));
//   childElements.forEach((element, index) => {
//     element.style.order = index + 1;
//   });
// }

// // on drop fun
// updateElementOrder(canvas);

// // Add event listener for selecting an element
// newElement.addEventListener('click', function (event) {
//   event.stopPropagation();
//   const selectedElements = document.querySelectorAll(".selected");
//   selectedElements.forEach(function (element) {
//     element.classList.remove("selected");
//   });
//   newElement.classList.add('selected');
// });

// const deleteButton = document.createElement('button');
// deleteButton.className = 'delete-button';
// deleteButton.textContent = 'Delete';
// deleteButton.addEventListener('click', function (event) {
//   event.stopPropagation();
//   canvas.removeChild(newElement);
//   const index = nelementsArray.indexOf(newElement);
//   if (index > -1) {
//     nelementsArray.splice(index, 1);
//   }
//   updateElementOrder(canvas);
// });

// newElement.appendChild(deleteButton);
// }
