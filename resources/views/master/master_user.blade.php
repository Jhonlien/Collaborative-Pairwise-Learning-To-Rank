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
		@include('partial.footer')
		@yield('script')
	</body>

	<script type="text/javascript">
	  $(window).on('load',function(){
	    setTimeout(function(){
	          $('.loader').fadeOut(500);
	    }, 200);
	  });
	</script>
</html>