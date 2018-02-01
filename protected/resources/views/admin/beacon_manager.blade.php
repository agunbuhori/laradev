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
@section('panel', 'Beacon Manager')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Beacon Manager</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-connection position-left"></i> Create Promotion</a></li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="beacon">
	<form method="post" :action="activeUrl" id="modal_animation" class="modal fade">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT" v-if="editStatus">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<h5 v-if="! editStatus" class="panel-title">Install New Beacon</h5>
					<h5 v-if="editStatus" class="panel-title">Edit Beacon</h5>
				</div>

				<div class="modal-body">

					<div class="well">
						<div class="form-group">
							<label>Mall</label>
							<select class="form-control select-mall" name="mall_id">
								@foreach (App\Mall::all() as $mall)
								<option value="{{ $mall->id }}">{{ $mall->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label>Name</label>
							<input class="form-control" name="name" placeholder="Type beacon name" required="required" :value="beacon.name">
						</div>

						<div class="form-group">
							<label>UUID</label>
							<input class="form-control" name="uuid" placeholder="Type beacon UUID" required="required" :value="beacon.uuid">
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Major</label>
									<input class="form-control" type="number" name="major" placeholder="Type beacon major" :value="beacon.major">
								</div>

								<div class="col-sm-6">
									<label>Minor</label>
									<input class="form-control" type="number" name="minor" placeholder="Type beacon minor" :value="beacon.minor">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Y Position</label>
									<input class="form-control" name="location_vertical" placeholder="Vertical position" :value="beacon.location_vertical">
								</div>

								<div class="col-sm-6">
									<label>X Position</label>
									<input class="form-control" name="location_horizontal" placeholder="Horizontal position" :value="beacon.location_horizontal">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Color</label>
							<select class="selectbox" name="color">
								<option value="blue" data-iconurl="{{ asset('assets/vector/beacon_blue.svg') }}">
									Blue
								</option>
								<option value="green" data-iconurl="{{ asset('assets/vector/beacon_green.svg') }}">
									Green
								</option>
								<option value="purple" data-iconurl="{{ asset('assets/vector/beacon_purple.svg') }}">
									Purple
								</option>
							</select>
						</div>
					</div>	

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" v-if="! editStatus"><i class="icon-check position-left"></i> INSTALL</button>
					<button type="submit" class="btn btn-success" v-if="editStatus"><i class="icon-check position-left"></i> UPDATE</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /disabled animation -->

	<div class="panel panel-default">
		<div class="panel-heading">
			<h6 class="panel-title">Beacon List</h6>
			<div class="heading-elements">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_animation" @click="addBeacon()"><i class="icon-feed position-left"></i> INSTALL NEW BEACON</button>
			</div>
		</div>

		<table class="table table-striped" id="data-beacon">
			<thead>
				<tr>
					<th>Beacon Detail</th>
					<th>Location</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($beacons as $beacon)
				<tr>
					<td>
						<div class="media-left media-middle">
							<a href="#"><img src="{{ asset('assets/vector/beacon_'.$beacon->color.'.svg') }}" class="img-circle img-xs" alt=""></a>
						</div>
						<div class="media-left">
							<div class=""><a href="#" class="text-default text-semibold">{{ $beacon->name }}</a></div>
							<div class="text-muted text-size-small">
								{{ $beacon->uuid }}
							</div>
						</div>
					</td>
					<td>
						<div class="media-left">
							<div class=""><a href="#" class="text-default text-semibold">{{ $beacon->mall->name or $beacon->merchant->brand." ".$beacon->merchant->mall->name }}</a></div>
							<div class="text-muted text-size-small">
								Floor {{ $beacon->location_vertical }}, Block {{ $beacon->location_horizontal }}
							</div>
						</div>
					</td>
					<td>
						@if ($beacon->status === 1)
						<span class="label bg-success">Active</span>
						@else
						<span class="label bg-danger">Disabled</span>
						@endif
					</td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropup">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#" data-toggle="modal" data-target="#modal_animation" @click.prevent="editBeacon({{ $beacon }})"><i class="icon-pencil4"></i> Edit</a></li>
									@if ($beacon->status === 1)
									<li><a href="#" @click.prevent="switchBeacon($event, {{ $beacon->id }})"><i class="icon-minus-circle2"></i> Turn off</a></li>
									@else
									<li><a href="#" @click.prevent="switchBeacon($event, {{ $beacon->id }})"><i class="icon-check"></i> Turn on</a></li>
									@endif
									<li class="divider"></li>
									<li>
										<a href="#" @click.prevent="deleteBeacon($event, {{ $beacon->id }})"><i class="icon-trash"></i> Delete</a>
									</li>
								</ul>
							</li>
						</ul>
					</td>
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
		$('#data-beacon').dataTable({
			columnDefs: [{ 
				orderable: false,
				width: '100px',
				targets: [ 3 ]
			}],
		});
		$('.select-mall').select2();
		$(".selectbox").selectBoxIt({
	        autoWidth: false
	    });
	});

	var beacon = new Vue({
		el: '#beacon',
		data: {
			editStatus: false,
			beacon: {},
			activeUrl: URL+'data/beacon'
		},
		mounted: function() {

		},
		methods: {
			addBeacon() {
				this.beacon = {};
				this.editStatus = false;
				this.activeUrl = URL+'data/beacon';
			},
			editBeacon(beacon) {
				this.beacon = beacon;
				this.editStatus = true;
				this.activeUrl = URL+'data/beacon/'+beacon.id;

				const _this = this;
				$('.select-mall').val(beacon.mall_id).trigger('change').on('change', function() {
					_this.$emit('input', this.value);
				});
			},
			deleteBeacon(event, id) {
				event.preventDefault();
				if (confirm("Are you sure?"))
					axios.post(URL+'data/beacon/'+id, {_method: 'DELETE'}).then(() => {
						$(event.target).parents('tr').remove();
					});
			},
			switchBeacon(event, id) {
				event.preventDefault();
				axios.post(URL+'data/beacon/switch/'+id).then(function() {
					location.reload();
				});
			}
		}
	});
</script>
@endpush