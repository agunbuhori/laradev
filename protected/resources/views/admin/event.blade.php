@extends('layouts.admin')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/jgrowl.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/anytime.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.time.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/legacy.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script>
<style type="text/css">
	.daterangepicker, .AnyTime-win {
		z-index: 99999 !important;
	}
</style>
@endpush

{{-- PANEL --}}
@section('panel', 'Event')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Event</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-connection position-left"></i> Create Promotion</a></li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="event">
	<!-- Basic modal -->
	<form id="modal_default" class="modal fade" method="post" action="{{ url('data/event') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">CREATE EVENT</h5>
				</div>

				<div class="modal-body">
					<div class="well">
						@can('setup')
						<div class="form-group">
							<label>Select Mall</label>
							<select class="form-control select-mall" name="mall_id">
								@foreach (App\Mall::all() as $mall)
								<option value="{{ $mall->id }}">{{ $mall->name }}</option>
								@endforeach
							</select>
						</div>
						@endcan

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Start date</label>
									<input class="form-control pickadate" type="text" name="start" placeholder="Pick a date" value="{{ date('d F, Y') }}">
								</div>

								<div class="col-sm-6">
									<label>End date</label>
									<input class="form-control pickadate" type="text" name="end" placeholder="Pick a date" value="{{ date('d F, Y') }}">
									<div class="checkbox checkbox-switchery">
										<label>
											<input type="checkbox" class="switchery" name="noend" value="all" onclick="$('[name=end]').toggle()">
											Only 1 day
										</label>
									</div>	
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Start time</label>
									<input class="form-control pickatime" type="text" name="start_time" placeholder="Pick a time" value="{{ date('H:i A') }}">
								</div>

								<div class="col-sm-6">
									<label>End time</label>
									<input class="form-control pickatime" type="text" name="end_time" placeholder="Pick a time" value="{{ date('H:i A') }}">
									<div class="checkbox checkbox-switchery">
										<label>
											<input type="checkbox" class="switchery" name="noendtime" value="all" onclick="$('[name=end_time]').toggle()">
											Anytime
										</label>
									</div>		
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Title</label>
							<input class="form-control" type="text" name="title" placeholder="Write event title" required="">
						</div>

						<div class="form-group">
							<label>Content</label>
							<textarea class="form-control" name="content" placeholder="Write content"></textarea>
						</div>

						<div class="form-group">
							<label>Event picture</label>
							<input type="file" class="file-input" name="picture">
						</div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="icon-sphere position-left"></i> PUBLISH EVENT</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /basic modal -->

	<!-- Basic modal -->
	<form id="modal_edit" class="modal fade" method="post" :action="URL+'data/event/'+event.id" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">EDIT EVENT</h5>
				</div>

				<div class="modal-body">
					<div class="well">
						@can('setup')
						<div class="form-group">
							<label>Select Mall</label>
							<select class="form-control select-mall" name="mall_id">
								@foreach (App\Mall::all() as $mall)
								<option value="{{ $mall->id }}">{{ $mall->name }}</option>
								@endforeach
							</select>
						</div>
						@endcan

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Start date</label>
									<input class="form-control pickadate" type="text" name="start" placeholder="Pick a date" :value="moment(event.start).format('DD MMMM, YYYY')">
								</div>

								<div class="col-sm-6">
									<label>End date</label>
									<input class="form-control pickadate" type="text" name="end" placeholder="Pick a date" :value="moment(event.end).format('DD MMMM, YYYY')">
									<div class="checkbox checkbox-switchery">
										<label>
											<input type="checkbox" class="switchery" name="noend" value="all" onclick="$('[name=end]').toggle()">
											Only 1 day
										</label>
									</div>	
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Start time</label>
									<input class="form-control pickatime" type="text" name="start_time" placeholder="Pick a time" :value="moment(event.start_time, 'HH:mm:ss').format('HH:mm A')">
								</div>

								<div class="col-sm-6">
									<label>End time</label>
									<input class="form-control pickatime" type="text" name="end_time" placeholder="Pick a time" :value="moment(event.end_time, 'HH:mm:ss').format('HH:mm A')">
									<div class="checkbox checkbox-switchery">
										<label>
											<input type="checkbox" class="switchery" name="noendtime" value="all" onclick="$('[name=end_time]').toggle()">
											Anytime
										</label>
									</div>		
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Title</label>
							<input class="form-control" type="text" name="title" placeholder="Write event title" required="" :value="event.title">
						</div>

						<div class="form-group">
							<label>Content</label>
							<textarea class="form-control" name="content" placeholder="Write content">@{{ event.content }}</textarea>
						</div>

						<div class="form-group">
							<img :src="event.picture" style="width: 100%">
						</div>
						
						<div class="form-group">
							<label>Event picture</label>
							<input type="file" class="file-input" name="picture">
						</div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success"><i class="icon-check position-left"></i> UPDATE EVENT</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /basic modal -->

	<!-- Basic datatable -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h6 class="panel-title">EVENTS</h6>
			<div class="heading-elements">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_default"><i class="icon-calendar3 position-left"></i> CREATE EVENT</button>
			</div>
		</div>
		<table class="table table-hover table-striped" id="table-event">
			<thead>
				<tr>
					<th>Event Name</th>
					@can('setup')
					<th>Mall Name</th>
					@endcan
					<th>Start</th>
					<th>End</th>
					<th>Status</th>
					<th width="12%">Options</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($events as $event)
				<tr>
					<td>
						<div class="media-left media-middle">
							<a href="#"><img src="{{ asset('assets/vector/calendar.svg') }}" class="img-circle img-xs" alt=""></a>
						</div>
						<div class="media-left">
							<div class=""><a href="#" class="text-default text-semibold">{{ $event->title }}</a></div>
							<div class="text-muted text-size-small">
								<span class="status-mark border-success position-left"></span>
								@if ($event->end_time !== null)
								{{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
								@else
								Start from {{ date('H:i', strtotime($event->start_time)) }}
								@endif
							</div>
						</div>
					</td>
					@can('setup')
					<td>{{ $event->mall->name }}</td>
					@endcan
					<td><span class="text-muted">{{ date('d F Y', strtotime($event->start)) }}</span></td>
					<td><span class="text-muted">{{ $event->end ? date('d F Y', strtotime($event->end)) : 'Only 1 day' }}</span></td>
					<td>
						@if ($event->end >= date('Y-m-d') || $event->end === null)
						<label class="label label-success">PUBLISHED</label>
						@else
						<label class="label label-danger">EXPIRED</label>
						@endif
					</td>
					<td class="text-right">
						<a href="#" class="label label-flat border-primary text-primary-600" @click.prevent="editEvent({{ $event }})">EDIT</a>
						<a href="#" class="label label-flat border-danger text-danger-600" @click="deleteEvent($event, {{ $event->id }})">DELETE</a>
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
		$('#table-event').dataTable({
			columnDefs: [{ 
				orderable: false,
				width: '140px',
				targets: [4]
			}],
		});
		$('.pickadate').pickadate();
		$(".pickatime").pickatime();
		$('.select-mall').select2();
	});
</script>
<script type="text/javascript">
	var event = new Vue({
		el: '#event',
		data: {
			event: {}
		},
		mounted: function() {

		},
		methods: {
			editEvent(event) {
				this.event = event;
				$('#modal_edit').modal('show');
			},
			deleteEvent(event, id) {
				event.preventDefault();
				if (confirm("Delete this event?"))
					axios.post(URL+'data/event/'+id, {_method: 'DELETE'}).then(() => {
						$(event.target).parents('tr').remove();
					});
			}
		}
	});
</script>
@endpush