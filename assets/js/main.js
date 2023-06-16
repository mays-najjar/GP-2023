// Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');
// var selected_tag =document.getElementById('selected_tag');
let tempElementID = "";
let counter = 7;
let TRcount =2;
let initialPosition = null;
var myTags = [];// array to store data
var nelementsArray =[];
var trArray =[];
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


function initializeZoom() {
  var iframe = document.getElementById('preview');
  if (iframe) {
    iframe.contentDocument.body.style.zoom = '50%'; // Adjust the zoom level as desired
  }
}
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
    enableNestedSorting(); // Enable nested sorting after dropping nelements
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
 createImageModal(newElement);
} else if( tagName=="tr"){
  console.log("trrrrrrrrrrrrrrrr");
  newElement = document.createElement('tr');
  trArray.push(newElement)
  newElement.style.display='block';
  // newElement.style.height='10%';
  newElement.style.margin = '5%';
  newElement.style.borderCollapse = 'collapse';
  newElement.style.border = '3% solid #000';

}else if( tagName=="th"){
  newElement = document.createElement('th');
  
} else if( tagName=="table"){
  newElement = document.createElement('table');
   newElement.classList.add("table");
}
  else{ if(tagName!="th"){  newElement = document.createElement(tagName);}}
  

  newElement.className = 'nelement';                 //the DIV class IS (nelement),
  newElement.id =counter;
  id_value = tagName; //???????
  newElement.textContent = tagName;              //the DIV textContent property is set to the elementText value. 
  newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
  newElement.classList.add('selected');
  // newElement.classList.add('sortable');
  // newElement.onclick = () => element_properties(tagID, counter);
  newElement.onclick = () => selected(newElement);
  // newElement.onclick = selected(newElement);
  // newElement.onclick = selected(newElement);
  newElement.setAttribute('data-content', newElement.textContent)
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('contenteditable', 'true');
  newElement.setAttribute('onkeypress','saveContent(event)');

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

  if (tagName=="tr"){
    const tablee= document.querySelector('table');
    tablee.appendChild(newElement);
    console.log( "table",document.querySelector('table'));
    addToDatabase(counter,tagID,newElement.textContent,tablee.id,TRcount);
    TRcount=TRcount+1;
  }else if (tagID=='19'){
    const tablee= document.querySelector('table');
    const TR=trArray[0];
    console.log( "TR",TR);
    TR.appendChild(newElement);
    console.log( "table",document.querySelector('table'));
    addToDatabase(counter,tagID,newElement.textContent,TR.id,TRcount);
    TRcount=TRcount+1;
  }else if (tagName=="td"){
    const tablee= document.querySelector('table');
      const TR= tablee.querySelectorAll('tr');
    const lastRow = TR[TR.length - 1];
    lastRow.appendChild(newElement);
    console.log( "table",document.querySelector('table'));
    addToDatabase(counter,tagID,newElement.textContent,lastRow.id,TRcount);
    TRcount=TRcount+1;
  }else {
    if(tagName!="th"){
  canvas.appendChild(newElement);}
}
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

 

