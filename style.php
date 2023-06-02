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
    <label class="input-group-text" for="inputGroupSelect03" >Border Style </label>
  </div>
  <select class="custom-select " id="inputGroupSelect03" style="display: inline-block;">
    <option value="dashed" selected>dashed</option>
    <option value="dotted">dotted</option>
    <option value="double">double</option>
    <option value="groove">groove</option>
    <option value="hidden">hidden</option>
    <option value="inhereit">inhereit</option>
    <option value="initial">initial</option>
    <option value="inset">inset</option>
    <option value="none">none</option>
    <option value="revert">revert</option>
    <option value="ridge">ridge</option>
    <option value="solid">solid</option>
    <option value="unset">unset</option>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect04">Border Radius</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect04" style="display: inline-block; width: 50px; ">
</div>

<div class="input-group mb-3" >
  <div class="input-group-prepend"style="display: inline-block; margin-right:10px;">
  <label class="input-group-text" for="inputGroupSelect05" >Text-aligen</label>
  </div>
  <select class="custom-select " id="inputGroupSelect05" style="display: inline-block;">
    <option value="center" selected>center</option>
    <option value="end">end</option>
    <option value="left">left</option>
    <option value="right">right</option>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect06">Padding</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect06" style="display: inline-block; width: 50px; ">
  
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect07">Margin</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect07" style="display: inline-block; width: 50px; ">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect08">Background Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect08" style="display: inline-block;">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect09">Text Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect09" style="display: inline-block;">
</div>
<!-- Add an onclick event to the "Save" button -->
<button type="button" class="btn btn-primary" id="saveButton" onclick="saveData('<?php echo $element_id; ?>')">Save</button>

<script>



</script> 
</div>