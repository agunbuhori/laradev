@extends('layouts.admin')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script> --}}
<style type="text/css">
[v-cloak] {
	display: none;
}
.daterangepicker {
	z-index: 99999 !important;
}
.tooltip > * {
	width: 200px !important;
	position: absolute;
	margin-left: 35px;
	top: 50%;
	max-width: 500px;
}
</style>
@endpush

@push('js')
{{-- <script type="text/javascript" src="{{ asset('assets/js/pages/mail_list.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script> --}}
@endpush

{{-- PANEL --}}
@section('panel', 'Beacon')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Beacon</li>
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
	<!-- Basic modal -->
	<form id="edit-beacon" class="modal fade" method="post" :action="URL+'/data/beacon/'+beacon.id" @submit.prevent="updateBeacon($event)">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">BEACON DETAIL</h5>
				</div>

				<div class="modal-body">
					<div class="well">
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" name="name" placeholder="Type beacon name" required="required" :value="beacon.name">
						</div>

						<div class="form-group">
							<label>UUID</label>
							<input class="form-control" :value="beacon.uuid" disabled="disabled">
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Major</label>
									<input class="form-control" type="number" :value="beacon.major" disabled="disabled">
								</div>

								<div class="col-sm-6">
									<label>Minor</label>
									<input class="form-control" type="number" :value="beacon.minor" disabled="disabled">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Y Position</label>
									<input class="form-control" name="location_vertical" placeholder="Vertical position" :value="beacon.location_vertical" required="required">
								</div>

								<div class="col-sm-6">
									<label>X Position</label>
									<input class="form-control" name="location_horizontal" placeholder="Horizontal position" :value="beacon.location_horizontal">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description">@{{ beacon.description }}</textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="icon-check position-left"></i> Save changes</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /basic modal -->

	<div class="panel panel-default" v-for="floor in floors" v-cloak>
		<div class="panel-heading">
			<h6 class="panel-title">FLOOR @{{ floor.location_vertical }}</h6>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-1 col-sm-2 col-xs-6" v-for="beacon in floor.beacons">
					<a @click.prevent="editBeacon(beacon)" href="#" class="text-white text-center" data-toggle="modal" data-target="#edit-beacon">
						<img :src="URL+'assets/vector/beacon_'+beacon.color+'.svg'" style="width: 100%" data-popup="tooltip" :title="beacon.name" data-placement="top">
					</a>
					<br>
					<label class="label bg-grey label-block mt-10">@{{ beacon.location_horizontal }}</label>
				</div>
			</div>
		</div>
	</div>

</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript" src="{{ asset('js/vue/beacon.js') }}"></script>
@endpush