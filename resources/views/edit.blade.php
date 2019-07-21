@include('includes.menu_post')
@include('includes.DeepSmartDataArrayMenu')
@include('includes.DeepSmartDataItemMenu')
@include('includes.ShallowSmartDataMenu')
@include('includes.encode_decode')

<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



  <h1>Sub-posts</h1>
  <div class="">

  </div>
  <h1>Data</h1>
  <div class="">

    <h2>Deep Smart Data</h2>
    <div class="">
      <form  id="form" enctype="multipart/form-data" name="SmartDataItemShowFieldValues" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
        {{csrf_field()}}
        <input style="display: none;" type="text" name="SmartDataItemShowFieldValues_Form" value="1">


      <?php
      if (!empty($ShowAllDeepSmartData)) {
        function list1($SmartDataArrayShowBaseLocation,$smartData, $SmartDataLocation, $SmartDataLocationParent, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
          $SmartDataArrayShowBaseLocationEncoded = g_base64_encode($SmartDataArrayShowBaseLocation);
          foreach($smartData as $key => $value2){
            $SmartDataLocation = $SmartDataLocationParent.'['.g_base64_encode($key).']';
            $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
            if (is_array($value2)) {
              ?>
              <li>

                  <span><?php echo DeepSmartDataArrayMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataLocationParent'] ?>]" value="<?php echo $SmartDataArrayShowBaseLocationEncoded.$SmartDataLocationParent ?>"><br>

                <ul>
                  <?php list1($SmartDataArrayShowBaseLocationEncoded,$value2, $SmartDataLocation, $SmartDataLocation, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes); ?>
                </ul>
              </li>
            <?php  } elseif ($key !== "url") {?>
              <li>


                  <span><?php echo DeepSmartDataItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                  <input type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                  <input type="text" style="display:none;" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataLocation'] ?>]" value="<?php echo $SmartDataArrayShowBaseLocationEncoded.$SmartDataLocationParent ?>"><br>
                  <textarea name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $value2; ?></textarea>

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
                <?php
                // dd($ShowAllDeepSmartData);
                ?>
                <?php list1($SmartDataArrayShowBaseLocation,$ShowAllDeepSmartData,  null,               null,                     $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes);?>
                <?php
                // list1($SmartDataArrayShowBaseLocation,$smartData,             $SmartDataLocation, $SmartDataLocationParent, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
                   ?>
              </ul>
            </li>
          </ul>
        </div>
        <?php
      }
      ?>
      </form>
    </div>
  <form  id="form" enctype="multipart/form-data" name="form" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
    {{csrf_field()}}
    <h2>Shallow Smart Data</h2>
    <div class="">
      <div class="g-multi-level-dropdownd">
        <ul>


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
