@extends('layouts.admin')

{{-- PANEL --}}
@section('panel', 'Mall')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script>
@endpush

{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Mall</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-office position-left"></i> Install Beacon</a></li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="mall">
	<form method="post" action="{{ url('data/beacon') }}" id="modal_animation" class="modal fade">
		{{ csrf_field() }}
		<input type="hidden" name="mall_id" :value="mall.id">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-body">

					<h5 class="text-semibold">@{{ mall.name }}</h5>
					@{{ mall.address }}
					<hr>

					<div class="well">
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" name="name" placeholder="Type beacon name" required="required">
							<label id="has-taken" class="validation-error-label" style="display: none;" for="basic">This uuid has been taken</label>
						</div>

						<div class="form-group">
							<label>UUID</label>
							<input class="form-control" name="uuid" placeholder="Type beacon UUID" required="required">
							<label id="has-taken" class="validation-error-label" style="display: none;" for="basic">This uuid has been taken</label>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Major</label>
									<input class="form-control" type="number" name="major" placeholder="Type beacon major">
								</div>

								<div class="col-sm-6">
									<label>Minor</label>
									<input class="form-control" type="number" name="minor" placeholder="Type beacon minor">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Y Position</label>
									<input class="form-control" name="location_vertical" placeholder="Vertical position">
								</div>

								<div class="col-sm-6">
									<label>X Position</label>
									<input class="form-control" name="location_horizontal" placeholder="Horizontal position">
								</div>
							</div>
						</div>
					</div>	

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="icon-check position-left"></i> INSTALL</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /disabled animation -->

	<form method="post" action="{{ url('data/mall') }}" id="add-mall" class="modal fade" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="mall_id" :value="mall.id">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title">Add New Mall</h6>
				</div>

				<div class="modal-body">
					<div class="well">
						<div class="form-group">
							<label>Mall Name</label>
							<input class="form-control" type="text" name="name" placeholder="Write mall name">
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Latitude</label>
									<input class="form-control" type="text" name="latitude" placeholder="Latitude">	
								</div>
								
								<div class="col-md-6">
									<label>Longitude</label>
									<input class="form-control" type="text" name="longitude" placeholder="Longitude">	
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" placeholder="Write mall description"></textarea>
						</div>

						<div class="form-group">
							<label>Picture</label>
							<input type="file" class="file-input" name="picture">
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="icon-check position-left"></i> ADD</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /disabled animation -->


	<div class="panel panel-default">
		<div class="panel-heading">
			<h6 class="panel-title">Mall List</h6>
			<div class="heading-elements">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-mall"><i class="icon-office position-left"></i> Add New Mall</button>
			</div>
		</div>

		<form class="panel-body" method="get" action="{{ request()->url() }}">
			<div class="row">
				<div class="col-md-9">
					<div class="has-feedback has-feedback-left">
						<input type="text" class="form-control" placeholder="Search mall here" name="q" value="{{ request()->q }}">
						<div class="form-control-feedback">
							<i class="icon-search4 text-size-base"></i>
						</div>
					</div>
				</div>

				<div class="col-md-3 text-right">
					<div class="btn-group">
						<a href="{{ request()->url() }}" class="btn btn-default btn-xs {{ ! request()->has('status') ? 'active' : '' }}">All</a>
						<a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="btn btn-default btn-xs {{ request()->status === 'active' ? 'active' : '' }}">Active</a>
						<a href="{{ request()->fullUrlWithQuery(['status' => 'disabled']) }}" class="btn btn-default btn-xs {{ request()->status === 'disabled' ? 'active' : '' }}">Disabled</a>
					</div>
				</div>
			</div>
		</form>

		<table class="table text-nowrap">
			<tbody>
				@foreach ($malls as $mall)
				<tr>
					<td>
						<div class="media-left media-middle">
							<img src="{{ asset('assets/vector/mall.svg') }}" class="img-xs" alt="">
						</div>

						<div class="media-body">
							<a href="{{ url('authorization/mall_profile/'.$mall->code) }}" class="display-inline-block text-default text-semibold letter-icon-title">{{ $mall->name }}</a>
							<div class="text-muted">{{ $mall->code }}</div>
						</div>
					</td>
					<td>
						<a href="#" class="text-default display-inline-block">
							<span class="text-semibold">Lat : {{ $mall->latitude }},  Long : {{ $mall->longitude }}</span>
							<span class="display-block text-muted">{{ substr($mall->address, 0, 70) }}...</span>
						</a>
					</td>
					<td class="text-center">
						<span class="h6 no-margin">{{ $mall->merchants->count() }} <small class="display-block text-size-small no-margin">Merchants</small></span>
					</td>
					<td class="text-center">
						<span class="h6 no-margin">{{ $mall->beacons->count() }} <small class="display-block text-size-small no-margin">Beacons</small></span>
					</td>

					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#" data-toggle="modal" data-target="#modal_animation" @click="addNewBeacon({{ $mall }})"><i class="icon-feed"></i> Install New Beacon</a></li>
									<li class="divider"></li>
									@if ($mall->status === 0)
									<li><a href="#"><i class="icon-check text-info"></i> Activate</a></li>
									@else
									<li><a href="#"><i class="icon-switch2 text-warning"></i> Disable</a></li>
									@endif
									<li><a href="#"><i class="icon-pencil4 text-success"></i> Edit</a></li>
									<li><a href="#"><i class="icon-cross2 text-danger"></i> Remove</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				@endforeach

				@if ($malls->count() === 0)
				<tr class="active">
					<td colspan="5" class="text-center text-italic">No result found from query : "{{ request()->q }}" </td>
				</tr>
				@endif

				@if (request()->has('q') && $malls->count() > 0)
				<tr class="active">
					<td colspan="5" class="text-center">Showing {{ $malls->count() }} result. <a href="{{ url('authorization/mall') }}">Back to list</a></td>
				</tr>
				@endif

			</tbody>
		</table>
	</div>
	<div class="text-center">
		{!! $malls->links() !!}
	</div>
</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript" src="{{ asset('js/vue/mall.js') }}"></script>
@endpush