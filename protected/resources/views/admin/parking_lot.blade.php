@extends('layouts.admin')

@push('sec-js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endpush

{{-- PANEL --}}
@section('panel', auth()->user()->mall->name)
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Parking Lot in {{ auth()->user()->mall->name }}</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-connection position-left"></i> Create Promotion</a></li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
@can('setup')
<!-- Basic modal -->
<form id="modal_default" class="modal fade" method="post" action="{{ url('data/parking_lot') }}">
	{{ csrf_field() }}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">ADD NEW PARKING LOT</h6>
			</div>

			<div class="modal-body">
				<div class="well">
					<div class="form-group">
						<label>Mall</label>
						<select class="form-control select-mall" name="mall_id">
							@foreach (App\Mall::all() as auth()->user()->mall)
							<option value="{{ auth()->user()->mall->id }}">{{ auth()->user()->mall->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label>Floor</label>
								<input class="form-control" type="text" name="floor" placeholder="Type floor number">
							</div>

							<div class="col-sm-6">
								<label>Block</label>
								<input class="form-control" type="text" name="block" placeholder="Type block number">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Price</label>
						<input class="form-control" type="number" name="price" placeholder="Input a price">
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</form>
<!-- /basic modal -->
@endcan

<!-- Basic datatable -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title">Parking Lots</h6>
		@can('setup')
		<div class="heading-elements">
			<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_default"><i class="icon-car position-left"></i> ADD NEW PARKING LOT</button>
		</div>
		@endcan
	</div>

	
	<table class="table table-hover table-striped" id="data-parking">
		<thead>
			<tr>
				<th>Floor</th>
				<th>Price</th>
				<th>Status</th>
				<th>Visitor Today</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($parking_lots as $parking_lot)
			<tr>
				<td>
					<div class="media-left media-middle">
						<a href="#"><img src="{{ asset('assets/vector/parking.svg') }}" class="img-xs" alt=""></a>
					</div>
					<div class="media-left">
						<div class=""><a href="#" class="text-default text-semibold">Floor {{ $parking_lot->floor }}<br> Block {{ $parking_lot->block }}</a></div>
					</div>
				</td>
				<td>Rp{{ number_format($parking_lot->price) }}.-</td>
				<td>
					<span class="label {{ $parking_lot->status === 1 ? 'label-success' : 'label-danger' }}">{{ $parking_lot->status === 1 ? 'Active' : 'Non-active' }}</span>
				</td>
				<td>{{ $parking_lot->parking_transactions()->whereDate('booked', date('Y-m-d'))->whereNull('check_out')->count() }} Visitor</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript">
	$(function() {
		$('.select-mall').select2();
		$('#data-parking').dataTable()
	});
</script>
@endpush