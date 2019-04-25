@section('content')
@include('asset.asset')
@if ($message = Session::get('success'))
<script type="text/javascript">
	 Materialize.toast("{{ $message }}", 5000);  
</script>
@endif
@endsection