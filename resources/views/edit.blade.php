


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
    function list1($smartData, $SmartDataLocationChild, $SmartDataLocation){
      foreach($smartData as $key => $value2){
        if (is_array($value2)) {
          ?>
          <li>
            <?php $SmartDataLocationChild = $SmartDataLocation.'/'.$key  ?>
            <?php
            if (1==1) {
              // code...

              ob_start();
              ?>
              <span><?php echo SmartDataArrayMenu($SmartDataLocationChild); ?></span>
              <input type="text" name="<?php echo $SmartDataLocationChild.'/SmartDataName' ?>" value="<?php echo $key ?>"><br>
              <?php
              $string1 = ob_get_contents();
              ob_end_clean();

              ob_start();
              ?>
              <span><?php echo SmartDataArrayMenu(base64_encode($SmartDataLocationChild)); ?></span>
              <input type="text" name="<?php echo base64_encode($SmartDataLocationChild.'/SmartDataName') ?>" value="<?php echo $key ?>"><br>
              <?php
              $string2 = ob_get_contents();
              ob_end_clean();

              // echo $string1;
              echo $string2;
            }
            ?>
            <ul>
              <?php list1($value2, $SmartDataLocationChild, $SmartDataLocationChild); ?>
            </ul>
          </li>
        <?php  } elseif ($key !== "url") {?>
          <li>
            <?php $SmartDataLocationChild = $SmartDataLocation.'/'.$key  ?>
            <?php
            if (1==1) {
              // code...

              ob_start();
              ?>
              <span><?php echo SmartDataItemMenu($SmartDataLocationChild); ?></span>
              <input type="text" name="<?php echo $SmartDataLocationChild.'/SmartDataName' ?>" value="<?php echo $key ?>"><br>
              <textarea name="<?php echo $SmartDataLocationChild.'/SmartDataContent' ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
              <?php
              $string1 = ob_get_contents();
              ob_end_clean();

              ob_start();
              ?>
              <span><?php echo SmartDataItemMenu(base64_encode($SmartDataLocationChild)); ?></span>
              <input type="text" name="<?php echo base64_encode($SmartDataLocationChild.'/SmartDataName') ?>" value="<?php echo $key ?>"><br>
              <textarea name="<?php echo base64_encode($SmartDataLocationChild.'/SmartDataContent') ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
              <?php
              $string2 = ob_get_contents();
              ob_end_clean();

              // echo $string1;
              echo $string2;
            }
            ?>
          </li>
          <?php
        }
      }
    }
    ?>
    <div class="g-multi-level-dropdownd">
      <ul>
        <?php list1($ShowAllSmartData, null, null);?>
      </ul>
    </div>
    <?php
  }
  ?>
  <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($ShowAllSmartData)) { echo json_encode($ShowAllSmartData, JSON_PRETTY_PRINT); }?></textarea>
  <input type="submit" name="SmartDataArray" value="Store"><br>
</form>

<br>
