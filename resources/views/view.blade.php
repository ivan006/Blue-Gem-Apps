

<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
.g-futuristic-indented-list {
  margin-left: 1em;
  margin-top: 1em;
  border-left: 2px whitesmoke solid;
  padding-left: 1em;
}
.g-bor-gre {
  border: 2px whitesmoke solid;
}
.g-bor-top-0 {
  border-top: 0px ;

}


</style>

@include('includes.menu_post')

<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
</div>
<?php
if (file_exists($ShowBaseIDPlusBaseLocation."/header.php")) {
  // code...

  include($ShowBaseIDPlusBaseLocation."/header.php");
}
?>



<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">

  <?php

  if (!empty($RichDataShow )) {
    echo $RichDataShow ;
  }

  ?>

</div>
