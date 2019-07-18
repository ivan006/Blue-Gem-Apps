@include('includes.menu_post')
@include('includes.DeepSmartDataArrayMenu')
@include('includes.DeepSmartDataItemMenu')
@include('includes.ShallowSmartDataMenu')

<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>

<form  id="form" enctype="multipart/form-data" name="form" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
  {{csrf_field()}}

  <h1>Sub-posts</h1>
  <div class="">

  </div>
  <h1>Data</h1>
  <div class="">

    <h2>Deep Smart Data</h2>
    <div class="">


      <?php
      if (!empty($ShowAllDeepSmartData)) {
        function list1($smartData, $SmartDataLocation, $SmartDataLocationParent, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
          foreach($smartData as $key => $value2){
            if (is_array($value2)) {
              ?>
              <li>
                <?php $SmartDataLocation = $SmartDataLocationParent.'/'.$key  ?>
                <?php
                if (1==1) {
                  // code...

                  ob_start();
                  ?>
                  <span><?php echo DeepSmartDataArrayMenu($SmartDataLocation, $SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocationParent'] ?>" value="<?php echo $SmartDataLocationParent ?>"><br>
                  <?php
                  $string1 = ob_get_contents();
                  ob_end_clean();

                  ob_start();
                  ?>
                  <span><?php echo DeepSmartDataArrayMenu(base64_encode($SmartDataLocation), $SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName']) ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocationParent']) ?>" value="<?php echo $SmartDataLocationParent ?>"><br>
                  <?php
                  $string2 = ob_get_contents();
                  ob_end_clean();

                  // echo $string1;
                  echo $string2;
                }
                ?>
                <ul>
                  <?php list1($value2, $SmartDataLocation, $SmartDataLocation, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes); ?>
                </ul>
              </li>
            <?php  } elseif ($key !== "url") {?>
              <li>
                <?php $SmartDataLocation = $SmartDataLocationParent.'/'.$key  ?>
                <?php
                if (1==1) {
                  // code...

                  ob_start();
                  ?>
                  <span><?php echo DeepSmartDataItemMenu($SmartDataLocation, $SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocation'] ?>" value="<?php echo $SmartDataLocationParent ?>"><br>
                  <textarea name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
                  <?php
                  $string1 = ob_get_contents();
                  ob_end_clean();

                  ob_start();
                  ?>
                  <span><?php echo DeepSmartDataItemMenu(base64_encode($SmartDataLocation), $SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName']) ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocation']) ?>" value="<?php echo $SmartDataLocationParent ?>"><br>
                  <textarea name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataContent']) ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
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
            <li>Deep Smart Data
              <ul>
                <?php list1($ShowAllDeepSmartData, null, null, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes);?>
              </ul>
            </li>
          </ul>
        </div>
        <?php
      }
      ?>
    </div>
    <h2>Shallow Smart Data</h2>
    <div class="">
      <div class="g-multi-level-dropdownd">
        <ul>
          <?php

          if (!empty($ShowAllShallowSmartData)) {

            foreach($ShowAllShallowSmartData as $key => $value2){ ?>
              <li>
                <?php $SmartDataLocation = '$SmartDataLocationParent'.'/'.$key  ?>
                <?php
                if (1==1) {
                  // code...

                  ob_start();
                  ?>
                  <span><?php echo ShallowSmartDataMenu($SmartDataLocation,$SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocation'] ?>" value="<?php echo '$SmartDataLocationParent' ?>"><br>
                  <textarea name="<?php echo $SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
                  <?php
                  $string1 = ob_get_contents();
                  ob_end_clean();

                  ob_start();
                  ?>
                  <span><?php echo ShallowSmartDataMenu(base64_encode($SmartDataLocation),$SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataName']) ?>" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataLocation']) ?>" value="<?php echo '$SmartDataLocationParent' ?>"><br>
                  <textarea name="<?php echo base64_encode($SmartDataLocation."/".$SmartDataItemM_ShowAttributeTypes['/SmartDataContent']) ?>" rows="8" cols="80"><?php echo $value2; ?></textarea>
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
          ?>

        </ul>


      </div>


    </div>
    <h2>All Content</h2>
    <div class="">
      <label>Please Select Zip File</label>
      <input type="file" name="zip_file" />
      <input type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
    </div>
    <h2>Rich Data</h2>
    <div class="">
      <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

      <textarea  onkeyup="saveData()" class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 100px;"><?php if (!empty($RichDataShow )) {  echo $RichDataShow ;}  ?></textarea>
      <!-- <a href="javascript:{}" onclick="document.getElementById('form').submit(); return false;">Store</a> -->

      <input type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
    </div>
    <h2>Deep Smart Data - Unnecessary json version</h2>
    <div class="">
        <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($ShowAllDeepSmartData)) { echo json_encode($ShowAllDeepSmartData, JSON_PRETTY_PRINT); }?></textarea>
        <input type="submit" name="<?php echo $SmartDataItemM_ShowActions['DeepSmartDataArrayStoreFromSingleField'] ?>" value="Store"><br>

      </div>
  </div>
</form>

<br>
