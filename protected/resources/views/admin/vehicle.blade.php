@extends('layouts.admin')
@section('header', 'Vehicle')
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
@endpush
{{-- ================================================================================================================= --}}
@push('js')
@endpush
{{-- ================================================================================================================= --}}

@section('content')
<component id="vehicle" v-cloak>
	

	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<table class="table text-nowrap table-hover">
					<tbody>
						@foreach ($makers as $maker)
							@foreach ($maker->products as $key => $product)
								<tr @click.prevent="changeProduct($event, {{ $product->id }})" style="cursor: pointer;" {!! $loop->parent->index === 0 ? 'class="active"' : '' !!}>
									<td>
										<div class="media-left media-middle">
											<img src="{{ asset('assets/images/cars/'.$product->picture) }}" alt="" style="width: 50px">
										</div>
										<div class="media-left">
											<div class=""><span class="text-default text-semibold">{{ $maker->name." ".$product->name }}</span></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-green position-left"></span>
												{{ $product->vehicles->count() }} unit
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-9">
			<form action="#" class="main-search">
				<div class="input-group content-group">
					<div class="has-feedback has-feedback-left">
						<input type="text" class="form-control input-xlg" placeholder="Search" v-model="search" @keyup="searchVehicle()">
						<div class="form-control-feedback">
							<i class="icon-search4 text-muted text-size-base"></i>
						</div>
					</div>

					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-xlg"><i class="icon-search4"></i></button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-3" v-for="vehicle in vehicles" :key="search">
					<div class="panel panel-body has-bg-image" :class="{'bg-slate-800': vehicle.store == null, 'bg-teal-600': vehicle.store != null}">
						<div class="media no-margin">
							<div class="media-body">
								<h6 class="no-margin"> @{{ vehicle.number }}</h6>
								<span class="text-uppercase text-size-mini">@{{ vehicle.store }}</span>
								<span class="text-uppercase text-size-mini" v-if="vehicle.store == null">Occupied</span>
							</div>
							<div class="media-right media-middle">
								<a href="assets/images/placeholder.jpg">
									<img src="assets/images/placeholder.jpg" class="img-circle img-lg" alt="">
								</a>
							</div>
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
	var vehicle = new Vue({
		el: '#vehicle',
		data: {
			vehicles: [],
			product_id: {{ App\Product::first()->id }},
			search: null,
			params: {
				q: null
			}
		},
		mounted: function () {
			this.getVehicles();
		},
		methods: {
			getVehicles() {
				axios.get(URL+'data/vehicle?product_id='+this.product_id, {params: this.params}).then((response) => {
					this.vehicles = response.data;
				});
			},
			changeProduct(event, id) {
				$('table .active').removeClass('active');
				$(event.target).addClass('active');
				this.product_id = id;
				this.getVehicles();
			},
			searchVehicle() {
				this.params.q = this.search;
				this.getVehicles();
			}
		},
		computed: {
		    filteredVehicles:function()
		    {
		        var self=this;
		        return this.vehicles.filter(function (vehicle) { 
		        	return vehicle.name.toLowerCase().indexOf(self.search.toLowerCase())>=0;
		        });
		    }
		}
	});
</script>
@endpush