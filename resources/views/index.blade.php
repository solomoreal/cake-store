@extends('layouts.main')
@section('content')
    <!--Header-->
        <!-- end of nav -->

        <!-- banner -->
        <div class="container-fluid">
            <div class="row max-height justify-content-center align-items-center">
                <div class="col-10 mx-auto banner text-center">
                    <h1 class="text-capitalize">Welcome to <strong class="banner-title">CupCake's</strong></h1>
                    <a href="" class="btn banner-link text-uppercase my-2">Explore</a>
                </div>
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
        <!-- end of banner -->
    </header>
    <!-- header end -->

    <!-- about us -->
    <section class="about py-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto col-lg-6  my-4">
                    <h1>about <strong class="banner-title">us</strong></h1>
                    <p class="my-4 text-muted">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, sint deserunt! Exercitationem
                        repellendus similique numquam quo nulla explicabo perferendis beatae, obcaecati suscipit odit?
                        Repudiandae doloremque eaque facere asperiores illo earum provident? Fugiat, optio expedita!
                        Facere sit earum ipsum nulla sunt perferendis iusto eaque doloribus impedit inventore quasi
                        minus, dignissimos tenetur!
                    </p>
                    <a href="#" class="btn btn-outline-secondary btn-black text-uppercase">explore</a>
                </div>
                <div class="col-10 mx-auto col-lg-6 col-sm-6 my-5">
                    <div class="about-img__container">
                        <img src="{{asset('img/sweets-1.jpeg')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about us -->

    <!-- store -->
    <section id="store" class="store py-5">
        <div class="container">
            <!-- subtitle-->
            <div class="row">
                <div class="col-10 mx-auto col-sm-6 text-center">
                    <h1 class="text-capitalize">our <strong class="banner-title">store</strong></h1>
                </div>
            </div>
            <div class="row" id="cakes">
                <div class="col-lg-8 mx-auto d-flex justify-content-around my-2 sortBtn flex-wrap">
                <a href="{{route('index')}}#cakes" class="btn btn-outline-secondary btn-black text-uppercase filter-btn-btn m-2"
                        data-filter="all">all</a>
                    <a href="{{route('category',['category' => 'Cakes'] )}}#cakes" class="btn btn-outline-secondary btn-black text-uppercase filter-btn-btn m-2"
                        data-filter="cakes">cakes</a>
                    <a href="{{route('category',['category' => 'Cupcakes'] )}}#cakes" class="btn btn-outline-secondary btn-black text-uppercase filter-btn-btn m-2"
                        data-filter="cupcakes">cupcakes</a>
                    <a href="{{route('category',['category' => 'Sweets'] )}}#cakes" class="btn btn-outline-secondary btn-black text-uppercase filter-btn-btn m-2"
                        data-filter="sweets">sweets</a>
                    <a href="{{route('category',['category' => 'Doughnuts'] )}}#cakes" class="btn btn-outline-secondary btn-black text-uppercase filter-btn-btn m-2"
                        data-filter="doughnuts">doughnuts</a>
                </div>
            </div>
            <!-- search -->
            <div class="row">
                <div class="col-10 mx-auto col-md-6">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text search-box" id="search-icon"><i
                                        class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="item...." id="search-item">
                        </div>
                    </form>
                </div>
            </div>

            <!-- store items -->
            @if($cakes)
            @foreach($cakes->chunk(3) as $cupcakesChunk)
            <div class="row store-items" id="store-items">
                <!-- single item -->
                @foreach($cupcakesChunk as $cupcake)
                <div class="col-6 col-sm-6 col-lg-4 mx-auto my-3 stroe-item sweets" data-item="sweets">
                    <div class="card">
                        <div class="img-container">
                        <img src="{{asset(Storage::url($cupcake->image_url))}}" class="card-img-top store-img" alt="">
                            <span class="store-item-icon">
                            <a href="{{route('addToCart',['id' => $cupcake->id])}}"><i class="fas fa-shopping-cart"></i></a>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between text-capitalize">
                            <h5 id="store-item-name">{{$cupcake->title}}</h5>
                                <h5 class="store-item-value">$ <strong id="store-item-price"
                                class="font-weight-bold">{{$cupcake->price/100}}</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            @endif
    </section>
    <!-- end store -->
    <!-- modal-container -->
    <div class="container-fluid ">
        <div class="row lightbox-container align-items-center">
            <div class="col-10 col-md-10 mx-auto text-right lightbox-holder">
                <span class="lightbox-close"><i class="fas fa-window-close"></i></span>
                <div class="lightbox-item"></div>
                <span class="lightbox-control btnLeft"><i class="fas fa-caret-left"></i></span>
                <span class="lightbox-control btnRight"><i class="fas fa-caret-right"></i></span>
            </div>

        </div>
    </div>

@endsection