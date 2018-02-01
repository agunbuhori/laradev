@extends('layouts.admin')

@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
<style type="text/css">
[v-cloak] {
	display: none;
}
.daterangepicker {
	z-index: 99999 !important;
}
</style>
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/mail_list.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_checkboxes_radios.js') }}"></script>
@endpush

{{-- PANEL --}}
@section('panel', 'Promotion')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')
@parent
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li class="active">Promotion</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-connection position-left"></i> Create Promotion</a></li>
@endsection
@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<component id="promotion">
	<!-- Basic modal -->
	<form id="add-promotion" method="post" action="{{ url('data/promotion') }}" class="modal fade" enctype="multipart/form-data" @submit.prevent="addPromotion($event)">
		{{ csrf_field() }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">CREATE PROMOTION</h5>
				</div>

				<div class="modal-body">
					<div class="well mb-20">
						<div class="form-group">
							<label>Published</label>
							<input class="form-control daterange-single" type="text" name="published">
						</div>

						<div class="form-group">
							<label>Expired</label>
							<input class="form-control daterange-single" type="text" name="expired">
						</div>

						<div class="form-group sic">
							<label>Select beacons</label>
							<select multiple="multiple" data-placeholder="Pick here" class="select-icons" name="beacons[]">
								@php
								if (auth()->user()->role_id === 2)
									$user = auth()->user()->mall;
								elseif (auth()->user()->role_id === 3)
									$user = auth()->user()->merchant;

								$floors = $user->beacons()->groupBy('location_vertical')->get();

								@endphp
								@foreach ($floors as $floor)
								<optgroup label="FLOOR {{ $floor->location_vertical }}">
									@foreach ($user->beacons()->where('location_vertical', $floor->location_vertical)->get() as $beacon)
									<option value="{{ $beacon->id }}" data-icon="feed">{{ $beacon->name }}</option>
									@endforeach
								</optgroup>
								@endforeach
							</select>
						</div>

						<div class="checkbox checkbox-switchery">
							<label>
								<input type="checkbox" class="switchery" name="all_beacon" value="all" @click="checkAllBeacon($event)">
								For all beacon
							</label>
						</div>
					</div>

					<div class="well">
						<div class="form-group">
							<label>Badge</label>
							<input class="form-control" type="text" name="badge" placeholder="Example : 70% discount" required="required">
						</div>

						<div class="form-group">
							<label>Title</label>
							<input class="form-control" type="text" name="title" placeholder="Write promotion title" required="required">
						</div>
						
						<div class="form-group">
							<label>Content</label>
							<textarea class="form-control" name="content" placeholder="Write content"></textarea>
						</div>

						<div class="form-group">
							<label>Picture</label>
							<input type="file" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" name="picture">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="icon-sphere position-left"></i> PUBLISH NOW</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /basic modal -->

	<!-- Basic modal -->
	<form id="edit-promotion" method="post" :action="URL+'data/promotion/'+promotion.id" class="modal fade" enctype="multipart/form-data" @submit.prevent="updatePromotion($event)">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">EDIT PROMOTION</h5>
				</div>

				<div class="modal-body">
					<div class="well mb-20">
						<div class="form-group">
							<label>Published</label>
							<input class="form-control daterange-single" type="text" name="published" :value="moment(promotion.published).format('DD MMMM YYYY')">
						</div>

						<div class="form-group">
							<label>Expired</label>
							<input class="form-control daterange-single" type="text" name="expired" :value="moment(promotion.expired).format('DD MMMM YYYY')">
						</div>

						<div class="form-group sic">
							<label>Select beacons</label>
							<select multiple="multiple" data-placeholder="Pick here" class="select-icons" name="beacons[]" required="required">
								@php
								if (auth()->user()->role_id === 2)
									$user = auth()->user()->mall;
								elseif (auth()->user()->role_id === 3)
									$user = auth()->user()->merchant;

								$floors = $user->beacons()->groupBy('location_vertical')->get();

								@endphp
								@foreach ($floors as $floor)
								<optgroup label="FLOOR {{ $floor->location_vertical }}">
									@foreach ($user->beacons()->where('location_vertical', $floor->location_vertical)->get() as $beacon)
									<option :selected="inArray(promotion, {{ $beacon }})" value="{{ $beacon->id }}" data-icon="feed">{{ $beacon->name }}</option>
									@endforeach
								</optgroup>
								@endforeach
							</select>
						</div>
						<div class="checkbox checkbox-switchery">
							<label>
								<input type="checkbox" class="switchery" name="kabeh" value="all" @click="checkAllBeacon($event)">
								For all beacon
							</label>
						</div>
					</div>

					<div class="well">
						<div class="form-group">
							<label>Badge</label>
							<input class="form-control" type="text" name="badge" placeholder="Example : 70% discount" required="required" :value="promotion.badge">
						</div>

						<div class="form-group">
							<label>Title</label>
							<input class="form-control" type="text" name="title" placeholder="Write promotion title" :value="promotion.title">
						</div>
						
						<div class="form-group">
							<label>Content</label>
							<textarea class="form-control" name="content" placeholder="Write content">@{{ promotion.content }}</textarea>
						</div>

						<div class="form-group">
							<label>Picture</label>
							<div id="fin">
								<input type="file" class="file-input-edit" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" name="picture">
							</div>
							<input class="removed-file" type="hidden" name="removed" value="notremoved">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success"><i class="icon-sphere position-left"></i> UPDATE</button>
				</div>
			</div>
		</div>
	</form>
	<!-- /basic modal -->

	<div class="panel panel-white" v-cloak>
		<div class="panel-toolbar panel-toolbar-inbox">
			<div class="navbar navbar-default">
				<ul class="nav navbar-nav visible-xs-block no-border">
					<li>
						<a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
							<i class="icon-circle-down2"></i>
						</a>
					</li>
				</ul>

				<div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
					<div class="btn-group navbar-btn">
						<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#add-promotion"><i class="icon-pencil7"></i> <span class="hidden-xs position-right">WRITE NEW</span></button>
						<button type="button" class="btn btn-default btn-xs" :disabled="checked_promotions.length == 0" :class="{'disabled': checked_promotions.length == 0}" @click="deletePromotions()"><i class="icon-bin"></i> <span class="hidden-xs position-right">Delete</span></button>
						<button type="button" class="btn btn-default btn-xs" :disabled="checked_promotions.length == 0" :class="{'disabled': checked_promotions.length == 0}" @click="unpublishPromotions()"><i class="icon-spam"></i> <span class="hidden-xs position-right">Unpublish</span></button>
					</div>

					<div class="btn-group navbar-btn">
						<button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
							<i class="icon-alarm position-left"></i> STATUS
							<span class="caret"></span>
						</button>

						<ul class="dropdown-menu dropdown-menu-right">
							<li :class="{'active': params.time == 'published'}"><a @click.prevent="changeTime('published')" href="#">PUBLISHED</a></li>
							<li :class="{'active': params.time == 'expired'}"><a @click.prevent="changeTime('expired')" href="#">EXPIRED</a></li>
							<div class="divider"></div>
							<li :class="{'active': params.time == 'all'}"><a @click.prevent="changeTime('all')" href="#">ALL TIME</a></li>
						</ul>
					</div>

					<div class="navbar-right">
						<p class="navbar-text" v-if="promotions.total > 0"><span class="text-semibold">@{{ promotions.from+'-'+promotions.to }}</span> of <span class="text-semibold">@{{ promotions.total }}</span></p>

						<div class="btn-group navbar-left navbar-btn" v-if="promotions.total > 0">
							<button type="button" class="btn btn-default btn-icon" :disabled="promotions.current_page == 1" :class="{'disabled': promotions.current_page == 1}" @click="prevPage()"><i class="icon-arrow-left12"></i></button>
							<button type="button" class="btn btn-default btn-icon" :disabled="promotions.current_page == promotions.last_page" :class="{'disabled': promotions.current_page == promotions.last_page}" @click="nextPage()"><i class="icon-arrow-right13"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-md-8">
					<div class="has-feedback has-feedback-left">
						<div class="form-control-feedback">
							<i class="icon-search4 text-size-base"></i>
						</div>
						<input type="text" class="form-control form-control-lg" placeholder="Search here" @keyup="searchPromotion()" v-model="q">
					</div>
				</div>
				<div class="col-md-4">
					<select2></select>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-inbox table-hover">
				<tbody data-link="row" class="rowlink">
					<tr :class="{'unread' : beforeToday(promotion.expired)}" v-for="(promotion, $index) in promotions.data">
						<td class="table-inbox-checkbox rowlink-skip">
							<input type="checkbox" class="styled" @click="checkPromotion($index, $event, promotion)">
						</td>
						<td class="table-inbox-image">
							<img v-if="beforeToday(promotion.expired)" src="{{ asset('assets/vector/megaphone.svg') }}" class="img-circle img-xs" alt="">
							<img v-if="!beforeToday(promotion.expired)" src="{{ asset('assets/vector/rewind-time.svg') }}" class="img-circle img-xs" alt="">
						</td>
						<td class="table-inbox-name">
							<a href="#" @click.prevent="editPromotion(promotion)">
								<div class="letter-icon-title text-default">@{{ promotion.badge }}</div>
							</a>
							<span :class="{'text-success': beforeToday(promotion.expired), 'text-muted': ! beforeToday(promotion.expired)}">@{{ promotion.broadcasts.length }} <i class="icon-feed"></i></span>
						</td>
						<td class="table-inbox-message">
							<span class="table-inbox-subject">@{{ promotion.title }}</span>
							<br>
							<span class="table-inbox-preview">@{{ promotion.content }}</span>
						</td>
						<td class="table-inbox-attachment">
							<i class="text-muted" :class="{'icon-image3': promotion.picture != null, 'icon-file-text': promotion.picture == '{{ asset('pics') }}'}"></i>
						</td>
						<td class="table-inbox-time">
							@{{ moment(promotion.expired).format('DD-MM-YY') }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
<script type="text/javascript">
	var beacons = {!! $user->beacons !!}
</script>
<script type="text/javascript" src="{{ asset('js/vue/promotion.js') }}"></script>
@endpush