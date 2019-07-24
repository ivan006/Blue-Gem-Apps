  @include('includes.theme-css')
@include('includes.menu_post')
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
<?php
if (file_exists($ShowBaseIDPlusBaseLocation."/header.php")) {
  // code...

  include($ShowBaseIDPlusBaseLocation."/header.php");
}
?>

<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php

  if (!empty($RichDataShow )) {
    echo $RichDataShow ;
  }

  ?>

</div>

</div>
