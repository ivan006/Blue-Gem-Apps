<?php function DeepSmartDataArrayMenu($SmartDataArrayShowBaseLocation,$SmartDataArrayName, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Array
    <span style="display: none;"><?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?></span>


    <!-- <button type="submit" name="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Store">Store</button>
    <button type="submit" name="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>" value="Destroy"><del>Destroy</del></button></del> -->

    <button type="submit" name="<?php echo $SmartDataItemM_ShowActions['DeepSmartDataArrayStore'] ?>" value="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>">Store</button>
    <button type="submit" name="Destroy" value="<?php echo $SmartDataArrayShowBaseLocation.$SmartDataArrayName ?>"><del>Destroy</del></button></del>

  </div>
<?php } ?>
