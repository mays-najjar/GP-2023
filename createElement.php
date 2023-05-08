<?php
$conn = mysqli_connect('localhost','root','','html_tag') or die('connection failed');
//echo "Item Id:".$_POST['tag_name'];
$tag_name =$_POST['tag_name'];
$create =mysqli_query($conn ,'INSERT into element (tag_id, attribute_id, attribute_value, content, parent_id, child_id)
SELECT tag_id, NULL, NULL, NULL, NULL, NULL
FROM tag
WHERE tag_name = $tag_name ');

//attributes
//" SELECT attribute.attribute_name
// FROM tag
// INNER JOIN tag_attribute ON tag.tag_id = tag_attribute.tag_id
// INNER JOIN attribute ON tag_attribute.attribute_id = attribute.attribute_id
// WHERE tag.tag_name";
// }


?>

