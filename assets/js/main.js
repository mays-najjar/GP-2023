// Get the canvas element
const canvas = document.getElementById('canvas');
const toolbar = document.getElementById('toolbar');

// Add event listener for dragging elements from toolbar
document.querySelectorAll('.element').forEach(element => {           
    element.addEventListener('dragstart', (event) => {                                                   //يعني نفّذ أمر معيّن لما تتغير قيمة readyState
        // Set the data being dragged
        event.dataTransfer.setData('text/plain', event.target.textContent);                                //the event object is used to access information about the drag event. 
        // dataTransfer>> prperity >>is an object that contains the data being transferred during a drag and drop operation. It has several methods that can be used to set and retrieve data, including 'setData', 'getData', and 'clearData'.
        //setDta>> method
                                                                                                                                       //the event object is used to access information about the drag event. 
               });                                                                                                                     //***  The 'event.target' property is then used to access the z element that triggered the event  
});                                                                                                              // The textContent property of the dragged element is used as the data being dragged.  ,,,The event.dataTransfer object is used to set the data being dragged. In this case, the setData method is called with two arguments: the first argument is the data type, which is set to 'text/plain', and the second argument is the data itself, which is set to the textContent of the dragged element.


// Add event listener for dropping elements onto canvas
canvas.addEventListener('dragover', (event) => {
    event.preventDefault();  //In this case, the default behavior is to disallow dropping the dragged element onto the canvas element.
    event.dataTransfer.dropEffect = 'copy';

});

canvas.addEventListener('drop', (event) => {
    event.preventDefault();
    const elementText = event.dataTransfer.getData('text/plain');  // retrieves the text data of the dragged element and assigns it to the elementText variable.
    const  newElement = document.createElement(elementText.trim());   //   داخل جواب الشرط مما يعني أنه لا يمكن الوصول إليه إلا داخلها بالتالي يسبب مشكلة عند استدعائها لاحقاً newElement لانه اذا عرفنا ال
    // if (elementText.trim() == 'footer') {
    //   newElement = document.createElement('div');
    // } else if (elementText.trim() == 'h2') {
    //   newElement = document.createElement('h2');
    // }else {
    //   newElement = document.createElement(elementText.trim());
    // }
    newElement.className = 'nelement ' ;                 //the DIV class IS (nelement),
    // newElement.className = elementText.trim();
    newElement.textContent = elementText;              //the DIV textContent property is set to the elementText value. 
    newElement.style.left = event.clientX.canvas + 'px';   //IN GENERAL >>  event.clientX property returns the horizontal coordinate (in pixels)  >>>>>     event.clientX.canvas expression sets the LEFT style of the new element    
    newElement.style.top = event.clientY.canvas + 'px';    //IN GENERAL >> event.clientY property returns the vertical coordinate (in pixels)     >>>>>     event.clientY.canvas sets the TOP style
    newElement.addEventListener('mousedown', startDrag);
    newElement.classList.add('selected');
    canvas.appendChild(newElement);

      // show the properties block and set its values based on the dropped element
  const propertiesBlock = document.getElementById('properties');
  propertiesBlock.style.display = 'block';
  

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

canvas.addEventListener('click', (event) => {
element.classList.remove('selected'); 
});