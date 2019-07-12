@include('includes.menu_post')




<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>




<div class="" style="background-color: white; padding: 0em; width: 100%; height: 200px;">





<link rel="stylesheet" href="{{ URL::asset('js/FlexiJsonEditor/jsoneditor.css') }}"/>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<br>
<div class="container-fluid">
  <div class="row">

  <?php function ivan($SubAsset){?>
    <?php foreach($SubAsset as $key => $value){?>
      @if (is_array($value))

        <div class="col-sm-3 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <a href="{{$value['url']}}">
                {{$key}} <span class="g-resp-sm-hide">+</span>
              </a>
            </div>

            <div class="panel-body">
              <div class="row">
                <?php ivan($value); ?>
              </div>
            </div>

          </div>
        </div>

      @else
        @if ($key !== "url")
          <div class="col-sm-3 col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <a href="{{$value}}">
                  {{$key}}
                </a>
              </div>
            </div>
          </div>
        @endif
      @endif
    <?php }?>
  <?php }?>
  <?php ivan($PostList) ?>
  </div>
</div>





  <?php
  if (isset($VSiteHeader)) {
    echo $VSiteHeader;
  }

  if (isset($VPgCont["rich.txt"])) {
    echo $VPgCont["rich.txt"];
  }
  ?>

</div>
