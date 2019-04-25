@extends('master.master_user')
@section('content')
@include('partial.search_user')
<div class="container">
	<div class="row">
		<div class="col 12">
			<h5>Hasil Pencarian "<b>{{$query}}</b>"</h5>
			@if(count($search)>0)
			@foreach($search as $key=>$animes)
			<div class="col s3">
		      <div class="card medium hoverable" style="height: 500px;">
		        <div class="card-image">
		        @if($animes->img_url == 'null')
		        	<img src="{{ asset('image/'.$animes->gambar.'') }}">
		        @else
		        	<img src="{{URL::asset($animes->img_url)}}">
		        @endif	
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
		    @else
		     <p style="margin-bottom: 160px;">Anime tidak ditemukan</p>
		    @endif
		</div>
	</div>
</div>
@endsection