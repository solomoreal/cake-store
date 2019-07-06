<?php

namespace App\Http\Controllers;

use App\CupCake;
use App\Cart;
use App\Category;
use Session;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function Opis\Closure\unserialize;
use Mail;
use Notification;
use App\Notifications\MailSent;
use App\Notifications\NewOrder;
use Paystack;
use App\User;



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
        $category = Category::where('name',$cake)->first();
        $cakes = $category->cupCakes->take(12);
        return view('index')->withCakes($cakes);
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

   public function checkout(){
    
       $user = Auth::user();
       $currency = '₦';
       //$countries = Country::all();
    //$categories = Category::all();
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $products = $cart->items;
    $totalPrice = $cart->totalPrice;
    $totalPriceCheckout = $cart->totalPrice*100;
    $totalQty = $cart->totalQty;
    return  view('checkout', compact(['categories','products','totalPrice','totalQty','totalPriceCheckout','user','countries','currency']));
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
            $order = new Order();
            $order->order_id = $paymentDetails['data']['reference'];
            $order->amount = $paymentDetails['data']['amount'];
            $order->state = $paymentDetails['data']['metadata']['state'];
            $order->address = $paymentDetails['data']['metadata']['address'];
            $order->full_name = $paymentDetails['data']['metadata']['first_name']. " " .$paymentDetails['data']['metadata']['last_name'];
            $order->country = $paymentDetails['data']['metadata']['country'];
            $order->city = $paymentDetails['data']['metadata']['city'];
            $order->quantity = $paymentDetails['data']['metadata']['quantity'];
            $order->phone = $paymentDetails['data']['metadata']['phone'];
            $order->email = $paymentDetails['data']['metadata']['email'];
            $order->paid_at = $paymentDetails['data']['paidAt'];
            $order->currency = $paymentDetails['data']['currency'];
            $order->cart =  base64_encode(serialize($cart));
            $order->status = "Pending";
            if(Auth::user()){
                $order->user_id = Auth::user()->id;
            }
            $order->save();
            $user = User::findOrFail($order->user_id);
            $user->notify(new NewOrder($order->order_id));

        }
        $this->emptyCart();
                return redirect(route('profile'));
    }

public function profile(){ 
           //dd($user->orders);
           $orders = Auth::user()->orders;
           $orders->transform(function($order, $key){
               $order->cart = unserialize(base64_decode($order->cart));

               return $order;
           });
        return view('profile',compact(['orders']));
       }

       public function orderDetails($id){
        $order = Order::findOrfail($id);
        $cart = unserialize(base64_decode($order->cart));
        return view('order_details', compact(['order', 'cart']));
        
    }

        
    
}
