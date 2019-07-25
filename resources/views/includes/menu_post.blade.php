<style media="screen">
  .f-fon-18px{
    font-size: 18px;
  }
  .f-fon-fam-open {
    font-family: "Open Sans", sans-serif;
  }
  .f-bg-col-blu {
    color: #fff !important;
    background-color: #4d636f !important;
  }
</style>

    <!-- <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications">
        Network
      </button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a class="w3-bar-item w3-button" </a>
      </div>
    </div> -->
    <!-- <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications">
        Group
      </button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a class="w3-bar-item w3-button" href="{{ $allURLs['sub_post_create'] }}"><del>Create</del></a>
        <a class="w3-bar-item w3-button" href="{{ $allURLs['sub_post_read'] }}">Show</a>
        <a class="w3-bar-item w3-button" href="{{ $allURLs['sub_post_destroy'] }}"><del>Destroy</del></a>
        <a class="w3-bar-item w3-button" href="{{ $allURLs['sub_post_edit'] }}">Edit</a>

      </div>
    </div> -->

    <div  class="f-multi-level-dropdown f-bg-col-blu f-fon-18px f-fon-fam-open ">
      <ul>
        <li>
          <div class="toggle">
            <a href="#">
              Network
            </a>
            <ul>
              <li>
                <a  href="{{ route('Post.index') }}">Show
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <div class="toggle">
          <a href="#">
            Group
          </a>
          <ul>
            <li>
              <a  href="{{ $allURLs['sub_post_create'] }}"><del>Create</del>
              </a>
            </li>
            <li>
              <a  href="{{ $allURLs['sub_post_read'] }}">Show
              </a>
            </li>
            <li>
              <a  href="{{ $allURLs['sub_post_destroy'] }}"><del>Destroy</del>
              </a>
            </li>
            <li>
              <a  href="{{ $allURLs['sub_post_edit'] }}">Edit
              </a>
            </li>
          </ul>
          </div>
        </li>
      </ul>
    </div>
    <!-- <div class="f-multi-level-dropdown">
      <ul>
        [page_list]
        [twig]
        <li>
          <a href="[link]">
            [name]
          </a>
          <span class="toggle">
          <a href="#">+</a>
          <ul>
            [inner_twig]
          </ul>
          </span>
        </li>
        [/twig]
        [leaf]
        <li>
          <a href="[link]">
            [name]
          </a>
        </li>
        [/leaf]
        [/page_list]
      </ul>
    </div> -->




<style>
/*
  .f-multi-level-dropdown ul{list-style:none;padding:0;margin:0;}
  .f-multi-level-dropdown ul li{display:block;position:relative;float:left;background:lightgrey;} */
  /* This hides the dropdowns */
  /* .f-multi-level-dropdown li .toggle ul{display:none;}
  .f-multi-level-dropdown ul li a{display:block;padding:1em;text-decoration:none;white-space:nowrap;color:black;}
  .f-multi-level-dropdown ul .toggle:focus-within{} */


    /* Display the dropdown */
    /* .f-multi-level-dropdown .toggle:focus-within > ul{display:block;position:absolute;}
    .f-multi-level-dropdown .toggle:focus-within li{float:none;}
    .f-multi-level-dropdown .toggle:focus-within a{}
    .f-multi-level-dropdown .toggle:focus-within .toggle:focus-within{}
    .f-multi-level-dropdown > ul li ul li{border-top:0;} */
    /* Displays second level dropdowns to the right of the first level dropdown */
    /* .f-multi-level-dropdown ul ul ul{left:100%;top:0;} */
    /* Simple clearfix */
    /* .f-multi-level-dropdown ul:before, .f-multi-level-dropdown ul:after{content:" "; display:table;}
    .f-multi-level-dropdown ul:after{clear:both;}

  .f-multi-level-dropdown ul {
    display:none;
  }
  .f-multi-level-dropdown { */
    /* display:inline-block; */
  /* }
  .f-multi-level-dropdown >   ul {
    display:inline-block;
    background-color: none;
  } */
</style>
<style>

  .f-multi-level-dropdown ul{list-style:none;padding:0;margin:0;}
  .f-multi-level-dropdown ul li{display:block;position:relative;float:left;background:lightgrey;}
  /* This hides the dropdowns */
  .f-multi-level-dropdown li .toggle ul{display:none;}
  .f-multi-level-dropdown ul li a{display:inline-block;padding:1em;text-decoration:none;white-space:nowrap;color:black;}
  .f-multi-level-dropdown ul .toggle:focus-within{}
  /* Display the dropdown */
  .f-multi-level-dropdown .toggle:focus-within > ul{display:block;position:absolute;}
  .f-multi-level-dropdown .toggle:focus-within li{float:none;}
  .f-multi-level-dropdown .toggle:focus-within a{}
  .f-multi-level-dropdown .toggle:focus-within .toggle:focus-within{}
  .f-multi-level-dropdown > ul li ul li{border-top:0;}
  /* Displays second level dropdowns to the right of the first level dropdown */
  .f-multi-level-dropdown ul ul ul{left:100%;top:0;}
  /* Simple clearfix */
  .f-multi-level-dropdown ul:before, .f-multi-level-dropdown ul:after{content:" "; display:table;}
  .f-multi-level-dropdown ul:after{clear:both;}

.f-multi-level-dropdown ul {
  display:none;
}
.f-multi-level-dropdown >   ul {
  display:block;
}
body{
  margin: 0;
}
</style>




<!-- Navbar on small screens -->
<!-- <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div> -->
