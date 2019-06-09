
@include('includes.menu_assets')



<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php
  if (isset($VSiteHeader)) {
    echo $VSiteHeader;
  }

  if (isset($SubAssetDeepRead["rich.txt"])) {
    echo $SubAssetDeepRead["rich.txt"];
  }
  ?>

</div>
