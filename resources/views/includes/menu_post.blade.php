

  <link href="{{ asset('css/menu-style.css') }}" rel="stylesheet">


    <div  class="f-multi-level-dropdown f-bg-col-blu f-fon-18px f-fon-fam-open ">
      <ul>
        <li>
          <a  href="{{ route('Network.show') }}">Home
          </a>
        </li>
        <li>
          <div class="toggle">
          <a href="#">
            Mode
          </a>
          <ul>
            <li>
              <a  href=""><del>Create</del>
              </a>
            </li>
            <li>
              <a  href="{{ $allURLs['sub_post_read'] }}">Show
              </a>
            </li>
            <li>
              <a  href=""><del>Destroy</del>
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
