<?php
// $nth_degree = array(
//   1,
//   2,
//   3,
//   4,
//
// );

// $depth  = 5;
// function createArray($nth_degree){
//
//   foreach($nth_degree as $key => $value2){
//     $fractal[$key ] = $nth_degree;
//   }
//   return $fractal;
// }
//
// function createArray2($nth_degree2, $nth_degree){
//   foreach ($nth_degree2 as $key => $value) {
//     createArray(createArray($nth_degree));
//   }
// }
// $createArray2 = createArray2(5, $nth_degree);


$createArray = array(
  1,
  2,
  3,
  4,
  5,

);
$createArray[0] = $createArray ;

$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);
$createArray[0] = array_merge($createArray,$createArray);


function overlay_patern1($key){
  ob_start();
  ?><g style="transform: scaleY(0.5) scaleX(0.5) rotate(<?php echo $key ?>0deg);"><?php
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
      echo shape($key).overlay_patern1($key).showArray($value2).overlay_patern2();

    } else {
      // echo $key;
      echo overlay_patern1($key).shape($key).overlay_patern2();
    }


  }
}


// echo "<pre>";
// var_dump(createArray($nth_degree));
// echo "</pre>";
  ?>
<svg width="400" height="110"  fill="rgba(0,0,0,0)" stroke="green" stroke-width="5">
  <?php showArray($createArray);?>
</svg>
