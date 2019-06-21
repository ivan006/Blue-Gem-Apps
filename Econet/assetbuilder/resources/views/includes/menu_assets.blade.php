<style>
/* Small Devices, Tablets */
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
</style>
<div class="g-multi-level-dropdown" style="  z-index: 1;position: relative;">
  <ul style="background: rgba(0,0,0,0);">
    <li>
      <a href="http://econet.test/Assets/show/hey - Copy">
        Tools
      </a>
      <ul>
        <li><a href="{{ route('Assets.index') }}">Index</a></li>
        <li><a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a></li>
        <li><a href="{{ $allURLs['sub_assets_create'] }}"><del>Create</del></a></li>
        <li><a href="{{ $allURLs['sub_assets_read'] }}">Show</a></li>
        <li><a href="{{ $allURLs['sub_assets_destroy'] }}"><del>Destroy</del></a></li>
        <li><a href="{{ $allURLs['sub_assets_edit'] }}">Edit</a></li>
      </ul>
    </li>
  </ul>
</div>
