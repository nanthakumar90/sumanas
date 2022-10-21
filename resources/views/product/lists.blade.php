@extends('common.layout.layout2')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Products</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active">Products</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Products List</h3>
			</div>
			<div class="card-body">
				<table id="table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Price</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@if($products->isNotEmpty())
							@foreach($products as $product)
								<tr>
									<td>{{ $product->name }}</td>
									<td>{{ $product->price }}</td>
									<td class="text-center"><a href="{{ url('product/view/'.$product->id) }}" class="btn btn-primary">Buy Now</a></td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="3" class="text-center">No Record(s) Found.</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</section>
@endsection

@section('js')
	<script>
		$('#table').DataTable({
			"autoWidth": false,
			"responsive": true,
		});
	</script>
@endsection
