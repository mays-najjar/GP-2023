
<?php

header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../models/Element_attribute.php';
include_once '../../config/Database.php';

$db = new Database();
$db->connect();

$element_attribute  = new ElementAttribute($db);
$element_attribute->element_id = isset($_GET['element_id']) ? $_GET['element_id'] : die();

$element_attribute->attribute_id = isset($_GET['attribute_id']) ? $_GET['attribute_id'] : die();

$element_attribute->read_single();

$element_attribute_arr = array(
    'element_id' => $element_attribute->element_id,
    'attribute_id' => $element_attribute->attribute_id,
    'attribute_value' => $element_attribute->attribute_value

);
print_r(json_encode($element_attribute_arr));
 ?>
<!--  
<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   echo "<br>Item Id:".$_POST['itemID'];
//   echo "<br>Tag Id:".$_POST['tagID'];
// }

// // Get the element ID from the POST data
// if(isset($_POST['element_id'])){
// $element_id = $_POST['element_id'];

// // Connect to the MySQL database
// $conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');
// $result= mysqli_query($conn ,"SELECT * FROM element WHERE element_id='$element_id'");  // رح يجبلي كل البيانات  result 
// // يحط البيانات في اريه 



// // Query the database for the element properties
// $query = "SELECT * FROM element WHERE element_id='$element_id'";
// $result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// // Format the element properties as HTML
// $html = "<h2>Element Properties:</h2>";
// $html .= "<ul>";
// $html .= "<li>ID: " . $row['element_id'] . "</li>";
// $html .= "<li>Tag ID: " . $row['tag_id'] . "</li>";
// $html .= "<li>Content: " . $row['content'] . "</li>";
// $html .= "</ul>";

// // Send the HTML back to the client
//echo $html;}
?>

<form id="element_properties" style="display:none ;">
    <div  class="form-group " id="properties_info">
    <?php
  // $conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');

  // $attribute_name= mysqli_query($conn ,"SELECT * FROM attribute	 ");  
  // $attribute_value= mysqli_query($conn ,"SELECT * FROM element	 ");  

  // while(($row= mysqli_fetch_array($attribute_name) )&&( $str=mysqli_fetch_array($attribute_value)) ){ 
  //   echo"
  //   <label for='$str[attribute_value]' class='attribute $row[attribute_name]' >
  //   $row[attribute_name]
  //   </label>
  //   <input type='text' class='form-control' placeholder='Enter.$row[attribute_name]'> ";
  //   }?>
  
    </div>
  </form> -->
