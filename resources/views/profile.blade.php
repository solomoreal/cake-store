@extends('layouts.main1')
@section('content')
    
    <div class="wrapper">
       
        <div class="content-area">
            <div class="user-profile container">
                <div class="row">
                    <div class="col-md-3 col-sm-10">
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
                    <div class="col-md-9 col-sm-12 mx-auto">
                        <div class="profile-header">
                            <h2>My Orders</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="">Order Id</th>
                                        <th scope="">Date</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders)
                                    @foreach($orders as $order)
                                    
                                    <tr>
                            
                                    <td>{{$order->order_id}}</td>
                                   <td> {{date('d/M/Y h:i:s',strtotime($order->paid_at))}} </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$currency .' '. number_format(($order->amount/100),2)}}</td>

                                    <td>{{$order->status}}</td>
                                    <td><a href="{{route('orderDetails',['id' => $order->id])}}" class="btn btn-sm btn-danger text-white">View details</a></td>
                                    </tr>
                                
                                    @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                           </div>
                    </div>
                </div>
                 
                        </div>
            </div>
        </div>
    </div>

                       
@endsection
    
    
    