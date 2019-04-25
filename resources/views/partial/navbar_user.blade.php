<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper white">
      <div class="container">
      <a href="{{url('/')}}" class="brand-logo logo-font"> <img src="{{ asset('img/logo.png') }}" width="200"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>
        </li>
        @guest
          <li>
            <a href="{{route('login')}}" class="modal-trigger teal-text text-lighten-1">
              <i class="material-icons left">person</i>LOGIN
            </a>
          </li>
          <li>
            <a href="{{route('register')}}" class="white-text text-lighten-1 btn  hoverable">
              <i class="material-icons left">person_add</i>REGISTER</a>
          </li>
        @else
         <li>
            <a href="{{route('list.favorit',Auth::user()->username)}}" class="white-text text-lighten-1 btn pink darken-2" style="border-radius:100px;">
              <i class="material-icons right">favorite</i>List Favorite</a>
          </li>
          <li>
            <a href="{{route('anime.recommendation')}}" class="white-text text-lighten-1 btn teal white-text darken-1" style="border-radius:30px;">
              <i class="material-icons right">featured_play_list
</i> Rekomendasi </a>
          </li>
          <li>
            <a href="#" class="dropdown-trigger modal-trigger teal-text text-lighten-1 btn white z-depth-0" data-target="dropdown2">
              <i class="material-icons left">person</i><i class="material-icons right">arrow_drop_down</i>{{strtoupper(Auth::user()->username)}}
            </a>
          </li>
        @endguest
      </ul>
    </div>
    </div>
  </nav>
</div>

<ul id='dropdown2' class='dropdown-content'>
  <li>
    <a href="{{url('/edit')}}">Account <i class="material-icons right">settings</i></a>
  </li>
  <li>
    <a href="{{route('logout')}}">Logout <i class="material-icons right">vertical_align_bottom</i></a>
  </li>
</ul>



<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
     var elems = document.querySelectorAll('.dropdown-trigger');
     var instances = M.Dropdown.init(elems);
   });
</script>