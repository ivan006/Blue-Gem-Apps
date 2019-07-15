<div class="" style="  z-index: 1;position: relative;">
  Network
  <a href="{{ route('WebDoc.index') }}">Show</a>
  WebDoc
  <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a>
  <a href="{{ $allURLs['sub_webdoc_create'] }}"><del>Create</del></a>
  <a href="{{ $allURLs['sub_webdoc_read'] }}">Show</a>
  <a href="{{ $allURLs['sub_webdoc_destroy'] }}"><del>Destroy</del></a>
  <a href="{{ $allURLs['sub_webdoc_edit'] }}">Edit</a>
</div>


<?php

function actions(){
?>
  <div class="" style="  z-index: 1;position: relative;">
    Tools
    <a href="{{ route('WebDoc.index') }}">Index</a>
    <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a>
    <a href="{{ $allURLs['sub_webdoc_create'] }}"><del>Create</del></a>
    <a href="{{ $allURLs['sub_webdoc_read'] }}">Show</a>
    <a href="{{ $allURLs['sub_webdoc_destroy'] }}"><del>Destroy</del></a>
    <a href="{{ $allURLs['sub_webdoc_edit'] }}">Edit</a>
  </div>
<?php
}
?>
