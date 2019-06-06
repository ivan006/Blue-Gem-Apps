<span style="background-color: rgba(0,0,0,0.3); padding: 1em;">
  Assets
  <a href="{{ URL::asset( $allURLs['assets_create']) }}">Create</a>
  <a href="{{ URL::asset( $allURLs['assets_read']) }}">Read</a>
</span>
<span style="background-color: rgba(0,0,0,0.3); padding: 1em;">
  SubAssets

  <a href="{{ URL::asset( $allURLs['sub_assets_read']) }}">Read</a>
  <a href="{{ URL::asset( $allURLs['sub_assets_update']) }}">Update</a>
</span>


<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>


<br>
<br>
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
