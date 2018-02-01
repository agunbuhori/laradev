@extends('layouts.admin')

{{-- PANEL --}}
@section('panel', 'Mall')

@push('sec-js')

@endpush

@push('js')

@endpush

{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('header')

@stop
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
@php
	if (date('H') < 11)
		$greeting = "Morning";
	elseif (date('H') < 14)
		$greeting = "Afternoon";
	elseif (date('H') < 18)
		$greeting = "Evening";
	else
		$greeting = "Night";
@endphp
<div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
	<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
	<h6 class="alert-heading text-semibold">Good {{ $greeting }}!</h6>
	What are you going to do today?
</div>

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="panel panel-body panel-body-accent">
			<div class="media no-margin">
				<div class="media-left media-middle">
					<i class="icon-pointer icon-3x text-success-400"></i>
				</div>

				<div class="media-body text-right">
					<h3 class="no-margin text-semibold">652,549</h3>
					<span class="text-uppercase text-size-mini text-muted">total clicks</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-left media-middle">
					<i class="icon-enter6 icon-3x text-indigo-400"></i>
				</div>

				<div class="media-body text-right">
					<h3 class="no-margin text-semibold">245,382</h3>
					<span class="text-uppercase text-size-mini text-muted">total visits</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold">54,390</h3>
					<span class="text-uppercase text-size-mini text-muted">total comments</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-bubbles4 icon-3x text-blue-400"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="panel panel-body">
			<div class="media no-margin">
				<div class="media-body">
					<h3 class="no-margin text-semibold">389,438</h3>
					<span class="text-uppercase text-size-mini text-muted">total orders</span>
				</div>

				<div class="media-right media-middle">
					<i class="icon-bag icon-3x text-danger-400"></i>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
{{-- END CONTENT --}}

@push('vue-js')

@endpush