@extends('master.master_user')
@section('content')
@include('partial.search_user')
<div class="container">
	<div class="row">
		<div class="col 12">
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
@endsection