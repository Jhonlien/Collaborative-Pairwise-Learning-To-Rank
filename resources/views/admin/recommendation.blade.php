@extends('master.master_admin')
@section('pageTitle', 'Manage Anime')
@section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
<a href="{{route('update.recommendation')}}" class="btn btn-lg btn-secondary" style="margin-bottom: 10px;">Update Recommendation &nbsp;&nbsp;<i class="fas fa-sync-alt"></i></a>
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
             <table id="data-recom" class="table">
				<thead class="thead-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Members</th>
                            <th scope="col">Type</th>
                            <th scope="col">Episode</th>
                            <th scope="col">Value</th>
                            <th scope="col">Rating</th>
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
		$('#data-recom').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax : '{{ route('data.recommendation.json')}}',
	        columns: [
	            { data: 'title', name: 'title', orderable: false  },
	            { data: 'members', name: 'members', orderable: false  },
	            { data: 'type', name: 'type', orderable: false  },
                { data: 'episode', name: 'episode', orderable: false  },
                { data: 'value', name: 'value'},
                { data: 'rating', name: 'rating'},
            ]
	    });
        $("#example_paginate").removeClass('paginate_button').addClass('btn-sm');
        $('#example_filter').addClass('form-group');
        $('input').addClass('form-control form-control-alternative');
        $('select').addClass('form-control form-control-alternative');
});
</script>
@endsection