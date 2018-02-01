
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SpotMe</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
	@stack('sec-js')
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	@stack('js')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>
	<!-- /theme JS files -->

</head>
@php
if (auth()->user()->role_id === 2)
	$user = auth()->user()->mall->name;
elseif (auth()->user()->role_id === 3)
	$user = auth()->user()->merchant->brand;
elseif (auth()->user()->role_id === 4)
	$user = auth()->user()->mall->name;

@endphp
<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-indigo">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo_light.png') }}" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<div class="navbar-right">
				<p class="navbar-text">Howdy, {{ auth()->user()->name }}</p>
				<p class="navbar-text"><span class="label bg-success-400">{{ ucwords(auth()->user()->role->name) }} Authorization</span></p>				
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#"><img src="{{ asset('assets/vector/man.svg') }}" class="img-circle img-responsive" alt=""></a>
								<h6>{{ auth()->user()->name }}</h6>
								@cannot('setup')
								<span class="text-size-small">{{ $user }}</span>
								@endcannot
							</div>
														
							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
								<li><a href="javascript:void(0);" onclick="logoutSession()"><i class="icon-switch2"></i> <span>Logout</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li {!! request()->is('dashboard') ? 'class="active"' : '' !!}><a href="{{ url('dashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								@foreach (auth()->user()->role->authorizations as $authorization)
									@if ($authorization->module->show === 1)
									<li class="{{ request()->url() == url('authorization/'.$authorization->module->uri) ? 'active' : '' }}"><a href="{{ url('authorization/'.$authorization->module->uri) }}"><i class="{{ $authorization->module->icon }}"></i> <span>{{ $authorization->module->title }}</span></a></li>
									@endif
								@endforeach
								@can('setup')
									<li>
										<a href="#"><i class="icon-cog"></i> <span>Setup</span></a>
										<ul>
											<li><a href="{{ url('setup/module') }}">Module</a></li>
											<li><a href="{{ url('setup/role') }}">Role</a></li>
											<li><a href="{{ url('setup/authorization') }}">Authorization</a></li>
											<li><a href="{{ url('setup/page') }}">Page</a></li>
										</ul>
									</li>
								@endcan
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">
				@section('header')
				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><span class="text-semibold">@yield('panel')</span> @yield('panel-child')</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							@yield('breadcrumb')
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="{{ url()->previous() }}"><i class="icon-circle-left2 position-left"></i> Back to previous page</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				@show


				<!-- Content area -->
				<div class="content">
					@yield('content')

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2017. <a href="#">SpotMe</a> by <a href="http://sumroch.com" target="_blank">PT. Sumroch Karya Indonesia</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<form id="logout-form" method="post" action="{{ url('logout') }}">{{ csrf_field() }}</form>
	<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
	<script type="text/javascript">
		const URL = "{{ url('/') }}/";
		
		function logoutSession() {
			document.getElementById('logout-form').submit();
		}

		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	</script>
	@stack('vue-js')
</body>
</html>
