@extends('common.layout.layout1')

@section('content')
	<div class="card">
		<div class="card-body login-card-body">
			@if($errors->has('invalidcredentials'))
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{ $errors->first('invalidcredentials') }}
				</div>
			@endif

			<p class="login-box-msg">Sign in to start your session</p>
			<form action="{{ url('/') }}" method="post">
				<div class="mb-3">
					<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
					@if($errors->has('email'))
						<div class="error_class_1">{{ $errors->first('email') }}</div>
					@endif
				</div>
				<div class="mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password">
					@if($errors->has('password'))
						<div class="error_class_1">{{ $errors->first('password') }}</div>
					@endif
				</div>
				<div class="row">
					<div class="col-12">
						@csrf
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection