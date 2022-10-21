@extends('common.layout.layout2')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>View Product</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('product') }}">Products</a></li>
						<li class="breadcrumb-item active">View Product</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h3 class="card-title">View Product</h3>
				<div class="ml-auto">
					<a href="{{ url('product') }}" class="btn btn-primary">Back</a>
				</div>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item border-top-0">
						<b>Name</b> 
						<div>{{ $product->name }}</div>
					</li>
					<li class="list-group-item">
						<b>Price</b> 
						<div>{{ $product->price }}</div>
					</li>
					<li class="list-group-item">
						<b>Description</b> 
						<div>{{ $product->description }}</div>
					</li>
					<li class="list-group-item border-bottom-0">
						<b>Stripe Payment</b> 
						<form action="{{ url('product/view/'.$product->id) }}" method="post" class="stripeform">
							<div id="cardelement" class="mt-3"></div>
							<div id="carderrors" class="error_class_1"></div>
							@csrf
							<input type="hidden" name="payment_method" class="paymentmethod">
							<button type="submit" class="btn btn-primary mt-3 stripepay">Pay</button>
						</form>
					</li>
				</ul>
			</div>
		</div>
		@if($subscriptions->isNotEmpty())
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Payments</h3>
				</div>
				<div class="card-body">
					<table id="table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Date</th>
								<th>Amount</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($subscriptions as $subscription)
								<tr>
									<td>{{ date('d-m-Y H:i:s', strtotime($product->created_at)) }}</td>
									<td>{{ $subscription->stripe_price }}</td>
									<td>{{ $subscription->stripe_status }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</section>
@endsection

@section('js')
	<script src="https://js.stripe.com/v3/"></script>
	<script>
		$(function(){
			var stripekey = "{{ env('STRIPE_KEY') }}";
			var clientsecret = "{{ $paymentintent->client_secret }}";
			var name = "{{ auth()->user()->name }}";
			
			let stripe = Stripe(stripekey)
			let elements = stripe.elements()
			let style = {
				base: {
					color: '#32325d',
					fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
					fontSmoothing: 'antialiased',
					fontSize: '16px',
					'::placeholder': {
						color: '#aab7c4'
					}
				},
				invalid: {
					color: '#fa755a',
					iconColor: '#fa755a'
				}
			}
			let card = elements.create('card', {hidePostalCode: true, style: style})
			card.mount('#cardelement')
			
			let paymentMethod = null
			$('.stripeform').on('submit', function (e) {
				$('.stripepay').attr('disabled', true)
				if (paymentMethod) return true
				
				stripe.confirmCardSetup(
					clientsecret,
					{
						payment_method: {
							card: card,
							billing_details: {name: name}
						}
					}
				).then(function (result) {
					if (result.error) {
						$('#carderrors').text(result.error.message)
						$('.stripepay').removeAttr('disabled')
					} else {
						paymentMethod = result.setupIntent.payment_method
						$('.paymentmethod').val(paymentMethod)
						$('.stripeform').submit()
					}
				})
				return false
			})
			
			$('#table').DataTable({
				"autoWidth": false,
				"responsive": true,
			});
		})
	</script>
@endsection