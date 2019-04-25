@extends('master.master_admin')
@section('pageTitle', 'Dashboard')
@section('content')
@include('sweetalert::alert')
    <div class="header bg-gradient-custom pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">User Registered</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count_user }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-default text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Anime</h5>
                      <span class="h2 font-weight-bold mb-0">{{$count_anime}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                       <i class="fas fa-list-ul"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Komentar</h5>
                      <span class="h2 font-weight-bold mb-0">{{$count_comment}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-comments"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--8">
      <div class="row mt-5">
        <div class="col-xl-7 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">User Registered ({{$count_user}})</h3>
                </div>
                <div class="col text-right">
                  <a href="{{route('dataProcessing')}}" class="btn btn-lg btn-success">See all {{$count_user}} Users</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user as $key=>$users)
                  <tr>
                    <th scope="row">
                      {{$users->id}}
                    </th>
                    <td>
                      {{$users->username}}
                    </td>
                    <td>
                      {{$users->email}}
                    </td>
                   </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Anime Commented {{$count_comment}} </h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-success">See all {{$count_comment}} Commented</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  	<th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Username</th>
                    <th scope="col">Comment</th>
                  </tr>
                </thead>
                <tbody>
                	
               	<?php
               		$no = 0;
               	?>
                @foreach($comment as $key => $comments)
                  <tr>
                    <th scope="row">
                     <?php
                     	$no++;
                     ?>
                     {{$no}}
                    </th>
                    <td>
                    	{{str_limit($comments->title,$limit = 10,$end ='...') }}
                    </td>
                    <td>
                      {{$comments->username}}
                    </td>
                    <td>
                      {{$comments->comment}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

       <div class="row mt-5" style="margin-bottom: 50px;">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Animes ({{$count_anime}})</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-lg btn-success">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Episode</th>
                    <th scope="col">Members</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Favorit</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                	$nom = 0;
                ?>
                @foreach($anime as $key=>$animes)
                  <tr>
                    <th scope="row">
                      <?php
                      $nom++;
                      ?>
                      {{$nom}}
                    </th>
                    <td>
                      {{$animes->id}}
                    </td>
                    <td>
                      {{$animes->title}}
                    </td>
                    <td>
                      {{$animes->type}}
                    </td>
                    <td>
                      {{$animes->episode}}
                    </td>
                    <td>
                      {{$animes->members}}
                    </td>
                    <td>
                      {{$animes->genre}}
                    </td>
                      <td>
                        {{$animes->rating}}
                      </td>
                    <td>
                      {{$animes->fav}}
                    </td>
                  </tr>
                 @endforeach 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
       <div class="row mt-5" style="margin-bottom: 50px;">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">User Uploads ({{$count_anime}})</h3>
                </div>
                
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Episode</th>
                    <th scope="col">Members</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $nom = 0;
                ?>
                @foreach($user_uploads as $key=>$animes)
                  <tr>
                    <th scope="row">
                      <?php
                      $nom++;
                      ?>
                      {{$nom}}
                    </th>
                    <td>
                      {{$animes->id}}
                    </td>
                    <td>
                      {{$animes->title}}
                    </td>
                    <td>
                      {{$animes->type}}
                    </td>
                    <td>
                      {{$animes->episode}}
                    </td>
                    <td>
                      {{$animes->members}}
                    </td>
                    <td>
                      {{$animes->genre}}
                    </td>
                    <td>
                      <a href="{{route('delete.animes',$animes->id)}}" class="btn-sm btn-warning" onclick="return confirm()"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                 @endforeach 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection