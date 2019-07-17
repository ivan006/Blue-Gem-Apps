<?php function DeepSmartDataArrayMenu($SmartDataArrayName, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Array
    <span style="display: none;"><?php echo $SmartDataArrayName ?></span>


    <!-- <button type="submit" name="<?php echo $SmartDataArrayName ?>" value="Store">Store</button>
    <button type="submit" name="<?php echo $SmartDataArrayName ?>" value="Destroy"><del>Destroy</del></button></del> -->

    <button type="submit" name="<?php echo $SmartDataItemM_ShowActions['DeepSmartDataArrayStore'] ?>" value="<?php echo $SmartDataArrayName ?>">Store</button>
    <button type="submit" name="Destroy" value="<?php echo $SmartDataArrayName ?>"><del>Destroy</del></button></del>

  </div>
<?php } ?>
