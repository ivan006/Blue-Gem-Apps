<?php function ShallowSmartDataMenu($SmartDataID, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Item




    <button type="submit" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowActions['ShallowSmartDataStore'] ?>]" value="1">Store</button>
    <button type="submit" name="Create" value="1"><del>Create</del></button>
    <button type="submit" name="Destroy" value="1"><del>Destroy</del></button>

  </div>
<?php } ?>

    <!-- <button type="submit" name="<?php //echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Store">Store</button>
    <button type="submit" name="<?php //echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Create"><del>Create</del></button>
    <button type="submit" name="<?php// echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Destroy"><del>Destroy</del></button> -->
