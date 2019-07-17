<?php function ShallowSmartDataMenu($SmartDataArrayName, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Item


    <!-- <button type="submit" name="<?php echo $SmartDataArrayName ?>" value="Store">Store</button>
    <button type="submit" name="<?php echo $SmartDataArrayName ?>" value="Create"><del>Create</del></button>
    <button type="submit" name="<?php echo $SmartDataArrayName ?>" value="Destroy"><del>Destroy</del></button> -->

    <button type="submit" name="<?php echo $SmartDataItemM_ShowActions['ShallowSmartDataStore'] ?>" value="<?php echo $SmartDataArrayName ?>">Store</button>
    <button type="submit" name="Create" value="<?php echo $SmartDataArrayName ?>"><del>Create</del></button>
    <button type="submit" name="Destroy" value="<?php echo $SmartDataArrayName ?>"><del>Destroy</del></button>

  </div>
<?php } ?>
