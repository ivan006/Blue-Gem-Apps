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
<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php
  if (isset($VSiteHeader)) {
    echo $VSiteHeader;
  }

  if (isset($postDeepRead["rich.txt"])) {
    echo $postDeepRead["rich.txt"];
  }
  ?>

</div>
