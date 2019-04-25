@extends('master.master_user')
@section('content')
@include('partial.carousel')
@include('partial.search_user')
<div class="container">
  <div class="row">
    <div class="col s12"> 
      <h5 class="center-align teal-text"> 
      Anime Type OVA 
      </h5>
    @foreach($anime as $key => $animes)
    <div class="col s3">
      <div class="card medium hoverable" style="height: 500px;">
        <div class="card-image">
          <img src="{{URL::asset($animes->img_url)}}">
        </div>
        <span class="card-title"></span>
        <div class="card-content">
        <h6>{{str_limit($animes->title,$limit = 20, $end ='...')}}</h6>
        <h6 class="teal-text"> <i class="material-icons left teal-text">tv</i>{{$animes->type}}</h6><h6 class="teal-text"><i class="material-icons left teal-text">confirmation_number</i>{{$animes->members}}</h6>
        </div>
        

        <div class="card-action">
          <div class="right-align">
              <a href="{{route('detail.anime',$animes->id)}}" class="btn teal darken-1 right-align"> More</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
   
</div>
</div>
<div class="container">
  <div class="row">
      <div class="center-align">
        <a href="{{url('anime/more/ova')}}" class="btn-large waves-effect waves-white teal darken-2 text-center hoverable"> More Anime <i class="material-icons right">more_horiz</i></a>
      </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col s12"> 
      <h5 class="center-align teal-text"> 
      Anime Type MOVIE 
      </h5>
    @foreach($anime_movie as $key => $animes)
    <div class="col s3">
      <div class="card medium hoverable" style="height: 500px;">
        <div class="card-image">
          <img src="{{URL::asset($animes->img_url)}}">
        </div>
        <div class="card-content">
        <h6>{{str_limit($animes->title,$limit = 20, $end ='...')}}</h6>
        <h6 class="teal-text"> <i class="material-icons left teal-text">tv</i>{{$animes->type}}</h6><h6 class="teal-text"><i class="material-icons left teal-text">confirmation_number</i>{{$animes->members}}</h6>
        </div>
        <div class="card-action">
          <a href="{{route('detail.anime',$animes->id)}}" class="btn teal darken-1"> More</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
<div class="container">
  <div class="row">
      <div class="center-align">
        <a href="{{url('anime/more/movie')}}" class="btn-large waves-effect waves-white teal darken-2 text-center hoverable"> More Anime Type Movie <i class="material-icons right">more_horiz</i></a>
      </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col s12"> 
      <h5 class="center-align teal-text"> 
      Anime Type TV

      </h5>
    @foreach($anime_tv as $key => $animes)
    <div class="col s3">
      <div class="card medium hoverable" style="height: 500px;">
        <div class="card-image">
          <img src="{{URL::asset($animes->img_url)}}">
        </div>
        <div class="card-content">
        <h6>{{str_limit($animes->title,$limit = 20, $end ='...')}}</h6>
        <h6 class="teal-text"> <i class="material-icons left teal-text">tv</i>{{$animes->type}}</h6><h6 class="teal-text"><i class="material-icons left teal-text">confirmation_number</i>{{$animes->members}}</h6>
        </div>
        <div class="card-action">
          <div class="right-align">
          <a href="{{route('detail.anime',$animes->id)}}" class="btn teal darken-1"> More</a>
           </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
<div class="container">
  <div class="row">
      <div class="center-align">
        <a href="{{url('anime/more/tv')}}" class="btn-large waves-effect waves-white teal darken-2 text-center hoverable"> More Anime Type Movie <i class="material-icons right">more_horiz</i></a>
      </div>
  </div>
</div>
@endsection