// // element_properties ajax
// element_properties(tagID);




  // call functions on canvasDrop function

  createElement();

  if(tagName!="tr"){
  addToDatabase(counter,tagID,newElement.textContent,5,order);}
 // element_properties ajax
  element_properties(tagID,counter); 
  element_style(counter);
  createElementAttribute(counter, tagID);
  createStyleElement(counter);
  displayProperties();
  $("#Properties").css("display", "block");
  //counter is set for auto-increment element_id
  refreshIframe();  //
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
function saveContent(event) {
  if (event.keyCode === 13) { // Check for Enter key
    event.preventDefault(); // Prevent the default behavior of Enter key

  element_id= event.target.id;  
  const content = document.querySelector(".selected").innerHTML;
  const data = {
    element_id: element_id,
    content: content
  };

  // Send AJAX request to the server
  var xhr = new XMLHttpRequest();
  xhr.open('PUT', 'http://localhost/GP-2023/api/element/updateContent.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onload = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        alert(response.message);
      } else {
        alert('Error updating element');
      }
    }
  };
  xhr.send(JSON.stringify(data));
  refreshIframe(); 
}

}

 var sortableInstance = false;
 var sort =false;

 nelement.removeAttribute('ondrop');
 nelement.removeAttribute('ondragover');
 function toggleSortable() {
  if (sortableInstance) {
    if (sort) {
      sortableInstance.option("disabled", true);
      sort = false;
      document.getElementById('sortButton').innerHTML = '<i class="fa-solid fa-sort" style="color: #2055b9;"></i> Enable sorting';
      console.log("sorting disabled");

      // Set contenteditable attribute to false for each nelement
      var nelements = document.querySelectorAll('.nelement');
      nelements.forEach(function (nelement) {
        nelement.setAttribute('contenteditable', 'true');
      });

      // Disable nested sorting for nelements
      var nestedSortables = document.querySelectorAll('.nelement .sortable');
      nestedSortables.forEach(function (sortable) {
        sortable.sortableInstance.option("disabled", true);
      });

      // Hide arrow icons
      var arrowUpIcons = document.querySelectorAll('.arrow-up');
      var arrowDownIcons = document.querySelectorAll('.arrow-down');
      arrowUpIcons.forEach(function (arrowUpIcon) {
        arrowUpIcon.style.display = 'none';
      });
      arrowDownIcons.forEach(function (arrowDownIcon) {
        arrowDownIcon.style.display = 'none';
      });
    } else {
      sortableInstance.option("disabled", false);
      sort = true;
      document.getElementById('sortButton').textContent = "Disable sorting";
      console.log("sorting enabled");

      // Remove contenteditable attribute from each nelement
      var nelements = document.querySelectorAll('.nelement');
      nelements.forEach(function (nelement) {
        nelement.removeAttribute('contenteditable');
      });

      // Enable nested sorting for nelements
      var nestedSortables = document.querySelectorAll('.nelement .sortable');
      nestedSortables.forEach(function (sortable) {
        sortable.sortableInstance.option("disabled", false);
      });

      // Show arrow icons
      var arrowUpIcons = document.querySelectorAll('.arrow-up');
      var arrowDownIcons = document.querySelectorAll('.arrow-down');
      arrowUpIcons.forEach(function (arrowUpIcon) {
        arrowUpIcon.style.display = 'block';
      });
      arrowDownIcons.forEach(function (arrowDownIcon) {
        arrowDownIcon.style.display = 'block';
      });
    }
  } else {
    sortableInstance = Sortable.create(document.querySelector('.sortable'), {
      animation: 1
    });
    sortableInstance.option("disabled", false);
    sort = true;
    document.getElementById('sortButton').textContent = "Disable sorting";
    console.log("sorting enabled");

    // Remove contenteditable attribute from each nelement
    var nelements = document.querySelectorAll('.nelement');
    nelements.forEach(function (nelement) {
      nelement.removeAttribute('contenteditable');
    });

    // Enable nested sorting for nelements
    var nestedSortables = document.querySelectorAll('.nelement .sortable');
    nestedSortables.forEach(function (sortable) {
      sortable.sortableInstance.option("disabled", false);
    });

    // Show arrow icons
    var arrowUpIcons = document.querySelectorAll('.arrow-up');
    var arrowDownIcons = document.querySelectorAll('.arrow-down');
    arrowUpIcons.forEach(function (arrowUpIcon) {
      arrowUpIcon.style.display = 'block';
    });
    arrowDownIcons.forEach(function (arrowDownIcon) {
      arrowDownIcon.style.display = 'block';
    });
  }
}


// Function to enable sorting within nested nelements
function enableNestedSorting() {
  nelementsArray.forEach(nelement => {
    const sortableInstance = Sortable.create(nelement, {
      group: 'nested',
      animation: 1500,
      handle: '.nelement',
      draggable: '.nelement',
      ghostClass: 'sortable-ghost',
      onUpdate: function (evt) {
        const item = evt.item;
        const newIndex = Array.from(item.parentNode.children).indexOf(item);
        const elementId = item.id;
        // Update the order or perform any other necessary actions
      }
    });
  });
}

// Function to update the parent of an element on the server side
function updateParent(elementID, parentID) {
  // Create a new XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/GP-2023/api/element/updateParentId.php', true);

  // Set the request headers
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Set the onload callback function
  xhr.onload = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        alert(response.message);
      } else {
        alert('Error updating parent');
      }
    }
  };

  // Create the request body as a JSON string
  var requestBody = JSON.stringify({ element_id: elementID, parent_id: parentID });

  // Send the request with the JSON body
  xhr.send(requestBody);
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
    // console.log(xxhr.responseText);
    document.getElementById("element_properties").innerHTML = xxhr.responseText;
   }
 };
 
xxhr.open("POST", "test.php", true);
xxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
const datta = "tag_ID=" + encodeURIComponent(tag_ID) + "&element_ID=" + encodeURIComponent(element_ID);
xxhr.send(datta);
}

function element_style(elementID) {
  const xxhr = new XMLHttpRequest();
  var element_ID = elementID;
  xxhr.onreadystatechange = function() {
     if (xxhr.readyState == 4 && xxhr.status == 200) {
      console.log(" element_ID");
      // console.log(xxhr.responseText);
      document.getElementById("style").innerHTML = xxhr.responseText;
     }
   };
   
  xxhr.open("POST", "style.php", true);
  xxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const datta =  "element_ID=" + encodeURIComponent(element_ID);
  xxhr.send(datta);
  }
//selected function for nelement

function selected(tag) {
  console.log(tag);
  console.log("element id", tag.id);
  var tagg_ID = tag.getAttribute("tag_id");
  var eelementID = tag.id;
  console.log("tag id", tagg_ID);

  // element_properties ajax
  // element_properties(tagg_ID, eelementID);

  // Remove existing click event handlers
  $('#canvas').off('click', '.nelement');

  // Attach click event handler directly to the parent element (#canvas)
  $('#canvas').on('click', '.nelement', function (event) {
    event.stopPropagation(); // Stop event propagation to prevent selecting the parent element

    // Retrieve the relevant information from the clicked nelement
    
    var clickedElementId = $(this).attr('element_id');
    var clickedElement =document.getElementById(clickedElementId);
    var clicked_TagID = clickedElement.getAttribute("tag_id");

    console.log("Clicked elament :", clickedElement);
    console.log("Clicked tag name:", clickedElement.tagName);
    console.log("Clicked element ID:", clickedElementId);
    console.log("Clicked tag ID:",clicked_TagID);
    
    element_properties(clicked_TagID,clickedElementId);
    element_style(clickedElementId);

    // Deselect all the elements
    $(".nelement").removeClass('selected');

    // Select the clicked element
    $(this).addClass('selected');
    $(this).parent().removeClass('selected');
    $(this).parent().addClass('sortable');

    console.log("parentID is:");
    console.log($(this).parent());
    console.log("parent tagName is:");
    console.log($(this).parent().prop('tagName'));
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
    // console.log(response.message);
  }
};
xhr.send(JSON.stringify(data));

}

