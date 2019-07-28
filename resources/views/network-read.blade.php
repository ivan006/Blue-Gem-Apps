


@include('includes.base-dom/general-include-one-of-four')


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


/* stuf */
.f-treeview li.f-leaf {
  list-style-image: url('https://www.w3.org/TR/wai-aria-practices/examples/treeview/treeview-1/images/file.png');
}
.f-treeview li {
  list-style-image: url('https://www.w3.org/TR/wai-aria-practices/examples/treeview/treeview-1/images/closed.png');
}
/* stuf */
</style>

@include('includes.base-dom/general-include-two-of-four')



@include('includes.item-menus/SmartDataFileItemMenu')
@include('includes.item-menus/SmartDataFolderItemMenu')
@include('includes.item-menus/ShallowSmartDataMenu')
@include('includes.encode_decode')

@include('includes.menu_post')

@include('includes.base-dom/general-include-three-of-four')




<!-- Left Column -->
<div class="w3-col m2">


  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>

<!-- Middle Column -->
<div class="w3-col m8">











  <?php
  // if (isset($VSiteHeader)) {
  //   echo $VSiteHeader;
  // }
  //
  // if (isset($VPgCont["rich.txt"])) {
  //   echo $VPgCont["rich.txt"];
  // }
  ?>


  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>
      Groups

    </h2>

    <div class="f-treeview">
      <ul>
        <li>
          Harmonyville.net
          <ul>
            <?php foreach($PostList as $key => $value){?>
              <li class="f-leaf">
                <a href="{{$value['url']}}">
                  {{$key}}
                </a>
              </li>
            <?php }?>

          </ul>
        </li>
      </ul>
    </div>

    <br>

  </div>






  <br>






  <!-- End Middle Column -->
</div>

<!-- Right Column -->
<div class="w3-col m2">

  <br>

  <!-- End Right Column -->
</div>



@include('includes.base-dom/general-include-four-of-four')
