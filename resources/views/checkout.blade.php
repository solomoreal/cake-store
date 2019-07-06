@extends('layouts.main1')
@section('content')
    <div class="wrapper">
        <div class="content-are">
                <div class="cart" id="cart">
                        <!--cart item-->
                        @if($carts)
                        @foreach($carts->items as $cart)
                        <div class="cart-item d-flex justify-content-between text-capitalize my-3">
                            <img src="{{Storage::url($cart['item']['image_url'])}}" class=" rounded-circle" id="item-img" alt="" height="50" width="50">
                            <div class="item-text">
                            <p id="cart-item-title" class="font-weight-bold mb-0">{{$cart['item']['title']}}</p>
                                <span>$</span>
                                <span id="cart-item-remove" class="cart-item-price mb-0">{{number_format(($cart['item']['price']/100))}}</span>
                            </div>
                        <a href="{{route('removeItem',['id' =>$cart['item']['id']])}}" id="cart-item-remove" class="cart-item-remove">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        @endforeach
                        <!--end of  cart item -->
                            <!-- cart total -->
              <div class="cart-total-container d-flex justify-content-around text-capitalize mt-5">
                <h5>total</h5>
                <h5> $ <strong id="cart-total" class="font-weight-bold">{{Session::has('cart') ?  number_format((Session::get('cart')->totalPrice/100)) : 0 }}</strong> </h5>
              </div>
              <!--end cart total -->
              <!-- cart buttons -->
              <div class="cart-buttons-container mt-3 d-flex justify-content-between">
              <a href="{{route('emptyCart')}}" id="clear-cart" class="btn btn-outline-secondary btn-black text-uppercase">clear cart</a>
              <a href="{{route('checkout')}}" class="btn btn-outline-secondary text-uppercase btn-pink">checkout</a>
              </div>
              @else
              <div>
                  <p>NO Item In Cart</p>
              </div>
              @endif
    
              <!--end of  cart buttons -->
                    </div>
                </div>
            </div>

            <div class="checkout container mt-5">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mx-auto">
                        <div class="container checkout-table">
                            <!--Breadcrumbs-->
                            <ul class="breadcrumb">
                            <li><a href="{{route('index')}}">view products</a></li>
                            </ul>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Session::has('cart'))
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$product['item']['title']}}</td>
                                            <td>{{$product['qty']}}</td>
                                            <td>{{$currency.''.number_format(($product['item']['price']/100),2)}}</td>
                                            <td>{{$currency.''.number_format(($product['price']/100),2)}}</td>
                                        
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                        
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b>TOTAL</b></td>
                                        <td><b>{{$currency.''.number_format(($totalPrice/100),2)}}</b></td>
                                        </tr>
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="container checkout-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Contact Information</h5> 
                                </div>
                                <div class="col-md-6">
                                @if(!Auth::user())   
                                    <p> Already have an account? <a href="{{route('login')}}">Login</a></p>
                                @endif
                                </div>
                            </div>
                        <form action="{{route('pay')}}" method="POST" accept-charset="UTF-8">
                            {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input type="text" required class="form-control" placeholder="first name" name="first_name" value="{{$user->first_name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <input type="text" required class="form-control" name="last name" placeholder="Last name" value="{{$user->last_name}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input type="email" value="{{$user->email}}" required class="form-control" name="email" placeholder="E-mail">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <input value="{{$user->phone}}" type="text" required class="form-control" name="phone" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Keep me up to date on news and exclusive offers
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mt-md-5">Shipping Address</h5>
                                <div class="form-group">
                                <input type="text" value="{{$user->address}}" name="address" class="form-control" placeholder="Apartment, street, or floor">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control" placeholder="Country...">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input type="text" required name="city" class="form-control" placeholder="City.." value="{{$user->lga}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="state" class="form-control" placeholder="state..">
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="{{$totalPriceCheckout/100}}"> {{-- required in kobo --}}
                                <input type="hidden" name="quantity" value="{{$totalQty}}">
                                <input type="hidden" name="" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> 
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" required type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            <p>I have read and agree to the <a href="#">Terms & Conditions</a></p>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-inf">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endsection