<span style="background-color: rgba(0,0,0,0.3); padding: 1em;">
  Groups
  <a href="{{ URL::asset( $allTools['groups_create']) }}">Create</a>
  <a href="{{ URL::asset( $allTools['groups_read']) }}">Read</a>
</span>
<span style="background-color: rgba(0,0,0,0.3); padding: 1em;">
  Posts

  <a href="{{ URL::asset( $allTools['posts_read']) }}">Read</a>
  <a href="{{ URL::asset( $allTools['posts_update']) }}">Update</a>
</span>


<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>

<br>
<br>


 <form class="" action="{{ URL::asset( $allTools['posts_read']) }}" method="post">
   <input type="submit" name="submit" value="Submit">
   <h1>Rich Data</h1>
   <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

   {{csrf_field()}}
   <textarea class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php
     $rich = 'rich.txt';
     if (isset($postDeepRead[$rich])) {
       echo $postDeepRead[$rich];
     }
     ?></textarea>
   <input style="display: none;" type="text"  name="file" value="<?php echo $rich; ?>"  placeholder="Enter title">
   <h1>Smart Data</h1>
   <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"></textarea>


 </form>

<br>


<div class="json-editor" id="mydiv"></div>

<script src="{{ URL::asset('js/FlexiJsonEditor/jquery.min.js') }}"></script>

<script src="{{ URL::asset('js/FlexiJsonEditor/jquery.jsoneditor.js') }}"></script>

<script type="text/javascript">
<?php
if (isset($postDeepRead['smart'])) {
  $ivan3 = array();
  $ivan3["smart"] = $postDeepRead['smart'];
  $ivan_json =  json_encode($ivan3);
} else {
  $ivan_json =  null;
}
?>
var myjson =
<?php
echo $ivan_json;
?>
;

</script>
<script type="text/javascript">
// var opt = {
//   change: function(data) { /* called on every change */ },
//   propertyclick: function(path) { /* called when a property is clicked with the JS path to that property */ }
// };
// /* opt.propertyElement = '<textarea>'; */ // element of the property field, <input> is default
// /* opt.valueElement = '<textarea>'; */  // element of the value field, <input> is default
// $('#mydiv').jsonEditor(myjson, opt);

</script>


<!-- <script type="text/javascript">

  let thingydo = document.getElementById("mydiv").getElementsByTagName("DIV")[0].getElementsByClassName("value")[0];
  thingydo.onkeyup = function() {myFunctiondd()};


  function myFunctiondd() {  document.getElementById("theLord").value = thingydo.value;}

</script> -->
<script type="text/javascript">
// document.getElementById("theLord").value = myjson.smart.toSource();
// document.getElementById("theLord").value = JSON.stringify(myjson.smart);
document.getElementById("theLord").value = JSON.stringify(myjson);

</script>
