<style>
  /* Small Devices, Tablets */
  @media only screen and (min-width: 768px) {
    .g-multi-level-dropdown ul{list-style:none;padding:0;margin:0;background:#1bc2a2;}
    .g-multi-level-dropdown ul li{display:block;position:relative;float:left;background:#1bc2a2;}
    /* This hides the dropdowns */
    .g-multi-level-dropdown li ul{display:none;}
    .g-multi-level-dropdown ul li a{display:block;padding:1em;text-decoration:none;white-space:nowrap;color:#fff;}
    .g-multi-level-dropdown ul li a:hover{background:#2c3e50;}
    /* Display the dropdown */
    .g-multi-level-dropdown li:hover > ul{display:block;position:absolute;}
    .g-multi-level-dropdown li:hover li{float:none;}
    .g-multi-level-dropdown li:hover a{background:#1bc2a2;}
    .g-multi-level-dropdown li:hover li a:hover{background:#2c3e50;}
    .g-multi-level-dropdown > ul li ul li{border-top:0;}
    /* Displays second level dropdowns to the right of the first level dropdown */
    .g-multi-level-dropdown ul ul ul{left:100%;top:0;}
    /* Simple clearfix */
    .g-multi-level-dropdown ul:before, .g-multi-level-dropdown ul:after{content:" "; display:table;}
    .g-multi-level-dropdown ul:after{clear:both;}
  }
  @media only screen and (max-width: 768px) {
    /** * Framework starts from here ... * ------------------------------ */
     .g-multi-level-dropdown > ul, .g-multi-level-dropdown > ul ul{margin:0 0 0 1em;padding:0;list-style:none;color:#369;position:relative;}
     .g-multi-level-dropdown > ul ul{margin-left:.5em}
     /* (indentation/2) */
     .g-multi-level-dropdown > ul:before, .g-multi-level-dropdown > ul ul:before{content:"";display:block;width:0;position:absolute;top:0;bottom:0;left:0;border-left:1px solid;}
     .g-multi-level-dropdown > ul li{margin:0;padding:0 1.5em;line-height:2em;font-weight:bold;position:relative;}
     .g-multi-level-dropdown > ul li:before{content:"";display:block;width:10px;height:0;border-top:1px solid;margin-top:-1px;position:absolute;top:1em;left:0;}
     .g-multi-level-dropdown > ul li:last-child:before{background:white;height:auto;top:1em;bottom:0;}
  }
  @media only screen and (max-width: 768px) {
    .g-resp-sm-hide {display: none;}
  }
</style>



<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



<div class="g-multi-level-dropdown">
  <?php function ivan($post = array()){?>
    <ul>
    <?php foreach($post as $key => $value){?>
      @if (is_array($value))
        <li><a href="{{$value['url']}}">{{$key}} <span class="g-resp-sm-hide">+</span></a><?php ivan($value); ?></li>
      @else
        @if ($key !== "url")
          <li><a href="{{$value}}">{{$key}}</a></li>
        @endif
      @endif
    <?php }?>
    </ul>
  <?php }?>
  <?php ivan($ivan1) ?>
</div>
<br>


<a href="{{ URL::asset($dir) }}">view</a>
<br>
<h1>Rich Data</h1>


 <form class="" action="{{ URL::asset($dir)}}" method="post">
   <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

   {{csrf_field()}}
   <input type="submit" name="submit" value="Submit">
   <textarea class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php
     $rich = 'rich.txt';
     if (isset($ivan2[$rich])) {
       echo $ivan2[$rich];
     }
     ?></textarea>
   <input style="display: none;" type="text"  name="file" value="<?php echo $rich; ?>"  placeholder="Enter title">


 </form>

<br>
<h1>Smart Data</h1>

<div class="json-editor" id="mydiv"></div>

<script src="{{ URL::asset('js/FlexiJsonEditor/jquery.min.js') }}"></script>

<script src="{{ URL::asset('js/FlexiJsonEditor/jquery.jsoneditor.js') }}"></script>

<script type="text/javascript">


<?php
$ivan3 = array();
$ivan3["smart"] = $ivan2['smart'];
$ivan_json =  json_encode($ivan3);?>
var myjson = <?php echo $ivan_json; ?>;
var opt = {
  change: function(data) { /* called on every change */ },
  propertyclick: function(path) { /* called when a property is clicked with the JS path to that property */ }
};
/* opt.propertyElement = '<textarea>'; */ // element of the property field, <input> is default
/* opt.valueElement = '<textarea>'; */  // element of the value field, <input> is default
$('#mydiv').jsonEditor(myjson, opt);
</script>
