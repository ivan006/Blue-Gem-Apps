


@include('includes.general-include-one-of-four')


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

@include('includes.general-include-two-of-four')



@include('includes.SmartDataFileItemMenu')
@include('includes.SmartDataFolderItemMenu')
@include('includes.ShallowSmartDataMenu')
@include('includes.encode_decode')

@include('includes.menu_post')

@include('includes.general-include-three-of-four')




<!-- Left Column -->
<div class="w3-col m2">


  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>

<!-- Middle Column -->
<div class="w3-col m8">











  <?php
  if (isset($VSiteHeader)) {
    echo $VSiteHeader;
  }

  if (isset($VPgCont["rich.txt"])) {
    echo $VPgCont["rich.txt"];
  }
  ?>


    <?php foreach($PostList as $key => $value){?>
      <a href="{{$value['url']}}">
        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

          <h2>
            {{$key}}

          </h2>
          <br>

        </div>
      </a>



    <?php }?>






  <br>






  <!-- End Middle Column -->
</div>

<!-- Right Column -->
<div class="w3-col m2">

  <br>

  <!-- End Right Column -->
</div>



@include('includes.general-include-four-of-four')
