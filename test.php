<?php
// echo "<br>Item Id:".$_POST['itemID'];
// echo "<br>Tag Id:".$_POST['tagID'];
// echo "<br>Tag Id:".$_POST['tag_ID'];

  $conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');
 // Retrieve the element's attributes and their values
 $tag_id =$_POST['tag_ID'];
 
 echo "<br>Tag Id:".$tag_id;
$query = "SELECT a.attribute_name, ea.attribute_value
          FROM element_attribute ea
          JOIN attribute a ON ea.attribute_id = a.attribute_id
          WHERE ea.element_id = $tag_id";
$result = mysqli_query($conn, $query);

?>
<?php
// Output the attributes and their values in a form
echo '<form class="form-group">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="form-group">';
    echo '<label for="' . $row['attribute_name'] . '">' . $row['attribute_name'] . '</label>';
    echo '<input type="text" class="form-control" id="' . $row['attribute_name'] . '" name="' . $row['attribute_name'] . '" value="' . $row['attribute_value'] . '">';
    echo '</div>';
}
echo '<button type="submit" class="btn btn-primary">Save changes</button>';
echo '</form>';
?>
 

