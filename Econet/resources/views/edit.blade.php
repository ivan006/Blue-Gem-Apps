<form  id="form" name="form" class="" action="{{ $allURLs['sub_assets_store'] }}" method="post">
  @include('includes.menu_assets')

  <link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



  <h1>Rich Data</h1>
  <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

  {{csrf_field()}}
  <textarea  onkeyup="saveData()" class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php
  $rich = 'rich.txt';
  if (isset($SubAssetDeepRead[$rich])) {
    echo $SubAssetDeepRead[$rich];
  }
  ?></textarea>
  <input style="display: none;" type="text"  name="file" value="<?php echo $rich; ?>"  placeholder="Enter title">
  <h1>Smart Data</h1>
  <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($SubAssetDeepRead['smart'])) {
      echo json_encode($SubAssetDeepRead['smart'], JSON_PRETTY_PRINT);
    }?>
</textarea>


</form>

<br>
