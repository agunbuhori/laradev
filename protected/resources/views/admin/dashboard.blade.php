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
	<div class="alert bg-primary">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Morning!</span> We're glad to see you again and wish you a nice day.
	</div>
</component>
@endsection
{{-- END CONTENT --}}

@push('vue-js')
@endpush