@extends('layouts.admin')

{{-- PANEL --}}
@section('panel', 'Setup')
@section('panel-child', 'Module')
{{-- END PANEL --}}

{{-- BREADCRUMB --}}
@section('breadcrumb')
<li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
<li>Setup</li>
<li class="active">Module</li>
@endsection
@section('action')
<li><a href="#" data-toggle="modal" data-target="#modal_default"><i class="icon-folder-plus2 position-left"></i> Add New Module</a></li>
@endsection
{{-- END BREADCRUMB --}}

{{-- ===================================================================================================== --}}

{{-- CONTENT --}}
@section('content')
<!-- Basic modal -->
<div id="modal_default" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Add New Module</h5>
			</div>

			<form class="ajaxSubmit" method="post" action="{{ url('data/module') }}">
				{{ csrf_field() }}
				<div class="modal-body form-horizontal">
					<fieldset class="content-group">
						<div class="form-group">
							<label class="control-label col-lg-2">Title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="title" placeholder="Write module title">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Icon</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="icon" placeholder="Write module icon (icomon)">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2">Uri</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="uri" placeholder="Write module uri">
							</div>
						</div>
					</fieldset>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->


<div class="row">
	@if ($errors->has('delete'))
	<div class="col-md-12">
		<div class="alert alert-danger no-border">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<span>{{ $errors->first('delete') }}</span>
			<a class="text-semibold alert-link" href="javascript:void();" onclick="$(this).parents('.alert').find('form').submit()">Keep delete?</a>
			<form method="post" action="{{ url('data/module/'.$errors->first('id').'?force=true') }}">{{ csrf_field() }}{{ method_field('DELETE') }}</form>
		</div>
	</div>
	@endif
	@foreach (App\Module::all() as $module)
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body text-center">
				<div class="icon-object border-success text-success"><i class="{{ $module->icon }}"></i></div>
				<h5 class="text-semibold">{{ $module->title }}</h5>
			</div>
			<div class="panel-footer text-center">
				<div class="btn-group dropup">
					<button type="button" class="btn btn-default btn-xs btn-rounded dropdown-toggle legitRipple" data-toggle="dropdown"><span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-pencil4"></i> Edit</a></li>
						<form method="post" action="{{ url('data/module', $module) }}">{{ csrf_field() }}{{ method_field('DELETE') }}</form>	
						<li><a href="javascript:void(0)" onclick="if (confirm('Are you sure?')) $(this).parents('ul').find('form').submit()"><i class="icon-trash"></i> Delete</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection
{{-- END CONTENT --}}

