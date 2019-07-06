<!--Header-->
<header>
    <nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand" href="{{route('index')}}"><img src="img/logo.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav">
            <span class="toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="myNav">
            <ul class="navbar-nav mx-auto text-capitalize text-center">
                <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">store</a>
                </li>
            
                           <!-- single info -->
                {{-- <div class="nav-info align-items-center d-flex justify-content-between mx-lg-5">
                    <span class="info-icon mx-lg-3"><i class="fas fa-phone"></i></span>
                    <p class="mb-0">+ 123 456 789</p>
                </div> --}}
            </ul>
            <ul class="navbar-nav mx-auto text-capitalize text-center ">
                @guest
                            <li class="nav-item ml-auto">
                                <a class="nav-link login" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @else
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                @if(Auth::user()->role == 'Admin')
                                                <a class="dropdown-item" href="{{route('home')}}"> Dashboard</a>
                                                <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                                                @else
                                                <a class="dropdown-item" href="{{route('profile')}}"> Dashboard</a>
                                                @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
            </ul>
                <!-- end of single info -->
                <!-- single info -->
                <div class="nav-info-items d-none d-lg-flex ">

                <div id="cart-info"
                    class="nav-info align-items-center cart-info d-flex justify-content-between mx-lg-5">
                    <span class="cart-info__icon mr-lg-3"><i class="fas fa-shopping-cart"></i></span>
                    <p class="mb-0 text-capitalize"><span id="item-count">{{Session::has('cart') ? Session::get('cart')->totalQty : 0 }}</span> items - $<span
                            class="item-total">{{Session::has('cart') ? number_format((Session::get('cart')->totalPrice/100)) : 0 }}</span></p>
                </div>
                <!-- end of single info -->
            </div>
        </div>
    </nav>
    <!-- end of nav -->
