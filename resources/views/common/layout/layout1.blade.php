<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sumanas</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="javascript:void(0);"><b>SUMANAS</a>
			</div>
			@yield('content')
		</div>
		<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
		<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('assets/js/adminlte.min.js') }}"></script>
	</body>
</html>