<?php
$nth_degree = array(
  1,
  2,
  3,
  4,
  5,

);

function createArray($nth_degree){

  foreach($nth_degree as $key => $value2){
    $fractal[$key ] = $nth_degree;
  }
  return $fractal;
}
ob_start();
?>

<g  width="50%" height="50%" style="transform: scaleY(0.5) scaleX(0.5);">


<?php
$fractal1 = ob_get_contents();
ob_end_clean();


ob_start();
?>

 </g>

<?php
$fractal2 = ob_get_contents();
ob_end_clean();

ob_start();
?>


   <rect width="100%" height="100%" />

<?php
$fractalinner = ob_get_contents();
ob_end_clean();

function showArray($fractal, $fractalinner, $fractal1, $fractal2){

  foreach($fractal as $key => $value2){



    if (is_array($value2)) {

      echo $fractalinner;
      echo $fractal1;
      showArray($value2, $fractalinner, $fractal1, $fractal2);
      echo $fractal2;

    } else {
      echo $fractalinner;
    }


  }
}

?>
<svg width="400" height="110"  fill="rgba(0,0,0,0)" stroke="green" stroke-width="5">
<?php

echo $fractalinner;
echo $fractal1;

showArray(createArray($nth_degree),$fractalinner, $fractal1, $fractal2);
echo $fractal2;
?>
</svg>
<?php

 ?>
