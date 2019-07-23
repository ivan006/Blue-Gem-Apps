@include('includes.menu_post')
@include('includes.SmartDataFileItemMenu')
@include('includes.SmartDataFolderItemMenu')
@include('includes.ShallowSmartDataMenu')
@include('includes.encode_decode')

<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



<h1>Sub-posts</h1>
<div class="">

</div>
<h1>Data</h1>

<form  id="form" enctype="multipart/form-data" name="SmartDataItemShowFieldValues" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

  {{csrf_field()}}
  <div class="">

    <h2>All Content</h2>
    <div class="">
      <label>Please Select Zip File</label>
      <input type="file" name="zip_file" />
      <input type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
    </div>

    <h2>Rich Data</h2>
    <div class="">

      <?php
      $String_rich = "rich.txt";
      $key = $String_rich;

      $key_encode = g_base64_encode($key);
      if (isset($ShowAllDeepSmartData["rich.txt"])) {
        // code...
        $SmartDataID = "SmartDataItemShowFieldValues[".$key_encode."]";
        ?>
        <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
        <input style="display:none;" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>">
        <textarea name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $ShowAllDeepSmartData["rich.txt"]; ?></textarea>
        <?php
      }
      ?>
    </div>
    <h2>Deep Smart Data</h2>
    <div class="">
      {{csrf_field()}}
      <input style="display: none;" type="text" name="SmartDataItemShowFieldValues_Form" value="1">


      <?php
      if (!empty($ShowAllDeepSmartData)) {
        function list1($SmartDataArrayShowBaseLocation,$smartData, $SmartDataLocation, $SmartDataLocationParent, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
          $SmartDataArrayShowBaseLocationEncoded = g_base64_encode($SmartDataArrayShowBaseLocation);
          foreach($smartData as $key => $value2){
            // dd($SmartDataLocationParent);
            $SmartDataLocation = $SmartDataLocationParent.'['.g_base64_encode($key).']';
            $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
            if (is_array($value2)) {
              ?>
              <li>
                <?php
                // dd($SmartDataID);
                ?>
                <span><?php echo SmartDataFolderItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                <input type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>

                <ul>
                  <?php
                  list1(
                  $SmartDataArrayShowBaseLocationEncoded,
                  $value2,
                  $SmartDataLocation,
                  $SmartDataLocation,
                  $SmartDataItemM_ShowActions,
                  $SmartDataItemM_ShowAttributeTypes
                  );
                  ?>
                </ul>
              </li>
            <?php  } elseif ($key !== "url") {?>
              <li>
                <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                <input type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                <textarea name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $value2; ?></textarea>
              </li>
              <?php
            }
          }
        }
        ?>
        <div class="g-multi-level-dropdownd">
          <ul>
            <?php
            // dd($ShowAllDeepSmartData);
            ?>
            <?php
            // dd($ShowAllDeepSmartData);
            // dd($SmartDataArrayShowBaseLocation);
            $ShowAllDeepSmartDataSmart['smart'] = $ShowAllDeepSmartData['smart'];
            // $ShowAllDeepSmartDataSmart = $ShowAllDeepSmartData;
            // $ShowAllDeepSmartData = $ShowAllDeepSmartDataSmart;
            list1(
            $SmartDataArrayShowBaseLocation,
            $ShowAllDeepSmartDataSmart,
            null,
            null,
            $SmartDataItemM_ShowActions,
            $SmartDataItemM_ShowAttributeTypes
            );
            ?>


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
          foreach($ShowAllDeepSmartData as $key => $value2){
            // dd($SmartDataLocationParent);
            $SmartDataLocation = '['.g_base64_encode($key).']';
            $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
            if (!is_array($value2) && $key !== $String_rich) {

              ?>
              <li>
                <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                <input type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                <textarea name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $value2; ?></textarea>
              </li>
              <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>


  </div>
</form>

<br>
