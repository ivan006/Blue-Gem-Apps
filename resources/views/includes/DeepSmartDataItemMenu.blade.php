<?php function DeepSmartDataItemMenu($SmartDataArrayShowBaseLocation,$SmartDataArrayName, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Item


    <!-- <button type="submit" name="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Store">Store</button>
    <button type="submit" name="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Create"><del>Create</del></button>
    <button type="submit" name="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Destroy"><del>Destroy</del></button> -->

    <button type="submit" name="<?php echo $SmartDataItemM_ShowActions['DeepSmartDataItemStore'] ?>" value="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>">Store</button>
    <button type="submit" name="Create" value="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>"><del>Create</del></button>
    <button type="submit" name="Destroy" value="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>"><del>Destroy</del></button>

  </div>
<?php } ?>
