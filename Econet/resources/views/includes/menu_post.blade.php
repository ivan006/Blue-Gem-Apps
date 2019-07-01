<div class="" style="  z-index: 1;position: relative;">
  Network
  <a href="{{ route('Post.index') }}">Show</a>
  Post
  <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a>
  <a href="{{ $allURLs['sub_post_create'] }}"><del>Create</del></a>
  <a href="{{ $allURLs['sub_post_read'] }}">Show</a>
  <a href="{{ $allURLs['sub_post_destroy'] }}"><del>Destroy</del></a>
  <a href="{{ $allURLs['sub_post_edit'] }}">Edit</a>
</div>


<?php

function actions(){
?>
  <div class="" style="  z-index: 1;position: relative;">
    Tools
    <a href="{{ route('Post.index') }}">Index</a>
    <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a>
    <a href="{{ $allURLs['sub_post_create'] }}"><del>Create</del></a>
    <a href="{{ $allURLs['sub_post_read'] }}">Show</a>
    <a href="{{ $allURLs['sub_post_destroy'] }}"><del>Destroy</del></a>
    <a href="{{ $allURLs['sub_post_edit'] }}">Edit</a>
  </div>
<?php
}
?>
