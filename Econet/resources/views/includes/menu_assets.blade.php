<style media="screen">
.link {
   background:none;
   border:none;
   padding:0!important;
   font: inherit;
}
</style>
<span style="background-color: rgba(0,0,0,0.3); padding: 1em;">


  <a href="{{ route('Assets.index') }}">Index</a>
  <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">
    Store
  </a>

  <a href="{{ $allURLs['sub_assets_create'] }}"><del>Create</del></a>
  <a href="{{ $allURLs['sub_assets_read'] }}">Show</a>
  <a href="{{ $allURLs['sub_assets_destroy'] }}"><del>Destroy</del></a>
  <a href="{{ $allURLs['sub_assets_edit'] }}">Edit</a>

</span>
