@extends('layouts.main1')


@section('content')
    <div class="wrapper">
        
        <div class="content-area">
            <div class="user-profile container">
                <div class="row">
                    <div class="col-md-3 col-sm-10 text-center mb-md-3 mx-auto">
                        <div class="user-nav">
                            <ul>
                            <li><a href="{{route('profile')}}" class="active">My Orders</a></li>
                                <div class="dropdown-divider"></div>
                            {{-- <li><a href="{{route('editProfile',['id'=> Auth::user()->id --}}
                                {{-- ])}}">Edit Account</a></li> --}}
                                <div class="dropdown-divider"></div>
                                {{-- <li><a href="reset_password.html">Reset password</a></li> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </ul>
                        </div>
                    </div>            
                    <div class="col-md-9">
                        <div class="card">
                            <div class="profile-header">
                                <h2>My Order Detail</h2>
                            </div>
                            @if($order)
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="">Order ID</th>
                                            <td>{{$order->order_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Quantity</th>
                                            <td>{{$order->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Payment date</th>
                                            <td>{{date('d/M/Y h:i:s',strtotime($order->paid_at))
                                                }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <td>{{$order->status}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Total</th>
                                            <td><b>{{$currency .' '.number_format(($order->amount/100),2)}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        @if($cart)
                        @foreach($cart->items as $item)
                        <div id="product-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset(Storage::url($item['item']['image_url']))}}"  alt="" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <th scope="">Products name</th>
                                                
                                                <td>{{$item['item']['title']}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Quantity</th>
                                                <td>{{$item['qty']}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Amount</th>
                                                <td>{{$currency .' '.number_format(($item['price']/100),2)}}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <hr>
                    {{-- <a href="{{route('customerInvoice',['id' => $order->id])}}" class="btn btn-outline-inf">See Invoice</a> --}}
                        
                </div>

            </div>
        </div>
@endsection

       