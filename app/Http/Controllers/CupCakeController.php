<?php

namespace App\Http\Controllers;

use App\CupCake;
use App\Cart;
use App\Category;
use Session;
use Illuminate\Http\Request;

class CupCakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cakes = CupCake::latest()->take(12)->get();
        //dd($cakes);
        return view('index',compact('cakes'));
    }

    public function categories($cake){
        $category = Category::where('category_name',$cake)->get();
        $cakes = $category->cupCakes->take(12);
    }

    public function addToCart(Request $request, $id){
        $product = CupCake::findOrFail($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function reduceItemByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        Session::put('cart', $cart);
        return back();
        
    }

    public function removeItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return back();
    }

    public function emptyCart(){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        Session::forget('cart');
        $cart = null;

      return back();
   }

    public function getCart(Request $request){
        //dd(request()->session()->get('cart'));
        if(!Session::has('cart')){
            return view('products.test_cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $product = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQty = $cart->totalQty;
        return view('products.test_cart', compact('product','totalPrice','totalQty'));
    }
    /**
     * From paystack
     * 
     */

     
    public function redirectToGateway()
    {

        request()->metadata = json_encode(request()->all());
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {
     
        $paymentDetails = Paystack::getPaymentData();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if($paymentDetails){
            $order = new Transaction();
            $order->reference_id = $paymentDetails['data']['reference'];
            $order->amount = $paymentDetails['data']['amount'];
            $order->state = $paymentDetails['data']['metadata']['state'];
            $order->address = $paymentDetails['data']['metadata']['address'];
            $order->fullName = $paymentDetails['data']['metadata']['fullName'];
            $order->email = $paymentDetails['data']['metadata']['email'];
            $order->paid_at = $paymentDetails['data']['paidAt'];
            $order->currency = $paymentDetails['data']['currency'];
            $order->cart = serialize($cart);
            $order->status = "Pending";
            $order->save();
        }
        $this->emptyCart();


        //return $paymentDetails;
        //dd($paymentDetails['data']);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
    
}
