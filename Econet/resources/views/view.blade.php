
@include('includes.menu_post')

<?php
if (file_exists($ShowBaseIDPlusBaseLocation."/header.php")) {
  // code...

  include($ShowBaseIDPlusBaseLocation."/header.php");
}
?>

<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php

  if (isset($SubAssetDeepRead["rich.txt"])) {
    echo $SubAssetDeepRead["rich.txt"];
  }

  ?>

</div>
