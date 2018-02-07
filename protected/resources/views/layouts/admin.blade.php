<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>REPLACEMENT VEHICLES</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	@stack('css')
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	@stack('sec-js')
	<script type="text/javascript">
		const URL = "{{ url('/') }}/",
			CURRENT = "{{ request()->url() }}",
			TOKEN = "{{ csrf_token() }}";
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		function logoutSession(event) {
			document.getElementById('logoutForm').submit();
		}
	</script>
	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	@stack('js')
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/replacement.png') }}" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<p class="navbar-text"><span class="label bg-success-400">Online</span></p>

			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('assets/images/placeholder.jpg') }}" alt="">
						<span>{{ auth()->user()->name }}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#" onclick="logoutSession(event)"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<li {!! request()->is('vehicle') ? 'class="active"' : '' !!}><a href="{{ url('vehicle') }}"><i class="icon-car position-left"></i> Vehicle</a></li>
				<li {!! request()->is('store') ? 'class="active"' : '' !!}><a href="{{ url('store') }}"><i class="icon-store position-left"></i> Store</a></li>
				<li {!! request()->is('data_master') ? 'class="active"' : '' !!}><a href="{{ url('data_master') }}"><i class="icon-folder2 position-left"></i> Data Master</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right">Share</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
						<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
						<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /second navbar -->

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<i class="icon-arrow-left52 position-left"></i>
					<span class="text-semibold">@yield('header')</span>
				</h4>
			</div>
		</div>
	</div>
	<!-- /page header -->

	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				@yield('content')
			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->


	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2015. <a href="#">Replacement Vehciles</a> by <a href="http://sumroch.com" target="_blank">PT. Sumroch Karya Indonesia</a>
	</div>
	<!-- /footer -->
	<form method="post" action="{{ url('logout') }}" id="logoutForm">
		{{ csrf_field() }}
	</form>
	@stack('vue')
</body>
</html>
