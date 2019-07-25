

  <link href="{{ asset('css/menu-style.css') }}" rel="stylesheet">
    <!-- <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications">
        Network
      </button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a class="w3-bar-item w3-button"> </a>
      </div>
    </div>
    <div class="w3-dropdown-hover w3-hide-small">
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
