<?php function SmartDataItemMenu($SmartDataArrayName){ ?>
  <div class="" style="  z-index: 1;position: relative;">
    Smart Data Item
    <span style="display: none;"><?php echo $SmartDataArrayName ?></span> 


    <a href="javascript:{}" onclick="document.getElementById('<?php echo 111 ?>').submit(); return false;">Store</a>
    <a href="http://econet.test/create/asset"><del>Create</del></a>
    <a href="http://econet.test/destroy/asset/Company%20XYZ/b"><del>Destroy</del></a>

  </div>
<?php } ?>
