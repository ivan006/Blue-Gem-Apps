
<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>


<a href="{{ URL::asset($page_tools['edit']) }}">Edit</a>
<a href="{{ URL::asset($general_tools['browse_groups']) }}">Browse groups</a>
<br>
<br>
<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php
  if (isset($VSiteHeader)) {
    echo $VSiteHeader;
  }

  if (isset($VPgCont["rich.txt"])) {
    echo $VPgCont["rich.txt"];
  }
  ?>

</div>
