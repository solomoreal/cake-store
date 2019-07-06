<!--Header-->
<header>
        <nav class="navbar navbar-expand-lg px-4">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('img/logo.svg')}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav">
                <span class="toggler-icon"><i class="fas fa-bars"></i></span>
            </button>

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
                
            
        </nav>
        <!-- end of nav -->
    