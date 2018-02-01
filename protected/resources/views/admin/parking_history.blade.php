@extends('layouts.admin')

{{-- PANEL --}}
@section('panel', 'Parking History')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endpush

{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Parking History</li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="parking">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h6 class="panel-title">Parking History</h6>

			<div class="heading-elements">
				<form class="heading-form" action="#">
					<div class="form-group">
						<select class="select" name="filter">
							<option {!! request()->show == 'day' ? 'selected' : '' !!} value="day">Per Day</option>
							<option {!! request()->show == 'month' ? 'selected' : '' !!} value="month">Per Month</option>
							<option {!! request()->show == 'year' ? 'selected' : '' !!} value="year">Per Year</option>
							<option {!! request()->show == 'all' ? 'selected' : '' !!} value="all">All Time</option>
						</select>
					</div>
				</form>
			</div>
		</div>
		<table class="table" id="table-parking">
			<thead>
				<tr>
					<th>Vehicle Detail</th>
					<th>User</th>
					<th>Check In</th>
					<th>Check Out</th>
					<th>Price (h)</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($parking_histories as $parking_history)
				<tr>
					<td>
						<div class="media-left">
							<div class=""><a href="#" class="text-default text-semibold">{{ strtoupper($parking_history->vehicle->number) }}</a></div>
							<div class="text-muted text-size-small">
								{{ strtoupper($parking_history->vehicle->type." / ".$parking_history->vehicle->color) }}
							</div>
						</div>
					</td>
					<td>{{ $parking_history->user->name }}</td>
					<td>{{ date('d F Y, H:i', strtotime($parking_history->check_in)) }}</td>
					<td>{{ date('d F Y, H:i', strtotime($parking_history->check_out)) }}</td>
					<td>Rp{{ number_format($parking_history->parking_lot->price) }}.-</td>
					@php
					$total = round(abs(strtotime($parking_history->check_out) - strtotime($parking_history->check_in)) / 3600)*$parking_history->parking_lot->price;

					if ($total == 0)
						$total = $parking_history->parking_lot->price;
					elseif ($parking_history->check_out == null)
						$total = 0;
					@endphp
					<td>Rp{{ number_format($total) }},-</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript">
	$(function() {
		$('#table-parking').dataTable();
		$('.select').select2({
			minimumResultsForSearch: Infinity,
			width: 150
		}).on('change', function() {
			window.location.href = URL+'authorization/parking_history?show='+$(this).val();
		});
	})
</script>
@endpush