function createElement() {
  const elements = document.getElementsByClassName('nelement');
  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    const arrowUp = document.createElement('div');
    arrowUp.className = 'arrow-up';
    arrowUp.onclick = () => {
      changeElementOrder(i, i - 1);
      console.log("oooooooooooooorrrrrrrrrrder", $(elements[i]).parent().attr('id'));
      if ($(elements[i]).parent().attr('id') == "canvas") {
        updateChildElementOrders("canvas");
      } else {
        updateChildElementOrders(elements[i].parent().attr('id'));
      }
    };
    element.appendChild(arrowUp);

    const arrowDown = document.createElement('div');
    arrowDown.className = 'arrow-down';
    arrowDown.onclick = () => {
      changeElementOrder(i, i + 1);
      if ($(elements[i]).parent().attr('id') == "canvas") {
        updateChildElementOrders("canvas");
      } else {
        updateChildElementOrders(elements[i].parent().attr('id'));
      }
    };
    element.appendChild(arrowDown);
  }

  // Hide arrow icons initially if sorting is disabled
  if (!sort) {
    var arrowUpIcons = document.querySelectorAll('.arrow-up');
    var arrowDownIcons = document.querySelectorAll('.arrow-down');
    arrowUpIcons.forEach(function (arrowUpIcon) {
      arrowUpIcon.style.display = 'none';
    });
    arrowDownIcons.forEach(function (arrowDownIcon) {
      arrowDownIcon.style.display = 'none';
    });
  }
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
      console.log("createElementAttribute");
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
    //  console.log(response.message);
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
  
  
 
  // if (targetElement === draggedElement) {
  //   return;
  // }
  if (oldParentID==newParentID) {
    console.log("you already in in this parent "); 
    console.log("order must changed"); 

    if (targetElement==canvas){
      updateChildElementOrders("canvas");
    } else{
    updateChildElementOrders(newParentID);
  }
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
    
    if (targetElement==canvas){
    updateParent(draggedElementId,5);
  } else{
  updateParent(draggedElementId,newParentID);}
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

  // nodElement.onclick = selected(tagID);
  
  // nodElement.onclick = () => element_properties(tagID, nodElement.id);
  nodElement.onclick = () => selected(nodElement);
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
    //  iframe.contentDocument.body.style.zoom = '50%';

    // call the Function to update the order 
    //  updateOrder(canvas);
    
  var CodeIframe = document.getElementById("codeIframe");
  // Reload the iframe content
  CodeIframe.contentWindow.location.reload();
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



function updateChildElementOrders(parentId) {
  const parentElement = document.getElementById(parentId);
  console.log(parentId);
  console.log(parentElement);
  const childElements = parentElement.querySelectorAll('.nelement');
  const sortedChildElements = Array.from(childElements).sort((a, b) => {
    const aRect = a.getBoundingClientRect();
    const bRect = b.getBoundingClientRect();
    return aRect.top - bRect.top;
  });

  sortedChildElements.forEach((child, index) => {
    child.style.order = index + 1;
    const elementId = child.getAttribute('element_id'); // Assuming element_id is an attribute of the child element

    // Send updated order value to the API
    const requestData = {
      element_id: elementId,
      children_order: index + 1
    };

    // Use the appropriate URL for your API endpoint
    const apiUrl = 'http://localhost/GP-2023/api/element/updateOrder.php';

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
  });
  refreshIframe();
}

function saveData(element_id) {
  var select1Value = document.getElementById("inputGroupSelect01").value;
  var select2Value = document.getElementById("inputGroupSelect02").value;
  var select3Value = document.getElementById("inputGroupSelect03").value;
  var select4Value = document.getElementById("inputGroupSelect04").value;
  var select5Value = document.getElementById("inputGroupSelect05").value;
  var select6Value = document.getElementById("inputGroupSelect06").value;
  var select7Value = document.getElementById("inputGroupSelect07").value;
  var select8Value = document.getElementById("inputGroupSelect08").value;
  var select9Value = document.getElementById("inputGroupSelect09").value;
  var select10Value = document.getElementById("inputGroupSelect10").value;
  var select11Value = document.getElementById("inputGroupSelect11").value;
  var select12Value = document.getElementById("inputGroupSelect12").value;
  var select13Value = document.getElementById("inputGroupSelect13").value;
  var select14Value = document.getElementById("inputGroupSelect14").value;
  var select15Value = document.getElementById("inputGroupSelect15").value;
  var select16Value = document.getElementById("inputGroupSelect16").value;
  var select17Value = document.getElementById("inputGroupSelect17").value;

    var data = {
      element_id: element_id,
      styleValues: select1Value + ", " + select4Value + "px " + select3Value + "  " + select2Value + ", " + select5Value + ", " +  select8Value + "% " + select7Value + "% "+ select9Value + "% "+select6Value +  "% " + ", " + select12Value + "% "+ select11Value + "% " + select13Value + "% "+ select10Value + "% " + ", "+ select14Value + ", "+ select15Value + ", "+ select16Value + "%" + ", " + select17Value + "% "
  };

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
  refreshIframe();

}


function createImageModal(newElement) {
  var modal = document.createElement('div');
  modal.className = 'modal';
  modal.innerHTML = `
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="imageUploadForm" enctype="multipart/form-data">
        <input type="file" id="imageFileInput">
        <input type="number" name="height" placeholder="Height">
        <input type="number" name="width" placeholder="Width">
        <input type="submit" value="Upload">
      </form>
    </div>
  `;

  document.body.appendChild(modal);

  var closeButton = modal.querySelector('.close');
  var imageFileInput = modal.querySelector('#imageFileInput');

  closeButton.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  var imageUploadForm = modal.querySelector('#imageUploadForm');
  imageUploadForm.addEventListener('submit', function(event) {
    event.preventDefault();

    var file = imageFileInput.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function(event) {
        var src = event.target.result;
        newElement.src = src;

        var heightInput = modal.querySelector('input[name="height"]');
        var widthInput = modal.querySelector('input[name="width"]');

        if (heightInput.value) {
          newElement.style.height = heightInput.value + 'px';
        }

        if (widthInput.value) {
          newElement.style.width = widthInput.value + 'px';
        }

        modal.style.display = 'none';
      };

      reader.readAsDataURL(file);
    }
  });

  modal.style.display = 'block';
}


// // Refresh the iframe every 5 seconds (adjust the interval as needed)
// setInterval(refreshIframe, 5000);



