



<!DOCTYPE html>
<html>
<head>

  @include('includes.SmartDataFileItemMenu')
  @include('includes.SmartDataFolderItemMenu')
  @include('includes.ShallowSmartDataMenu')
  @include('includes.encode_decode')

  <title>W3.CSS Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('includes.theme-css')

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
  .g-futuristic-indented-list {
    margin-left: 1em;
    margin-top: 1em;
    border-left: 2px whitesmoke solid;
    padding-left: 1em;
  }
  .g-bor-gre {
    border: 2px whitesmoke solid;
  }
  .g-bor-top-0 {
    border-top: 0px ;

  }


</style>

</head>

<body class="w3-theme-l5">

  <!-- Navbar -->

      @include('includes.menu_post')



  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
  </div>

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
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

            <h2>All Content</h2>
            <div class="">
              <label>Please Select Zip File</label>
              <input class="g-bor-gre"  type="file" name="zip_file" />
              <input class="g-bor-gre"  type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
            </div>
            <br>
          </div>

        </form>
        <form  id="form" enctype="multipart/form-data" name="SmartDataItemShowFieldValues" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
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
          {{csrf_field()}}


          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>


            <h2>Deep Smart Data</h2>
            <div class="">

              <input class="g-bor-gre"  style="display: none;" type="text" name="SmartDataItemShowFieldValues_Form" value="1">


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

      <!-- End Grid -->
    </div>

    <!-- End Page Container -->
  </div>
  <br>

  <!-- Footer -->


  <footer class="w3-container w3-theme-d5">
    <p>Powered by Floral Builder</p>
  </footer>

  <script>
    // Accordion
    function myFunction(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
      } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
      }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }
  </script>

</body>
</html>
