<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sumanas</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
		
		<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
					</li>
				</ul>
			</nav>

			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="javascript:void(0);" class="brand-link">
					<span class="brand-text font-weight-light">Sumanas</span>
				</a>
				<div class="sidebar">
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-header">Menus</li>
							<li class="nav-item">
								<a href="{{ url('product') }}" class="nav-link">
									<i class="nav-icon fab fa-product-hunt"></i>
									<p>Products</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ url('logout') }}" class="nav-link">
									<i class="nav-icon fas fa-sign-out-alt"></i>
									<p>Logout</p>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>

			<div class="content-wrapper">
				@include('common/notification/notification1')
				@yield('content')
			</div>

			<footer class="main-footer">
				<div class="float-right d-none d-sm-block">
					<b>Version</b> 1.0.0
				</div>
				<strong>Copyright &copy; 2022 Sumanas.</strong> All rights reserved.
			</footer>
		</div>
		<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
		<script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
		<script src="{{ url('assets/js/adminlte.min.js') }}"></script>
		@yield('js')
	</body>
</html>
