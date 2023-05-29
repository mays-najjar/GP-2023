
   interact('.element')
   .draggable({
     onstart: function(event) {
       var target = event.target;
       target.classList.add('dragging');
     },
     onmove: function(event) {
       var target = event.target;
       var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
       var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
 
       target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
       target.setAttribute('data-x', x);
       target.setAttribute('data-y', y);
     },
     onend: function(event) {
       var target = event.target;
       target.classList.remove('dragging');
     }
   });
 
 interact('#canvas')
   .dropzone({
     accept: '.element',
     ondrop: function(event) {
       var draggableElement = event.relatedTarget;
       var canvas = event.target;
 
       canvas.appendChild(draggableElement);
     }
   });
   //    alert("Hello! I am an alert box!!");
    // // //    import interact from 'https://cdn.interactjs.io/v1.10.17/interactjs/index.js'
    // //         const canvas = document.getElementById('canvas');
    // //         const context = canvas.getContext('2d');
    // //         alert("hi");
   
    // document.addEventListener('DOMContentLoaded', function () {
    //     // Get the toolbar and canvas elements
    //     const toolbar = document.querySelector('.toolbar');
    //     const canvas = document.querySelector('.canvas');
  
    //     // Make the toolbar elements draggable
    //     interact('.element')
    //       .draggable({
    //         onstart: function (event) {
    //           const target = event.target;
    //           const tag = target.getAttribute('data-tag');
    //           const clonedElement = target.cloneNode(true);
  
    //           // Add a class to the cloned element for styling
    //           clonedElement.classList.add('dragged-element');
  
    //           // Set the data being dragged
    //           event.interaction.dataTransfer.setData('text/plain', tag);
  
    //           // Append the cloned element to the body
    //           document.body.appendChild(clonedElement);
  
    //           // Set the dragged element as the target
    //           event.interaction.target = clonedElement;
    //         },
    //         onmove: function (event) {
    //           const target = event.target;
    //           const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
    //           const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
  
    //           // Translate the element
    //           target.style.transform = `translate(${x}px, ${y}px)`;
  
    //           // Update the element's position data
    //           target.setAttribute('data-x', x);
    //           target.setAttribute('data-y', y);
    //         },
    //         onend: function (event) {
    //           const target = event.target;
    //           target.remove();
    //         }
    //       });
  
    //     // Make the canvas a dropzone
    //     interact(canvas)
    //       .dropzone({
    //         ondrop: function (event) {
    //           const canvasRect = canvas.getBoundingClientRect();
    //           const tag = event.relatedTarget.getData('text/plain');
    //           const x = event.clientX - canvasRect.left;
    //           const y = event.clientY - canvasRect.top;
  
    //           // Create a new element based on the dropped tag
    //           const element = document.createElement(tag);
    //           element.textContent = tag;
    //           element.classList.add('dropped-element');
    //           element.style.left = `${x}px`;
    //           element.style.top = `${y}px`;
  
    //           // Append the element to the canvas
    //           canvas.appendChild(element);
    //         }
    //       });
    //   });








    // modified 

    // Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');
let tempElementID = "";
let counter = 0;
let initialPosition = null;
let myTags = [];
let nelementsArray = [];
let tempElementName = "";
let draggedElement;
let draggedIndex = 0;
let hasNelementClass = 0;

// Add event listener for dragging elements from toolbar
document.querySelectorAll('.element').forEach(element => {
  element.addEventListener('dragstart', (event) => {
    const droppedElement = event.target;
    hasNelementClass = 0;
    event.dataTransfer.setData('text/plain', event.target.textContent);
    event.dataTransfer.setData('tagLevel', event.target.getAttribute('tag_level'));
    event.dataTransfer.setData('tagName', event.target.getAttribute('tag_name'));
    event.dataTransfer.setData('tagID', event.target.getAttribute('tag_ID'));
    event.dataTransfer.setData('droppedElement', event.target);
    const selectedElements = document.querySelectorAll(".selected");
    selectedElements.forEach(function (element) {
      element.classList.remove("selected");
    });
    tempElementID = "";
  });

  element.addEventListener("dragend", function (event) {
    const draggedElementID = element.id;
    tempElementID = draggedElementID;
  });
});

// Add event listener for dropping elements onto canvas
canvas.addEventListener('dragover', (event) => {
  event.preventDefault();
  event.dataTransfer.dropEffect = 'copy';
});

function canvasDrop(event) {
  event.preventDefault();
  if (hasNelementClass === 1) {
    drop(event);
  } else {
    const tagLevel = event.dataTransfer.getData('tagLevel');
    const tagName = event.dataTransfer.getData('tagName');
    const tagID = event.dataTransfer.getData('tagID');

    // Create the new element
    const newElement = document.createElement(tagName);
    newElement.className = 'nelement';
    newElement.id = tagName + '_' + counter;
    newElement.textContent = tagName;
    // newElement.style.left = event.clientX + 'px';
    // newElement.style.top = event.clientY + 'px';
    newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
   newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
    //  
    newElement.classList.add('selected');
    newElement.onclick = selected(newElement);
    newElement.ondblclick = handleDoubleClick;
    newElement.setAttribute('data-content', newElement.textContent)
    newElement.setAttribute('draggable', 'true');
    newElement.setAttribute('tag_name', tagName);
    newElement.setAttribute('tag_iD', tagID);
    newElement.setAttribute('tag_level', tagLevel);
    newElement.setAttribute('ondrop', 'drop(event)');
    newElement.setAttribute('ondragover', 'allowDrop(event)');
    newElement.setAttribute('ondragstart', 'drag(event)');
    newElement.setAttribute("data-toggle", "tooltip");
    newElement.setAttribute("title", "double click to edit content");

    canvas.appendChild(newElement);
    nelementsArray.push(newElement);

    const targetElement = event.target;
    const index = nelementsArray.indexOf(newElement);
    newElement.setAttribute('index', index);

    const xhhr = new XMLHttpRequest();
    xhhr.onreadystatechange = function () {
      if (xhhr.readyState == 4 && xhhr.status == 200) {
        document.getElementById("element_properties").innerHTML = xhhr.responseText;
      }
    };

    xhhr.open("POST", "test.php", true);
    xhhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhhr.send("tagID=1&itemID=2");

    const xhr = new XMLHttpRequest();
    const url = 'http://localhost/GP-2023/js/sortable_php.php';
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
      }
    };

    const data = JSON.stringify(nelementsArray);
    xhr.send(data);

    counter++;
  }
}

// Allow dropping on canvas
function allowDrop(event) {
  event.preventDefault();
}

// Drag element from canvas
function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
  draggedElement = event.target;
  draggedIndex = nelementsArray.findIndex(element => element.id === draggedElement.id);
  initialPosition = {
    x: event.clientX - draggedElement.style.left.split('px')[0],
    y: event.clientY - draggedElement.style.top.split('px')[0]
  };
}

// Drop element on canvas
function drop(event) {
  event.preventDefault();
  const elementID = event.dataTransfer.getData("text");
  const element = document.getElementById(elementID);
  if (event.target.id === 'canvas') {
    element.style.left = (event.clientX - initialPosition.x) + 'px';
    element.style.top = (event.clientY - initialPosition.y) + 'px';
  } else {
    const targetElement = event.target;
    element.style.left = (targetElement.offsetLeft + event.offsetX - initialPosition.x) + 'px';
    element.style.top = (targetElement.offsetTop + event.offsetY - initialPosition.y) + 'px';
  }
}

// Select an element on canvas
function selected(element) {
  return function () {
    if (element.classList.contains("selected")) {
      element.classList.remove("selected");
    } else {
      const selectedElements = document.querySelectorAll(".selected");
      selectedElements.forEach(function (element) {
        element.classList.remove("selected");
      });
      element.classList.add("selected");
    }
  };
}

// Delete selected element(s)
function deleteElement() {
  const selectedElements = document.querySelectorAll(".selected");
  selectedElements.forEach(function (element) {
    element.parentNode.removeChild(element);
  });
}

// Edit element content
function handleDoubleClick(event) {
  const selectedElement = event.target;
  const originalContent = selectedElement.textContent;
  const inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.value = originalContent;

  inputElement.addEventListener("blur", function () {
    selectedElement.textContent = this.value;
    selectedElement.setAttribute('data-content', this.value);
    selectedElement.removeAttribute("contentEditable");
    inputElement.parentNode.replaceChild(selectedElement, inputElement);
  });

  selectedElement.innerHTML = "";
  selectedElement.appendChild(inputElement);
  inputElement.focus();
}

// Clone selected element(s)
function cloneElement() {
  const selectedElements = document.querySelectorAll(".selected");
  selectedElements.forEach(function (element) {
    const clone = element.cloneNode(true);
    clone.style.left = (parseInt(clone.style.left.split('px')[0]) + 10) + 'px';
    clone.style.top = (parseInt(clone.style.top.split('px')[0]) + 10) + 'px';
    clone.classList.remove("selected");
    clone.onclick = selected(clone);
    canvas.appendChild(clone);
  });
}

// Undo action
function undo() {
  if (nelementsArray.length > 0) {
    const lastElementIndex = nelementsArray.length - 1;
    const lastElement = nelementsArray[lastElementIndex];
    lastElement.parentNode.removeChild(lastElement);
    nelementsArray.pop();
  }
}

// Redo action
function redo() {
  if (tempElementID !== "") {
    const element = document.getElementById(tempElementID);
    canvas.appendChild(element);
    nelementsArray.push(element);
    tempElementID = "";
  }
}

    