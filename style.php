<?php
$conn = mysqli_connect('localhost', 'root', '', 'html_tag') or die('connection failed');

// Retrieve the element's attributes and their values
$element_id = $_POST['element_ID'];
echo "<br>Element Id:" . $element_id;
?>
<div id="style">
 <div class="input-group mb-3" >
  <div class="input-group-prepend"style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect01" >Display</label>
  </div>
  <select class="custom-select " id="inputGroupSelect01" style="display: inline-block;">
    <option value="block" selected>block</option>
    <option value="inline">inline</option>
    <option value="inline-block">inline-block</option>
    <option value="none">none</option>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect02">Border Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect02" style="display: inline-block;">
</div>

<div class="input-group mb-3" >
  <div class="input-group-prepend"style="display: inline-block; margin-right:10px;">
  <label class="input-group-text" for="inputGroupSelect03" >Text-aligen</label>
  </div>
  <select class="custom-select " id="inputGroupSelect03" style="display: inline-block;">
    <option value="center" selected>center</option>
    <option value="end">end</option>
    <option value="left">left</option>
    <option value="right">right</option>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect04">Padding</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect04" style="display: inline-block; width: 50px; ">
  <select id="unitSelect" class="custom-select" style="display: inline-block; margin-left:5px; ">
    <option value="px" selected>px</option>
    <option value="%">%</option>
    <option value="rem">rem</option>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect05">Margin</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect05" style="display: inline-block; width: 50px; ">
  <select id="unitSelect" class="custom-select" style="display: inline-block; margin-left:5px; ">
    <option value="px" selected>px</option>
    <option value="%">%</option>
    <option value="rem">rem</option>
  </select>
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect06">Background Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect06" style="display: inline-block;">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect07">Text Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect07" style="display: inline-block;">
</div>
<!-- Add an onclick event to the "Save" button -->
<button type="button" class="btn btn-primary" id="saveButton" onclick="saveData('<?php echo $element_id; ?>')">Save</button>

<script>



</script> 
</div>