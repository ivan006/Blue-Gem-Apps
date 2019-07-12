


<form  id="form" enctype="multipart/form-data" name="form" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
  @include('includes.menu_post')

  <link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



  <h1>Rich Data</h1>
  <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

  {{csrf_field()}}
  <textarea  onkeyup="saveData()" class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php

  if (!empty($RichDataShow )) {
    echo $RichDataShow ;
  }
  ?></textarea>
  <label>Please Select Zip File</label>
  <input type="file" name="zip_file" />
  <br />

  <h1>Smart Data</h1>
  <?php //dd($ShowAllSmartData); ?>
  <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($ShowAllSmartData)) { echo json_encode($ShowAllSmartData, JSON_PRETTY_PRINT); }?></textarea>

  <?php
  if (!empty($ShowAllSmartData)) {
    function list1($smartData){


        foreach($smartData as $key => $value2){

          if (is_array($value2)) {

            ?>

            <li>



              <div class="" style="  z-index: 1;position: relative;">
                Smart data group
                <a href="javascript:{}" onclick="document.getElementById('<?php echo 111 ?>').submit(); return false;">Store</a>
                <a href="http://econet.test/create/asset"><del>Create</del></a>
                <a href="http://econet.test/destroy/asset/Company%20XYZ/b"><del>Destroy</del></a>
              </div>
              <input type="text" name="" value="<?php echo $key ?>"><br>


              <ul>
                <?php list1($value2); ?>
              </ul>
            </li>
          <?php  } elseif ($key !== "url") {?>

            <li>

              <div class="" style="  z-index: 1;position: relative;">
                Smart data item
                <a href="javascript:{}" onclick="document.getElementById('<?php echo 111 ?>').submit(); return false;">Store</a>
                <a href="http://econet.test/destroy/asset/Company%20XYZ/b"><del>Destroy</del></a>
              </div>
              <input type="text" name="" value="<?php echo $key ?>"><br>
              <textarea name="name" rows="8" cols="80"><?php echo $value2; ?></textarea>

            </li>
            <?php
          }

      }
    }
    ?>

    <div class="g-multi-level-dropdownd">
      <ul>


        <?php list1($ShowAllSmartData);?>


      </ul>
    </div>
    <?php
  }
  ?>

</form>

<br>
