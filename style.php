<?php
$conn = mysqli_connect('localhost', 'root', '', 'html_tag') or die('connection failed');

// Retrieve the element's attributes and their values
$element_id = $_POST['element_ID'];
// echo "<br>Element Id:" . $element_id;
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
<div class="input-group mb-3" style="">
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
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect14">Background Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect14" style="display: inline-block;">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect15">Text Color</label>
  </div>

  <input type="color" class="form-control " id="inputGroupSelect15" style="display: inline-block;">
</div>
<div class="input-group mb-3" style="display: inline-block; width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect16">Hight</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect16" style="display: inline-block; width: 40px; ">
  
</div>
<div class="input-group mb-3" style="display: inline-block; width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect17">Width</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect17" style="display: inline-block; width: 37px; ">
  
</div>

<label class="input-group-text" style="padding-right:99%; color:#585353;">Border </label>
<div class="input-group mb-3" style="display: inline-block;width: 19%;     margin-top: -8px;">
  <div class="input-group-prepend" style="display: inline-block; margin-right: 10px;">
    <label class="input-group-text" for="inputGroupSelect02" > </label>
  </div>

  <div style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Border Color">
  <input type="color" class="form-control " id="inputGroupSelect02" ></div>
</div>

<div class="input-group mb-3"  style="display: inline-block;width: 33%;">
  <div class="input-group-prepend"style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect03" >   </label>
  </div>
  <div style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Border style">
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
  </select></div>
</div>

<div class="input-group mb-3" style="display: inline-block;width: 33%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect04"> </label>
  </div>
  <div style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Border radius">
  <input type="number" value="1" class="custom-select" id="inputGroupSelect04" style="display: inline-block; width: 40px; ">
</div></div>



<label class="input-group-text" style="padding-right:99%; color:#585353;">Padding </label> <br>
<div class="input-group mb-3" style="display: inline-block;width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;" >
    <label class="input-group-text" for="inputGroupSelect06"> Left</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect06" style="display: inline-block; width: 40px; ">
</div>
<div class="input-group mb-3" style="display: inline-block; width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect07"> Right</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect07" style="display: inline-block; width: 40px; ">
 </div>
 <div class="input-group mb-3" style="display: inline-block;width: 43%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect08"> Top </label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect08" style="display: inline-block; width: 40px; ">
  </div>
  <div class="input-group mb-3" style="display: inline-block;width: 55%;">
  <div class="input-group-prepend" style="display: inline-block;  margin-right:10px; ">
    <label class="input-group-text" for="inputGroupSelect09"> bottom</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect09" style="display: inline-block; width: 40px; ">  
</div>

<label class="input-group-text" style="padding-right:99%;color:#585353;">Margin </label> <br>

<div class="input-group mb-3" class="margin" style="display: inline-block;width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect10">Left</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect10" style="display: inline-block; width: 40px; ">
</div>
<div class="input-group mb-3"  class="margin" style="display: inline-block;width: 49%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect11">Right</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect11" style="display: inline-block; width: 40px; ">
 </div>
 <div class="input-group mb-3"  class="margin" style="display: inline-block;width: 43%;">
  <div class="input-group-prepend" style="display: inline-block; margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect12">Top</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect12" style="display: inline-block; width: 39px; ">
  </div>
  <div class="input-group mb-3"  class="margin" style="display: inline-block;width: 55%;">
  <div class="input-group-prepend" style="display: inline-block;  margin-right:10px;">
    <label class="input-group-text" for="inputGroupSelect13">bottom</label>
  </div>
  <input type="number" value="1" class="custom-select" id="inputGroupSelect13" style="display: inline-block; width: 40px; ">  
</div>


<!-- Add an onclick event to the "Save" button -->
<button type="button" class="btn btn-primary" id="saveButton" onclick="saveData('<?php echo $element_id; ?>')">Save</button>

<script>



</script> 
</div>