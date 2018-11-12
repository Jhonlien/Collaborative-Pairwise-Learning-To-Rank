<div class="row teal darken-1 z-depth-1" style="padding: 20px;" id="list">
  <div class="container">
  <div class="col s6">
  <nav>
    <div class="nav-wrapper white">
      <form action="{{ route('anime.search') }}" method="post">
        {{csrf_field()}}
        <div class="input-field teal-text text-lighten-1 hoverable">
          <input id="search" type="search" id="autocomplete-input" class="autocomplete teal-text" placeholder="Search Here" name="keyword" required>
          <i class="material-icons teal-text">search</i>
        </div>
      </form>
    </div>
  </nav>
</div>
<div class="col s6">
  <div class="right-align">
    <a class='dropdown-trigger btn-large white teal-text' href='#' data-target='dropdown1'><i class="material-icons right">sort</i></a>
    </div>
</div>
</div>
</div>
<ul id='dropdown1' class='dropdown-content'>
  <li>
    <a href="{{url('/anime/more/movie')}}"">Movie</a>
  </li>
  <li>
    <a href="{{url('/anime/more/tv')}}">TV</a>
  </li>
  <li>
    <a href="{{url('/anime/more/ova')}}"">OVA</a>
  </li>
  <li>
    <a href="{{url('/anime/more/asc')}}">ASC Title</a>
  </li>
  <li>
    <a href="{{url('/anime/more/desc')}}">DESC Title</a>
  </li>
</ul>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
     var elems = document.querySelectorAll('.dropdown-trigger');
     var instances = M.Dropdown.init(elems);
   });
</script>