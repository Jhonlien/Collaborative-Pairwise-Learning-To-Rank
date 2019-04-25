@extends('master.master_user')
@section('content')
<br><br><br>
<div class="container">
  <div class="row">
      <div class="col s6 white lighten-5 pull-s1"  style="border: 1px solid #EEE;border-top:4px solid #4db6ac;">
        <!-- <div class="" id="box-edit" style="  display: inline-block; width:400px; border: 0px solid #EEE;border-top:4px solid #4db6ac;"> -->
          <h5> Your Favorites </h5>
          <table>
          <thead>
            <tr>
                <th>Title Anime</th>
                <th>Delete </th>
            </tr>
          </thead>
          <tbody>
            @foreach($fav as $key => $c)
            <tr>
              <td><a href="{{route('detail.anime', $c->anime_id)}}" class="teal-text" target="_blank">{{$c->title}}</a></td>
              <td><a href="{{route('delete.favorit.user', $c->fav_id)}}" class="btn red lighten-1">  <i class="material-icons">delete</i></a></td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col s6 white lighten-5" style="border: 1px solid #EEE;border-top:4px solid #4db6ac;">
         <h5> Your Animes</h5>
          <table>
          <thead>
            <tr>
                <th>Title Anime</th>
                <th>Delete</th>
            </tr>
          </thead>
          
          <tbody>
            @foreach($animes as $key => $c)
            <tr>
              <td><a href="{{route('detail.anime', $c->id)}}" class="teal-text" target="_blank">{{$c->title}}</a></td>
              <td><a href="{{route('delete.anime.user', $c->id)}}" class="btn red lighten-1">  <i class="material-icons">delete</i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
  <div class="row">
    <div class="col s6 white lighten-5 pull-s1" style="border: 1px solid #EEE;border-top:4px solid #4db6ac;">
        <h5> Your Comments </h5>
            <table>
          <thead>
            <tr>
                <th>Title Anime</th>
                <th>Comment</th>
                <th>Delete</th>
            </tr>
          </thead>
          
          <tbody>
            @foreach($comment as $key => $c)
            <tr>
              <td><a href="{{route('detail.anime', $c->anime_id)}}" class="teal-text" target="_blank">{{$c->title}}</a></td>
              <td>{{$c->comment}}</td>
              <td><a href="{{route('delete.comment.user',$c->id)}}" class="btn red lighten-1" onclick="return confirm('Are you sure you want to delete this item?');">  <i class="material-icons">delete</i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>
@endsection