function displayOnCanvas(newElement,tagName,tagID){
  newElement.className = 'nelement';                 //the DIV class IS (nelement),
  newElement.id =counter;
  id_value = tagName; //???????
  newElement.textContent = tagName;              //the DIV textContent property is set to the elementText value. 
  newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
  newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
  newElement.classList.add('selected');
  newElement.onclick = () => selected(newElement);
  newElement.setAttribute('data-content', newElement.textContent)
  newElement.setAttribute('draggable', 'true');
  newElement.setAttribute('contenteditable', 'true');
  newElement.setAttribute('onkeypress','saveContent(event)');

  newElement.setAttribute('tag_name', tagName);
  newElement.setAttribute('tag_iD', tagID);
  newElement.setAttribute('element_iD', counter);
  newElement.setAttribute('tag_level', 4);
  if(tagName!="img"){
    // console.log("you can drop on it , not image");
    newElement.setAttribute('ondrop','canvasdrop(event)');
  newElement.setAttribute('ondragover','allowDrop(event)');
  }
  newElement.setAttribute('ondragstart','drag(event)');

  newElement.setAttribute("data-toggle", "tooltip");
  newElement.setAttribute("title", "double click to edit content");
  canvas.appendChild(newElement);

nelementsArray.push(newElement);
console.log(nelementsArray);
const index=nelementsArray.indexOf(newElement);
console.log("index IS");
console.log(index);

const targetElement = event.target;
  const targetIndex = parseInt(targetElement.getAttribute('index'));
  console.log(targetIndex);
  newElement.setAttribute('index',index);
var order =index+1;
  const propertiesBlock = document.getElementById('element_properties');
  

  createElement();

  addToDatabase(counter,tagID,newElement.textContent,5,order);
 // element_properties ajax
  element_properties(tagID,counter); 
  element_style(counter);
  createElementAttribute(counter, tagID);
  createStyleElement(counter);
  

  //counter is set for auto-increment element_id
  refreshIframe();  //
}

// 
// Add event listener for delete element button
const deleteButton = document.getElementById('delete-element');
// deleteButton.addEventListener('click', deleteElement);

function deleteElement() {
  // Get the selected element
  const selectedElement = document.querySelector('.selected');
  
  if (selectedElement) {
    // Remove the selected element from the canvas
    selectedElement.remove();

    // Delete the element from the database using AJAX
    const elementId = selectedElement.id;
    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', 'http://localhost/GP-2023/api/element/delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          alert(response.message);
        } else {
          alert('Error deleting element');
        }
      }
    };
    xhr.send(JSON.stringify({ element_id: elementId }));

    // Clear the element properties block
    const propertiesBlock = document.getElementById('element_properties');
    propertiesBlock.innerHTML = '';

    // Deselect the deleted element
    selectedElement.classList.remove('selected');
  } else {
    alert('No element selected');
  }
  refreshIframe();
}

function displayProperties(){
  $("#Properties").css("display", "inline-block");
}

// Get all elements with the class "nelement"
const nnelements = document.getElementsByClassName('nelement');

// Iterate over each element
for (let i = 0; i < elements.length; i++) {
  const element = nnelements[i];

  // Get the arrow-up and arrow-down elements within the current nelement
  const arrowUp = element.querySelector('.arrow-up');
  const arrowDown = element.querySelector('.arrow-down');

  // Attach click event listeners to the arrow icons
  arrowUp.addEventListener('click', () => {
    const nelementParentID = element.parent().attr('id');
    updateChildElementOrders(nelementParentID);
  });

  arrowDown.addEventListener('click', () => {
    const nelementParentID = element.parent().attr('id');
    updateChildElementOrders(nelementParentID);
  });
}

function updateElementAttributes() {
  var form = document.querySelector('.form-group');
  var inputs = form.getElementsByTagName('input');
  var attributeValues = [];

  for (var i = 0; i < inputs.length; i++) {
    var value = inputs[i].value;
    attributeValues.push(value);
  }

  var data = {
    element_id: 13,
    tag_id: 9,
    attribute_values: attributeValues.join(', ')
  };

  var xhr = new XMLHttpRequest();
  xhr.open('PUT', 'http://localhost/GP-2023/api/ElementAttribute/update.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 400) {
      var response = JSON.parse(xhr.responseText);
      console.log(response.message);
    }
  };

  xhr.send(JSON.stringify(data));
}

document.getElementById("selectBody").onclick = () => "selected(canvas)";
