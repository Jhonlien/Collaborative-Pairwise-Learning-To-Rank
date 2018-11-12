@extends('master.master_user')
@section('content')

<style type="text/css">
  
 form .stars {
  width:150px;
  background: url("{{ asset('img/stars.png') }}") repeat-x 0 0;
  margin: 0 auto;
}

form .stars input[type="radio"] {
  position: absolute;
  opacity: 0;
  filter: alpha(opacity=0);
}
form .stars input[type="radio"].star-5:checked ~ span {
  width: 100%;
}
form .stars input[type="radio"].star-4:checked ~ span {
  width: 80%;
}
form .stars input[type="radio"].star-3:checked ~ span {
  width: 60%;
}
form .stars input[type="radio"].star-2:checked ~ span {
  width: 40%;
}
form .stars input[type="radio"].star-1:checked ~ span {
  width: 20%;
}
form .stars label {
  display: block;
  width: 30px;
  height: 30px;
  margin: 0!important;
  padding: 0!important;
  text-indent: -999em;
  float: left;
  position: relative;
  z-index: 10;
  background: transparent!important;
  cursor: pointer;
}
form .stars label:hover ~ span {
  background-position: 0 -30px;
}
form .stars label.star-5:hover ~ span {
  width: 100% !important;
}
form .stars label.star-4:hover ~ span {
  width: 80% !important;
}
form .stars label.star-3:hover ~ span {
  width: 60% !important;
}
form .stars label.star-2:hover ~ span {
  width: 40% !important;
}
form .stars label.star-1:hover ~ span {
  width: 20% !important;
}
form .stars span {
  display: block;
  width: 0;
  position: relative;
  top: 0;
  left: 0;
  height: 30px;
  background: url("{{ URL::asset('img/stars.png') }}") repeat-x 0 -60px;
  -webkit-transition: -webkit-width 0.5s;
  -moz-transition: -moz-width 0.5s;
  -ms-transition: -ms-width 0.5s;
  -o-transition: -o-width 0.5s;
  transition: width 0.5s;
}
</style>
    <div class="row margin-top"> 	
    <div class="container">
    <nav>
    <div class="nav-wrapper teal">
      <div class="col s11">
        <a href="{{url('/')}}" class="breadcrumb">Anime</a>
        <a href="#!" class="breadcrumb">{{$detail->title}}</a>
      </div>
    </div>
  </nav>
  </div>
  </div>
  <div class="row">
  	<div class="container">
  		<div class="col s12 z-depth-1 nav-wrapper" style="border-radius: 10px;">
  		<div class="col s8 ">
  			<h5>{{$detail->title}}</h5>
  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  			<b> Genre : </b> <span class="chip teal white-text">{{$detail->genre}}</span>
        <b>Type : </b> <span class="chip">{{$detail->type}} </span><br><br>
        <div class="col s2 teal-text">
          <i class="material-icons left">message</i>
          {{$count_comment}}
        </div>
        <div class="col s2 red-text">  
          <i class="material-icons left">favorite</i>
          {{$count_favorit}}
        </div>
        <div class="col s2 orange-text darken-4">  
          <i class="material-icons left">star</i>
          {{$rating}}
        </div>

        <br><br> 
        <form action="{{route('anime.favorit', $detail->id)}}" method="POST">
          {{ csrf_field() }}
          <button type="submit" class="white-text text-lighten-1 btn-large red darken-4" style="width: 350px;">
              Add To Favorite  <i class="material-icons right">favorite</i>
           </button>
        </form> <br>
        <a href="#modal1" class="modal-trigger white-text text-lighten-1 btn-large yellow darken-3 " style="width: 350px;"> Rate Anime <i class="material-icons right">star</i></a>
  		</div>
  		<div class="col s4">
  			<div class="right-align margin-top margin-bott">
  			<img src="{{URL::asset($detail->img_url)}}" width="300" id="myImg">
  			</div>
  		</div>
  		</div>
  	</div>
  </div>

  <!---Modal-->
  <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>

  <div id="modal1" class="modal">
    <div class="modal-content">
      <h5>Beri Rating Anime : </h5>
      <p> {{$detail->title}}</p>
      <form id="ratingsForm" class="left-align" action="{{ route('anime.rating',$detail) }}" method="POST">
        {{csrf_field()}}
          <div class="stars">
              <input type="radio" name="rating" class="star-1" id="star-1" value="1" />
              <label class="star-1" for="star-1">1</label>
              <input type="radio" name="rating" class="star-2" id="star-2" value="2" />
              <label class="star-2" for="star-2">2</label>
              <input type="radio" name="rating" class="star-3" id="star-3" value="3" />
              <label class="star-3" for="star-3">3</label>
              <input type="radio" name="rating" class="star-4" id="star-4" value="4" />
              <label class="star-4" for="star-4">4</label>
              <input type="radio" name="rating" class="star-5" id="star-5" value="5" />
              <label class="star-5" for="star-5">5</label>
              <span></span>
          </div>
          <br>
          <center>
            <button class=" btn-large yellow darken-3" type="submit">Rate</button>
          </center>
      </form>
    </div>
  </div>
<!--end Modal -->

<div class="row">
<div class="container">
  <div class="col s12 nav-wrapper z-depth-0">
  <div class="col s6">
    <h5> Comment &nbsp;<i class="material-icons">message</i></h5>
    <ul class="collection">
    @forelse($comment as $key => $komen)
          <li class="collection-item avatar">
          <div class="circle grey darken-1 center-align"> <h6 style="margin-top: 10px; color: white"> {{ str_limit($komen->username, 2, '') }}</h6></div>
          <span class="title">{{$komen->username}}</span>
          <p>{{$komen->comment}}</p>
          <a href="#!" class="secondary-content"><i class="material-icons">message</i></a>
        </li>
    @empty
      <p style="margin-left:10px;">No Comments Yet</p>
    @endforelse
    </ul> 
  </div>
  <div class="col s6">
      <h5> Give your Comment &nbsp;<i class="material-icons">edit</i></h5>
      <form class="col s6" method="POST" action="{{route('anime.comment',$detail->id)}}" id="form" style="border:1px solid #ccc; width: 500px; padding: 10px;">
        {{ csrf_field() }}
        <div class="input-field col s12" style="width:450px;">
          <textarea id="textarea2" name="comment" class="materialize-textarea" data-length="120" id="comment"></textarea>
          <label for="textarea2">Comment</label>
        </div>
        <div class="left-align">
            <button class="btn" type="submit" id="send-comment"> send <i class="material-icons right">message</i></button>
        </div>
      </form>
  </div>
  </div>
</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
$(document).ready(function(){ 
  $('.modal').modal();
  $('#form').on('click change keyup',function(){
      if($('#comment').val() == ''){
        $('#send-comment').addClass('disabled');
      }
      else{
        $('#send-comment').removeClass('disabled');
      }
  });
});

</script>

@endsection