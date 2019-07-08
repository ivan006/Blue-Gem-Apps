<?php
$createArray = array(  1,  2,  3,  4,  5,);
$createArray[0] = $createArray ;
$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);

function showArray($fractal){
  foreach($fractal as $key => $value2){
    if (is_array($value2)) {
      ?>
      <rect width="100%" height="100%" />
      <g style="transform: scaleY(0.5) scaleX(0.5) rotate(<?php echo $key ?>0deg);">
        <?php echo showArray($value2); ?>
      </g>
    <?php } else { ?>
      <g style="transform: scaleY(0.5) scaleX(0.5) rotate(<?php echo $key ?>0deg);">
        <rect width="100%" height="100%" />
      </g>
      <?php
    }
  }
}
?>
<svg fill="rgba(0,0,0,0)" stroke="green" stroke-width="5">
  <?php showArray($createArray);?>
</svg>
