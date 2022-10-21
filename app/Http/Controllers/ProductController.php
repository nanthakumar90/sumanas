<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Subscription;

class ProductController extends Controller
{
    public function product($type, $requestdata=[])
    {
        $query = Product::whereRaw("1=1");
		
		if(isset($requestdata['id']) && $requestdata['id']!='') $query->where('id', $requestdata['id']);
			
		if($type=='row'){
			return $query->first();
		}elseif($type=='all'){
			return $query->get();
		}
	}
	
    public function lists()
    {
		$products = $this->product('all');
		
        return view('product.lists', compact('products'));
    }
	
    public function view(Request $request, $id)
    {
		$product = $this->product('row', ['id' => $id]);
		if(!$product) return redirect('product')->with('danger', 'No Record Found');
		
		if($request->isMethod('post')){
			$user          = $request->user();
			$paymentmethod = $request->payment_method;

			try {
				$customer = $user->createOrGetStripeCustomer();
				$user->updateDefaultPaymentMethod($paymentmethod);
				$charge = $user->charge($product->price * 100, $paymentmethod, ['customer' => $customer->id, 'currency' => 'inr', 'description' => $product->name ]);        
				
				$chargedata = ['user_id' => $user->id, 'name' => $product->name, 'stripe_id' => $charge->id, 'stripe_status' => $charge->status, 'stripe_price' => $product->price, 'quantity' => '1'];
				Subscription::create($chargedata);
				
				return redirect('product/view/'.$id)->with('success', 'You have successfully done the payment.');
			} catch (\Exception $exception) {
				return redirect('product/view/'.$id)->with('danger', $exception->getMessage());
			}
		}
		
		$paymentintent = auth()->user()->createSetupIntent();
		$subscriptions = Subscription::where('user_id', auth()->user()->id)->get();
		
        return view('product.view', compact('product', 'paymentintent', 'subscriptions'));
    }
}
