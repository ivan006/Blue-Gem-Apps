<?php function SmartDataFolderItemMenu($SmartDataID, $SmartDataItemM_ShowActions){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Array
    <span style="display: none;">1</span>



    <button type="submit" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowActions['SelectedSmartDataItem'] ?>]" value="1">Store</button>
    <button type="submit" name="Destroy" value="1"><del>Destroy</del></button></del>

  </div>
<?php } ?>
