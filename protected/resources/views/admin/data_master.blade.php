@extends('layouts.admin')
@section('header', 'Data Master')
{{-- ================================================================================================================= --}}
@push('css')
<style type="text/css">
	[v-cloak] {
		display: none;
	}
</style>
@endpush
{{-- ================================================================================================================= --}}
@push('sec-js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endpush
{{-- ================================================================================================================= --}}
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endpush
{{-- ================================================================================================================= --}}

@section('content')

<component id="data">

<form method="post" :action="'{{url('data/vehicle')}}'" id="add_vehicle" class="modal fade">
	<input type="hidden" name="_method" value="PUT" v-if="lagi_di_edit.id != null">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Add Vehicle</h5>
			</div>

			<div class="modal-body">
				{{csrf_field()}}
				<div class="form-group">
					<label class="display-block text-bold">Number : </label>
					<input class="form-control" type="text" name="number" id="number" placeholder="Type number" required="required">
				</div>
				<div class="form-group">
					<label class="display-block text-bold">Color : </label>
					<input class="form-control" type="text" name="color" id="color" placeholder="Type color" required="required">
				</div>
				<div class="form-group">
					<label class="display-block text-bold">Product : </label>
					<input class="form-control" type="text" name="product" id="product" placeholder="Type product" required="required">
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><i class="icon-check position-left"></i> Save </button>
			</div>
			
		</div>
	</div>
</form>

<form method="post" :action="'{{url('data/store')}}'" id="add_store" class="modal fade">
	<input type="hidden" name="_method" value="PUT" v-if="lagi_di_edit.id != null">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Add Store</h5>
			</div>

			<div class="modal-body">
				{{csrf_field()}}
				<div class="form-group">
					<label class="display-block text-bold">Name : </label>
					<input class="form-control" type="text" name="name" id="name" placeholder="Type name" required="required">
				</div>
				<div class="form-group">
					<label class="display-block text-bold">Email : </label>
					<input class="form-control" type="text" name="email" id="email" placeholder="Type email" required="required">
				</div>
				<div class="form-group">
					<label class="display-block text-bold">Contact : </label>
					<input class="form-control" type="text" name="contact" id="contact" placeholder="Type contact" required="required">
				</div>
				<div class="form-group">
					<label class="display-block text-bold">Address : </label>
					<input class="form-control" type="text" name="address" id="address" placeholder="Type address" required="required">
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><i class="icon-check position-left"></i> Save </button>
			</div>
			
		</div>
	</div>
</form>

<div class="col-md-12">
	<div class="panel panel-flat">
		<div class="panel-body">
			<div class="tabbable">
				<ul class="nav nav-tabs nav-tabs-bottom">
					<li class="active"><a href="#bottom-tab1" data-toggle="tab">
						<i class="icon-plus3" data-toggle="modal" data-target="#add_vehicle" style="margin-right:10px;"></i> Vehicle </a></li>
					<li><a href="#bottom-tab2" data-toggle="tab">
						<i class="icon-plus3" data-toggle="modal" data-target="#add_store" style="margin-right:10px;"></i>Store</a></li>
				</ul>
				<div class="tab-content" style="margin-top:-20px;">
					<div class="tab-pane active" id="bottom-tab1">
						<table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th>Picture</th>
									<th>Number</th>
									<th>Color</th>
									<th>Status</th>
									<th>Product</th>
									<th width="200px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($vehicles as $vehicle)
									<tr role="row" class="odd">
										<td><img src="{{ asset('assets/images/cars/'.$vehicle->product->picture) }}" alt="" style="height: 30px"></td>
										<td>{{ $vehicle->number }}</td>
										<td>{{ $vehicle->color }}</td>
										<td>{{ $vehicle->status }}</td>
										<td>{{ $vehicle->product->maker['name']}} - {{ $vehicle->product['name'] }}</td>
										<td width="200px">
											<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_vehicle" @click="editData({{ $vehicle }})"> Edit </button>
											<button class="btn btn-danger btn-xs" @click="hapusData($event, {{ $vehicle->id }})"> Delete </button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="tab-pane" id="bottom-tab2">
						<table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Address</th>
									<th>Product</th>
									<th width="200px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($stores as $store)
									<tr role="row" class="odd">
										<td>{{ $store->name }}</td>
										<td>{{ $store->email }}</td>
										<td>{{ $store->contact }}</td>
										<td>{{ $store->address }}</td>
										<td></td>
										<td width="200px">
											<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_store"> Edit </button>
											<button class="btn btn-danger btn-xs"> Delete </button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

</component>

@endsection

{{-- ================================================================================================================= --}}
@push('vue')
<script type="text/javascript">
	var token = "{{ csrf_token() }}";
	var data = new Vue({
		el:'#data',
		data: {
			lagi_di_edit: {}
		},
		mounted: function() {

		},
		methods: {
			editData(data) {
				this.lagi_di_edit = data;
			},
		}
	});
</script>
@endpush