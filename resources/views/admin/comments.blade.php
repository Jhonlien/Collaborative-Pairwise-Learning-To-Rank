@extends('master.master_admin')
@section('pageTitle', 'Manage Comments')
@section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
<div class="row">
		<div class="col-xl-11 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">Data Komentar</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <table id="data-komen" class="table">
				<thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Title Anime</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Action</th>
                        </tr>
				</thead>
			</table>
            </div>
          </div>
		</div>
</div>
 @endsection
 @section('script')
<script>
	 $(function() {
		$('#data-komen').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax : '{{ route('data.comment.json')}}',
	        columns: [
	            { data: 'id', name: 'comments.id' },
	            { data: 'username', name: 'users.username', orderable: false  },
	            { data: 'title', name: 'animes.title', orderable: false  },
	            { data: 'comment', name: 'comment', orderable: false  },
	            { data: 'action', name: 'action', orderable: false  }
	            ]
	    });
        $("#example_paginate").removeClass('paginate_button').addClass('btn-sm');
        $('#example_filter').addClass('form-group');
        $('input').addClass('form-control form-control-alternative');
        $('select').addClass('form-control form-control-alternative');
});
</script>
@endsection