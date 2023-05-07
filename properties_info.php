<!-- <script>
 var xhttp = new XMLHttpRequest();
   var myTags =[];// array to store data
   // xhttp.open("Content-type","http://localhost/GP-2023/api/ElementAttribute/read_single.php");  // فتح اتصال مع السيرفر

   xhttp.open("GET","http://localhost/GP-2023/api/tag/read.php");  // فتح اتصال مع السيرفر
   xhttp.send();
   xhttp.addEventListener('readystatechange', function() {
       if (this.readyState == 4 && this.status == 200) {
         myTags=JSON.parse(xhttp.response); //json.parse  convert string to array of objects
         console.log(myTags);
       }

       else console.log(this.readyState);
     });


</script> -->


<?php
// Get the element ID from the POST data
if(isset($_POST['element_id'])){
$element_id = $_POST['element_id'];

// Connect to the MySQL database
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');
$result= mysqli_query($conn ,"SELECT * FROM element WHERE element_id='$element_id'");  // رح يجبلي كل البيانات  result 
// يحط البيانات في اريه 



// // Query the database for the element properties
// $query = "SELECT * FROM element WHERE element_id='$element_id'";
// $result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// Format the element properties as HTML
$html = "<h2>Element Properties:</h2>";
$html .= "<ul>";
$html .= "<li>ID: " . $row['element_id'] . "</li>";
$html .= "<li>Tag ID: " . $row['tag_id'] . "</li>";
$html .= "<li>Content: " . $row['content'] . "</li>";
$html .= "</ul>";

// Send the HTML back to the client
echo $html;}
?>

<form id="element_properties" style="display:none ;">
    <div  class="form-group " id="properties_info">
    <?php
  $conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

  $attribute_name= mysqli_query($conn ,"SELECT * FROM attribute	 ");  
  $attribute_value= mysqli_query($conn ,"SELECT * FROM element	 ");  

  while(($row= mysqli_fetch_array($attribute_name) )&&( $str=mysqli_fetch_array($attribute_value)) ){ 
    echo"
    <label for='$str[attribute_value]' class='attribute $row[attribute_name]' >
    $row[attribute_name]
    </label>
    <input type='text' class='form-control' placeholder='Enter.$row[attribute_name]'> ";
    }?>
  
    </div>
  </form>
