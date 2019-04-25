@extends('master.master_user')
@section('content')
<div class="container">
  <div class="row">
    <div class="col s12"> 
      <h5 class="center-align teal-text"> 
      List Favorite <i class="material-icons">favorite</i>
      </h5>
    @foreach($favorite as $key => $animes)
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
@endsection