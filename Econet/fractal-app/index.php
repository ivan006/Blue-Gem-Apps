<?php
$nth_degree = array(
  1,
  2,
  3,
  4,

);

function createArray($nth_degree){

  foreach($nth_degree as $key => $value2){
    $fractal[$key ] = $nth_degree;
  }
  return $fractal;
}




function overlay_patern1($key){
  ob_start();
  ?><g style="transform: scaleY(0.5) scaleX(0.5); rotate(<?php $key ?>0deg);"><?php
  return ob_get_contents();
  ob_end_clean();
}




function overlay_patern2(){
  ob_start();
  ?></g><?php
  return ob_get_contents();
  ob_end_clean();
}



function shape($key){
  ob_start();
  ?><rect width="100%" height="100%" /><?php
  return ob_get_contents();
  ob_end_clean();
}

function showArray($fractal){

  foreach($fractal as $key => $value2){

    if (is_array($value2)) {
      // echo $key;
      return shape($key).overlay_patern1($key).showArray($value2).overlay_patern2();

    } else {
      // echo $key;
      return overlay_patern1($key).shape($key).overlay_patern2();
    }


  }
}

?>
<style media="screen">
  .tr-sc-y-p5 {
    transform: scaleY(0.5);
  }
  .tr-sc-x-p5 {
    transform: scaleX(0.5);
  }
</style>
<?php
// echo "<pre>";
// var_dump(createArray($nth_degree));
// echo "</pre>";
  ?>
<svg width="400" height="110"  fill="rgba(0,0,0,0)" stroke="green" stroke-width="5">
  <?php showArray(createArray($nth_degree));?>
</svg>
