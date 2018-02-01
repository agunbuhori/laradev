@extends('layouts.admin')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/selectboxit.min.js') }}"></script>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endpush

{{-- PANEL --}}
@section('panel', 'Mall')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="mall_profile">
	<div class="content-group">
		<div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
			<a href="#" class="display-inline-block content-group-sm">
				@php
				if ($mall->picture === null)
					$picture = asset('assets/images/placeholder.jpg');
				else
					$picture= asset('pics/'.$mall->picture);
				@endphp
				<img src="{{ $picture }}" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
			</a>

			<div class="content-group-sm">
				<h5 class="text-semibold no-margin-bottom">
					{{ $mall->name }}
				</h5>

				<span class="display-block">{{ $mall->address }}</span>
			</div>

			<ul class="list-inline no-margin-bottom">
				<li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-phone"></i></a></li>
				<li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-bubbles4"></i></a></li>
				<li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
			</ul>
		</div>

		<div class="panel panel-body no-border-top no-border-radius-top">

		</div>
	</div>

	<div class="tabbable">
		<ul class="nav nav-tabs nav-tabs-bottom">
			@can('setup')
			<li class="active"><a href="#bottom-tab2" data-toggle="tab" aria-expanded="true"><i class="icon-feed position-left"></i> BEACONS</a></li>
			@endcan
			<li class="{{ auth()->user()->role_id == 2 ? 'active' : '' }}"><a href="#bottom-tab1" data-toggle="tab" aria-expanded="true"><i class="icon-store position-left"></i> MERCHANTS</a></li>
			<li><a href="#bottom-tab3" data-toggle="tab" aria-expanded="true"><i class="icon-car position-left"></i> PARKING LOTS</a></li>
			<li><a href="#bottom-tab4" data-toggle="tab" aria-expanded="true"><i class="icon-user position-left"></i> ADMIN</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#basic-tab3" data-toggle="tab">Dropdown tab</a></li>
					<li><a href="#basic-tab4" data-toggle="tab">Another tab</a></li>
				</ul>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane {{ auth()->user()->role_id == 2 ? 'active' : '' }}" id="bottom-tab1">
				<!-- Basic datatable -->
				<div class="panel panel-flat ">
					<table class="table" id="table-merchant">
						<thead>
							<tr>
								<th>Merchant Name</th>
								<th>Beacons</th>
								<th>Promotions</th>
								<th>Registered</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mall->merchants as $merchant)
							<tr>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="{{ asset('assets/vector/grocery.svg') }}" class="img-xs" alt=""></a>
									</div>
									<div class="media-left">
										<div class=""><a href="#" class="text-default text-semibold">{{ $merchant->brand }}</a></div>
										<div class="text-muted text-size-small">
											{{ $merchant->code }}
										</div>
									</div>
								</td>
								<td><span class="text-muted">{{ $merchant->beacons->count() }} Beacons</span></td>
								<td><span class="text-muted">{{ $merchant->beacons->count() }}  Promotions</span></td>
								<td><h6 class="text-semibold">{{ $merchant->created_at }}</h6></td>
								<td><span class="label bg-success-400">ACTIVE</span></td>
								<td>
									<a href="{{ url('data/merchant/'.$merchant->id) }}" class="label label-flat border-primary text-primary-600" @click.prevent="editData()">EDIT</a>
									<a href="{{ url('data/merchant/'.$merchant->id) }}" class="label label-flat border-danger text-danger-600" @click.prevent="deleteData($event)">DELETE</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@can('setup')
			<div class="tab-pane active" id="bottom-tab2">
				<!-- Basic datatable -->
				<div class="panel panel-flat">
					<table class="table" id="table-beacon">
						<thead>
							<tr>
								<th>Beacon Name</th>
								<th>Floor</th>
								<th>Block</th>
								<th>Promotions</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mall->beacons as $beacon)
							<tr>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="{{ asset('assets/vector/bluetooth.svg') }}" class="img-xs" alt=""></a>
									</div>
									<div class="media-left">
										<div class=""><a href="#" class="text-default text-semibold">{{ $beacon->name }}</a></div>
										<div class="text-muted text-size-small">
											{{ $beacon->uuid }}
										</div>
									</div>
								</td>
								<td><span class="text-muted">Floor {{ $beacon->location_vertical }}</span></td>
								<td><span class="text-muted">Block {{ $beacon->location_horizontal }}</span></td>
								<td><spam class="text-semibold">{{ $beacon->broadcasts()->groupBy('promotion_id')->count() }} Items</span></td>
									<td>
										@if ($beacon->status === 1)
										<span class="label bg-success-400">ON</span>
										@else
										<span class="label bg-danger-400">OFF</span>
										@endif
									</td>
									<td>
										<a href="{{ url('data/merchant/'.$merchant->id) }}" class="label label-flat border-primary text-primary-600" @click.prevent="editData()">EDIT</a>
										<a href="{{ url('data/merchant/'.$merchant->id) }}" class="label label-flat border-danger text-danger-600" @click.prevent="deleteData($event)">DELETE</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@endcan

				<div class="tab-pane" id="bottom-tab4">
					<div class="panel panel-default">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($mall->users as $admin)
								<tr>
									<td>{{ $admin->name }}</td>
									<td>{{ $admin->email }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

				<div class="tab-pane" id="bottom-tab3">
					<!-- Basic datatable -->
					<div class="panel panel-default">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>Floor</th>
									<th>Price</th>
									<th>Status</th>
									<th>Visitor Today</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($mall->parking_lots as $parking_lot)
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
									<td>{{ $parking_lot->parking_transactions()->whereDate('check_out', date('Y-m-d'))->count() }} Visitor</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</component>
	@endsection
	{{-- END CONTENT --}}

	@push('vue-js')
	@can('setup')
	<script type="text/javascript">
		$(".selectbox").selectBoxIt({
			autoWidth: false
		});

		mall_profile = new Vue({
			el: '#mall_profile',
			data: {
				beacon: {}
			},
			mounted: function() {

			},
			methods: {
				deleteData(event) {
					event.preventDefault();
					if (confirm("Are you sure?")) {
						axios.post($(event.target).attr('href'), {_method: 'DELETE'}).then(() => {
							$(event.target).parents('tr').remove();
						});
					}
				},
				editBeacon(beacon) {
					this.beacon = beacon;
				},
				disableBeacon(id) {
					if (confirm("Change beacon status?")) {
						axios.post(URL+'data/beacon/disable/'+id).then(() => {
							location.reload();
						});
					}
				}
			}
		});

		$(function () {
			$('#table-merchant').DataTable({
				columnDefs: [{ 
					orderable: false,
					width: '140px',
					targets: [ 5 ]
				}],
			});
			$('#table-beacon').DataTable({
				columnDefs: [{ 
					orderable: false,
					width: '140px',
					targets: [ 5 ]
				}],
			});

		});
	</script>
	@endcan
	@endpush