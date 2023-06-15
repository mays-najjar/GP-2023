<script>

</script>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'html_tag') or die('connection failed');

// Retrieve the element's attributes and their values
$tag_id = $_POST['tag_ID'];
$element_id = $_POST['element_ID'];

$element_id = $_POST['element_ID'];
// echo "<br>Tag Id:" . $tag_id;
// echo "<br>Element Id:" . $element_id;

$query = "SELECT a.attribute_id, a.attribute_name
    FROM attribute a
    JOIN tag_attribute ta ON a.attribute_id = ta.attribute_id
    WHERE ta.tag_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $tag_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
// Replace with the desired element ID

$query2 = "SELECT ea.attribute_id, ea.attribute_value, a.attribute_name
    FROM element_attribute ea
    JOIN attribute a ON ea.attribute_id = a.attribute_id
    WHERE ea.element_id = ?";

$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "i", $element_id);
mysqli_stmt_execute($stmt2);

$result2 = mysqli_stmt_get_result($stmt2);

?>

<?php
// Output the attributes and their values in a form
echo '<form class="form-group">';
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="form-group">';
        echo '<label for="' . $row['attribute_name'] . '">' . $row['attribute_name'] . '</label>';
        $query2 = "SELECT attribute_value FROM element_attribute WHERE element_id = ? AND attribute_id IN (SELECT attribute_id FROM attribute WHERE attribute_name = ?)";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "is", $element_id, $row['attribute_name']);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if ($result2 && $row2 = mysqli_fetch_assoc($result2)) {
            $attribute_value = $row2['attribute_value'];
            echo '<input type="text" class="form-control" id="' . $row['attribute_name'] . '" name="' . $row['attribute_name'] . '" value="' . $attribute_value . '">';
        } else {
            echo '<input type="text" class="form-control" id="' . $row['attribute_name'] . '" name="' . $row['attribute_name'] . '">';
        }

        echo '</div>';
    }
}

echo '<button type="button" class="btn btn-secondary" onclick="updateElementAttributes()" id="displayButton">Display</button>';
echo '</form>';
?>
