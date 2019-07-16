


<form  id="form" enctype="multipart/form-data" name="form" class="" action="{{ $allURLs['sub_webdoc_store'] }}" method="post">
  @include('includes.menu_webdoc')
  @include('includes.SmartDataArrayMenu')
  @include('includes.SmartDataItemMenu')

  <link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



  <h1>Rich Data</h1>
  <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

  {{csrf_field()}}
  <textarea  onkeyup="saveData()" class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php
  if (!empty($RichDataShow )) {
    echo $RichDataShow ;
  }
  ?></textarea>
  <!-- <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a> -->
  <input type="submit" name="RichText" value="Store"><br>
  <label>Please Select Zip File</label>
  <input type="file" name="zip_file" />
  <input type="submit" name="RichText" value="Store"><br>


  <h1>Smart Data</h1>
  <?php //dd($ShowAllSmartData); ?>
  <?php
  if (!empty($ShowAllSmartData)) {
    function list1($smartData, $SmartDataName){
      foreach($smartData as $key => $value2){
        if (is_array($value2)) {
          ?>
          <li>
            <?php $SmartDataName = $SmartDataName.'/'.$key  ?>
            <span><?php echo SmartDataItemMenu(base64_encode($SmartDataName)); ?></span>
            <input type="text" name="<?php echo base64_encode($SmartDataName.'/SmartDataName') ?>" value="<?php echo $key ?>"><br>
            <ul>
              <?php list1($value2, $SmartDataName); ?>
            </ul>
          </li>
        <?php  } elseif ($key !== "url") {?>
          <li>
            <?php $SmartDataName = $SmartDataName.'/'.$key  ?>

            <span><?php echo SmartDataArrayMenu(base64_encode($SmartDataName)); ?></span>
            <input type="text" name="<?php echo base64_encode($SmartDataName.'/SmartDataName') ?>" value="<?php echo $key ?>"><br>
            <textarea name="<?php echo base64_encode($SmartDataName.'/SmartDataContent') ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
          </li>
          <?php
        }
      }
    }
    ?>
    <div class="g-multi-level-dropdownd">
      <ul>
        <?php list1($ShowAllSmartData, null);?>
      </ul>
    </div>
    <?php
  }
  ?>
  <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($ShowAllSmartData)) { echo json_encode($ShowAllSmartData, JSON_PRETTY_PRINT); }?></textarea>

</form>

<br>
