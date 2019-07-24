
<div class="w3-top g-pos-uns">
  <div class="w3-bar w3-theme-d2 w3-left-align w3-large">


    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notifications">
        Network
      </button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a class="w3-bar-item w3-button" href="{{ route('Post.index') }}">Show</a>
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
    </div>
  </div>
</div>
