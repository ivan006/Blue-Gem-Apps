


@include('includes.base-dom/general-include-one-of-four')

<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">



@include('includes.base-dom/general-include-two-of-four')



@include('includes.SmartDataFileItemMenu')
@include('includes.SmartDataFolderItemMenu')
@include('includes.ShallowSmartDataMenu')
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
<style media="screen">
/* stuf */
.f-treeview li.f-leaf {
  list-style-image: url('https://www.w3.org/TR/wai-aria-practices/examples/treeview/treeview-1/images/file.png');
}
.f-treeview li {
  list-style-image: url('https://www.w3.org/TR/wai-aria-practices/examples/treeview/treeview-1/images/closed.png');
}
/* stuf */


</style>







        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

          <h2>
            Groups

          </h2>

          <div class="f-treeview">
            <ul>
              <li>
                Harmonyville.net
                <?php echo SmartDataFolderItemMenu('hey - Copy',$SmartDataItemM_ShowActions); ?>
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
