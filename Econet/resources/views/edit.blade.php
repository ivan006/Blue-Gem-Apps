


<form  id="form" enctype="multipart/form-data" name="form" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
  @include('includes.menu_post')

  <link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>



  <h1>Rich Data</h1>
  <!-- surname 1: [r]Education/Destiny Code/smart/surname.txt[/r]<br>  surname 2: [r]Education/Graft Your Garden/smart/surname.txt[/r]<br>      -->

  {{csrf_field()}}
  <textarea  onkeyup="saveData()" class="" name="contents"  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php

  if (!empty($ShowRichData )) {
    echo $ShowRichData ;
  }
  ?></textarea>
  <label>Please Select Zip File</label>
  <input type="file" name="zip_file" />
  <br />

  <h1>Smart Data</h1>
<?php //dd($ShowSmartData); ?>
  <textarea id="theLord" type="text" name="smart" value="" class=""  style="background-color: rgb(200,200,200); padding: 1em; width: 100%; height: 200px;"><?php if (isset($ShowSmartData)) {
    echo json_encode($ShowSmartData, JSON_PRETTY_PRINT);
  }?></textarea>















<?php
if (!empty($ShowSmartData)) {
  function list1($smartData){

    foreach($smartData as $key => $value2){

      if (is_array($value2)) {
        ?>
        <li>
          <a href="<?php  //echo $value2['url'];?>">
            <?php echo $key ?>
          </a>
          <ul>
            <?php list1($value2); ?>
          </ul>
        </li>
      <?php  } elseif ($key !== "url") {?>

        <li>
          <a href="<?php  //echo $value2['url'];?>">
            <?php echo $key ?>
          </a>
          <ul>
            <textarea name="name" rows="8" cols="80"><?php echo $value2; ?></textarea>
          </ul>
        </li>

      <?php  }?>
    <?php  }?>
  <?php  }?>

  <div class="g-multi-level-dropdownd">
    <ul>
      <?php list1($ShowSmartData);?>

    </ul>
  </div>
<?php }?>
</form>

<br>
