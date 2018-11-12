 @extends('master.master_admin')
 @section('pageTitle', 'Manage Users')
 @section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
	<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
		<a href="" class="btn btn-lg btn-secondary" style="margin-bottom: 10px;">Tambah Users &nbsp;&nbsp;<i class="fas fa-plus"></i></a>
		<div class="row">
		<div class="col-xl-8 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">User Registered (22)</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <table id="data-users" class="table align-items-center " style="margin: 0 auto;">
				<thead class="thead-light">
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Created at</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
			</table>
            </div>
          </div>
		</div>
		<div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">User Registered Per month </h3>
                </div>
              </div>
            </div>
            <center>
            	<div id="linechart" style="width:350px; height: 400px">
  				</div>
            </center>
          </div>
        </div>
	</div>
	</div>
@endsection		
@section('script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<style type="text/css">
	table.mySpecialClass {
    border-button: 10px solid #FFFFFF;
}
	.dataTables_length{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_filter{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_info{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_wrapper{
		margin: 10px;
	}
	.dataTables_paginate{
		font-size:14px;
		color: #32325d;
	}
	#example_paginate a:hover{
		background-color: #ccc;
		font-size:14px;
	}
	.form-control{
		float: right;
		margin-left: 10px;
		height: 40px;
	}
	#example_previous a {
  background-color:black;
}

#example_next a {
  background-color:red;
}
.pagination>li>a, .pagination>li>span{
  border:1px solid red !important;
}

</style>
<script type="text/javascript" src="{{url('https://www.gstatic.com/charts/loader.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#data-users').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url":"<?= route('dataProcessing') ?>",
				"dataType":"json",
				"type":"POST",
				"data":{"_token":"<?= csrf_token() ?>"}
			},
			"columns":[
				{"data":"username"},
				{"data":"email"},
				{"data":"created_at"},
				{"data":"action","searchable":false,"orderable":false}
			],

			columnDefs: [
				            {
				                targets: [ 0, 1, 2 ],
				                className: 'mdl-data-table__cell--non-numeric'
				            }
				        ]
			});

        $("#example_paginate").removeClass('paginate_button').addClass('btn-sm');
        $('#example_filter').addClass('form-group');
        $('input').addClass('form-control form-control-alternative');
        $('select').addClass('form-control form-control-alternative');
    });

    var visitor = <?php echo $js; ?>;
      console.log(visitor);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(visitor);
        var options = {
          curveType: 'function',
          legend: { position: 'top' }
        };
        var chart = new google.visualization.PieChart(document.getElementById('linechart'));
        chart.draw(data, options);
      }
</script>

@endsection
