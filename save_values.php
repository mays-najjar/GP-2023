<?php
// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $display = $_POST['display'];
  $borderColor = $_POST['borderColor'];
  $textAlign = $_POST['textAlign'];

  // Perform the necessary database operations to save the values
  // For example, you can use SQL queries to insert the values into a table

  // Replace the placeholders with your database connection details
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'html-tag';

  // Create a new database connection
  $conn = mysqli_connect('localhost','root','','html-tag') or die('connection failed');


  // Prepare the SQL statement
  $stmt = $conn->prepare('INSERT INTO style_element (element_id,style_id,style_value) VALUES ("2","1", "block")');
  $stmt->bind_param('sss', $display, $borderColor, $textAlign);

  // Execute the statement
  if ($stmt->execute()) {
    echo 'Data saved successfully!';
  } else {
    echo 'Error saving data: ' . $stmt->error;
  }

  // Close the statement and database connection
  $stmt->close();
  $conn->close();
}
?>
