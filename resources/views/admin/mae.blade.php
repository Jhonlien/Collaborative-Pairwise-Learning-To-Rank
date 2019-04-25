@extends('master.master_admin')
@section('pageTitle', 'Pengujian MAE')
@section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
<div class="row">
		<div class="col-xl-11 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">MAE ( Mean Absolute Error )</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <table id="data-komen" class="table">
				<thead class="thead-light">
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Anime ID</th>
                            <th scope="col">MAE</th>
                        </tr>
                </thead>
                <tbody>
                        @foreach($total as $to)
                            <tr>
                                <td scope="col" style="height:10px;">
                                    @foreach($to as $item)
                                        
                                            {{ $item['user_id']}}<br>  
                                        
                                    @endforeach
                                </td>
                                <td scope="col" style="height:10px;">
                                    @foreach($to as $item)
                                        {{ $item['anime_id']}}<br>  
                                    @endforeach
                                </td>
                                <td scope="col" style="height:10px;">
                                    @foreach($to as $item)
                                        {{ $item['mae']}}<br>  
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
			</table>
            </div>
          </div>
		</div>
</div>
<div class="container-fluid  mt--12" style="margin-bottom: 50px; padding: 10px;">
<div class="row">
		<div class="col-xl-11 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">Rata-rata MAE ( Mean Absolute Error )</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <table id="data-komen" class="table">
				<thead class="thead-light">
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">MAE</th>
                        </tr>
                        @foreach($hasil as $key => $tot)
                        <tr>
                        
                            <td scope="col">{{$tot['user_id']}}</td>
                            <td scope="col">{{$tot['rata_error']}}</td>
                        </tr>
                        @endforeach
				</thead>
                <tfoot>
                        <tr class="thead-light"> 
                            <th> Rata Rata : </th>
                            <th> {{$has}}</th>
                        </tr>
                </tfoot>
			</table>
            </div>
          </div>
		</div>
</div>
@endsection