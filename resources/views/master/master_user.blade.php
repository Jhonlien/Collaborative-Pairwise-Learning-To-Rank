<!DOCTYPE html>
<html>
	<head>
		<title>My Anime - Your Recommendation Anime</title>
	</head>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.min.css') }}"  />
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
<link rel="icon"   type="image/x-icon" href="{{ asset('img/logo1_oyA_icon.ico') }}" />

<link rel="stylesheet" href="{{ url('https://use.fontawesome.com/releases/v5.3.1/css/all.css') }}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/icon?family=Material+Icons') }}">
<script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript" src="{{url('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js')}}"></script>	
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<body>
		@include('partial.navbar_user')
		<div class="loader"></div>
		@include('sweetalert::alert')
			@yield('content')
			@guest


			@else
			<div class="fixed-action-btn">
				  <a class="btn-floating btn-large teal darken-2">
				    <i class="large material-icons">mode_edit</i>
				  </a>
				  <ul>
				    <li><a class="btn-floating teal darken-1 tooltipped modal-trigger" data-position="top" data-tooltip="Tambah Anime" href="#modal_add_users"><i class="material-icons">add</i></a></li>
				    <li><a href="{{route('manage', Auth::user()->username)}}" class="btn-floating green tooltipped" data-position="top" data-tooltip="Kelola"><i class="material-icons">assignment</i></a></li>
				    <!-- <li><a class="btn-floating blue tooltipped" data-position="top" data-tooltip="Kritik & Saran"><i class="material-icons">comment</i></a></li> -->
				  </ul>
			</div>
			@endguest
				<!-- Modal Structure -->
				<div id="modal_add_users" class="modal modal-fixed-footer">
				<div class="modal-content">
				  <h4 class="teal-text lighten-2">Tambah Anime <i class="material-icons">add</i></h4>
				  <div class="row">
				  <form action="{{route('anime.add')}}" method="POST" enctype="multipart/form-data">
				  	{{ csrf_field() }}
				  	<div class="input-field col s9">
				      <input type="text" class="validate" name="title" autofocus required>
				      <label class="active">Title Anime</label>
				    </div>
				    <input type="hidden" name="img_url" value="null">
				    <input type="hidden" name="episode" value="0">
				    <input type="hidden" name="members" value="0">
				    <div class="input-field col s9">
					  <select name="type">
					    <option>Type</option>
					    <option value="TV">Tv</option>
					    <option value="Movie">Movie</option>
					    <option value="OVA">Ova</option>
					    <label>Type</label>
					  </select>
					</div>
					<div class="input-field col s9">
					  <select name="genre">
					    <option>Genre</option>
					    <option value="Action">Action</option>
					    <option value="Adventure">Adventure</option>
					    <option value="Comedy">Comedy</option>
					    <option value="Drama">Drama</option>
					    <option value="Mystery">Mystery</option>
					    <option value="Horor">Horor</option>
					    <option value="Martial-Arts">Martial-Arts</option>
					    <option value="Sci-Fi">Sci-Fi</option>
					  </select>
					  	<label>Genre</label>
					  </div>
					  <div class="file-field input-field col s9">
				      <div class="btn">
				        <span>File</span>
				        <input type="file" name="gambar">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Upload Anime Image">
				      </div>
				    </div>
				  
				  </div>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn">Upload <i class="material-icons right">file_upload</i>
</button>
				</div>
				</form>
				</div>
		@include('partial.footer')
		@yield('script')
	</body>

	<script type="text/javascript">
	  $(window).on('load',function(){
	    setTimeout(function(){
	          $('.loader').fadeOut(500);
	    }, 200);
	  });
	  document.addEventListener('DOMContentLoaded', function() {
	    	var elems = document.querySelectorAll('.fixed-action-btn');
	    	var instances = M.FloatingActionButton.init(elems,{direction:'left'});
	    	var elems2 = document.querySelectorAll('.tooltipped');
	    	var instances2 = M.Tooltip.init(elems2);
	    	var elems3 = document.querySelectorAll('.modal');
    		var instances3 = M.Modal.init(elems3);
    		var elems4 = document.querySelectorAll('select');
    		var instances4 = M.FormSelect.init(elems4);
  		});	

  </script>
</html>