


@include('includes.general-include-one-of-four')


<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
.g-futuristic-indented-list {
  margin-left: 1em;
  margin-top: 1em;
  border-left: 2px lightgrey solid;
  padding-left: 1em;
}
.g-bor-gre {
  border: 2px lightgrey solid;
}
.g-bor-top-0 {
  border-top: 0px ;

}


</style>

@include('includes.general-include-two-of-four')



@include('includes.SmartDataFileItemMenu')
@include('includes.SmartDataFolderItemMenu')
@include('includes.ShallowSmartDataMenu')
@include('includes.encode_decode')

@include('includes.menu_post')

@include('includes.general-include-three-of-four')




<!-- Left Column -->
<div class="w3-col m2">


  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>

<!-- Middle Column -->
<div class="w3-col m8">





  <form  id="form" enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

    <input class="g-bor-gre"  style="display: none;" type="text" name="All_Content" value="1">

    {{csrf_field()}}
    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

      <h2>Upload Content</h2>
      <div class="">
        <label>Please Select Zip File</label>
        <input class="g-bor-gre"  type="file" name="zip_file" />
        <input class="g-bor-gre"  type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
      </div>
      <br>
    </div>

  </form>
  <form  id="form" enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

    <input class="g-bor-gre"  style="display: none;" type="text" name="Upload_content" value="1">

    {{csrf_field()}}
    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

      <h2>Upload Content</h2>
      <div class="">
        <label>Please Select Zip File</label>
        <input class="g-bor-gre"  type="file" name="zip_file" />
        <input class="g-bor-gre"  type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
      </div>
      <br>
    </div>

  </form>
  <form  id="form" enctype="multipart/form-data" name="SmartDataItemShowFieldValues" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
    {{csrf_field()}}
    <input class="g-bor-gre"  style="display: none;" type="text" name="SmartDataItemShowFieldValues_Form" value="1">

    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

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
          <input class="g-bor-gre"  style="display:none;" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>">
          <textarea class="g-bor-gre "  style="width:100%;"  name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" ><?php echo $ShowAllDeepSmartData["rich.txt"]; ?></textarea>
          <?php
        }
        ?>
      </div>
      <br>
    </div>



    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>


      <h2>Deep Smart Data</h2>
      <div class="">


        <?php
        if (!empty($ShowAllDeepSmartData)) {
          function list1($SmartDataArrayShowBaseLocation,$smartData, $SmartDataLocation, $SmartDataLocationParent, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
            $SmartDataArrayShowBaseLocationEncoded = g_base64_encode($SmartDataArrayShowBaseLocation);
            foreach($smartData as $key => $value2){
              // dd($SmartDataLocationParent);
              $SmartDataLocation = $SmartDataLocationParent.'['.g_base64_encode($key).']';
              $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
              ?>
              <div class="g-futuristic-indented-list"><br>

                <?php
                if (is_array($value2)) {
                  ?>

                  <?php
                  // dd($SmartDataID);
                  ?>
                  <span><?php echo SmartDataFolderItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                  <input class="g-bor-gre"  style="width:100%;" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>


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


                <?php  } elseif ($key !== "url") {?>

                  <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                  <input class="g-bor-gre"  style="width:100%;" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                  <textarea class="g-bor-gre g-bor-top-0"  style="width:100%;" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" ><?php echo $value2; ?></textarea>

                  <?php
                }
                ?>
                <br>
              </div>
              <?php
            }
          }

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

        }
        ?>
      </div>
      <br>
    </div>






    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      <h2>Shallow Smart Data</h2>
      <div class="">
        <div class="g-multi-level-dropdownd">

          <?php
          // dd($ShowAllDeepSmartData);
          if (isset($ShowAllDeepSmartData)) {
            // code...
            foreach($ShowAllDeepSmartData as $key => $value2){
              // dd($SmartDataLocationParent);
              $SmartDataLocation = '['.g_base64_encode($key).']';
              $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
              if (!is_array($value2) && $key !== $String_rich) {

                ?>
                <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                <input class="g-bor-gre"  style="width:100%" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                <textarea class="g-bor-gre g-bor-top-0"  style="width:100%" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $value2; ?></textarea>

                <?php
              }
            }
          }
          ?>

        </div>
      </div>
      <br>
    </div>



  </form>
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>Sub-posts</h2>
    <br>
  </div>


  <br>






  <!-- End Middle Column -->
</div>

<!-- Right Column -->
<div class="w3-col m2">

  <br>

  <!-- End Right Column -->
</div>



@include('includes.general-include-four-of-four')
