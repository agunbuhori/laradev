@extends('layouts.admin')

{{-- PANEL --}}
@section('panel', 'Parking Lot Panel')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
@endpush

@push('js')
@endpush

{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Dashboard</li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
@php
$parking_lots = App\ParkingLot::select('parking_lots.*', 'parking_lots.status as pstatus')
									->where('mall_id', auth()->user()->mall_id)
									->get();

foreach ($parking_lots as $parking_lot) {
	switch ($parking_lot->pstatus) {
		case 1:
			$parking_lot->status = 'available';
			$parking_lot->class = 'bg-primary-800';
			$parking_lot->icon = 'icon-check';
			break;
		case 2:
			$parking_lot->status = 'booked';
			$parking_lot->class = 'bg-violet-800';
			$parking_lot->icon = 'icon-price-tag2';
			break;
		case 3:
		default:
			$parking_lot->status = 'occupied';
			$parking_lot->class = 'bg-grey-800';
			$parking_lot->icon = 'icon-car';
			break;
	}
}
@endphp

<component id="parking">
	<!-- Primary modal -->
	<div id="modal-detail" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">FLOOR @{{ transaction.floor }} BLOCK @{{ transaction.block }}</h6>
				</div>

				<table class="table">
					<tbody>
						<tr>
							<th>Booked</th>
							<td>: @{{ moment(transaction.booked).format("DD MMMM YYYY, HH:mm") }}</td>
						</tr>
						<tr>
							<th>Vehicle Type/Color</th>
							<td style="text-transform: capitalize;">: @{{ transaction.type+' / '+transaction.color }}</td>
						</tr>
						<tr>
							<th>Plate Number</th>
							<td>: @{{ transaction.number }}</td>
						</tr>
						<tr>
							<th>Check In</th>
							<td>: @{{ moment(transaction.check_in).format("DD MMMM YYYY, HH:mm") }}</td>
						</tr>
						<tr v-if="transaction.check_out != null">
							<th>Check Out</th>
							<td>: @{{ moment(transaction.check_out).format("DD MMMM YYYY, HH:mm") }}</td>
						</tr>
						<tr>
							<th>Vehicle Type</th>
							<td>: Lorem Ipsum dolor sit amet</td>
						</tr>
					</tbody>
				</table>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /primary modal -->

	<div class="row">
		@foreach ($parking_lots as $parking_lot)
		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="panel {{ $parking_lot->class }}">
				<div class="panel-body text-center">
					<div class="icon-object border-white text-white"><i class="{{ $parking_lot->icon }}"></i></div>
					<h5 class="text-semibold"> {{ ucfirst($parking_lot->status) }} </h5>
					<p class="mb-15"></p>
					@if ($parking_lot->status != 'available')
					<button type="button" class="btn bg-primary btn-raised" data-toggle="modal" data-toggle="modal" data-target="#modal-detail" @click="showDetail({{ $parking_lot }})">DETAIL </button>
					@else
					<button type="button" disabled="disabled" class="btn bg-primary btn-raised">DETAIL</button>
					@endif
				</div>
				<div class="panel-footer text-center">
					<strong class="text-default">{{ "FLOOR ".$parking_lot->floor ." / ".$parking_lot->block }}</strong>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript">
	var parking = new Vue({
		el: '#parking',
		data: {
			attr: {},
			transaction: {}
		},
		mounted: function() {

		},
		methods: {
			showDetail(transaction) {
				console.log(transaction);
				this.transaction = transaction;
			},
			getCountDown(date) {
				var now  = moment();
				var then = moment(date).format("DD/MM/YYYY HH:mm:ss");
				var ms = moment(now,"DD/MM/YYYY HH:mm:ss").diff(moment(then,"DD/MM/YYYY HH:mm:ss"));

				return moment(ms).format('mm')-30;
			},
			checkOut(id) {
				axios.post(URL+'data/parking_transaction/'+id, {_method: 'PUT'}).then(() => {
					window.location.href = URL+'authorization/dashboard';
				});
			},
			strtoupper(string) {

			}
		}
	});
</script>
@endpush