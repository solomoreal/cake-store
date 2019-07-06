
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand pt-0" href="./index.html">
                {{-- <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> --}}
            </a>
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="index.html">
                                {{-- <img src="./assets/img/brand/blue.png"> --}}
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="ni ni-shop text-blue"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#collapseOrders" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOrders">
                            <i class="ni ni-delivery-fast text-blue"></i>Orders
                        </a>
                    </li>
                    <div class="collapse container" id="collapseOrders">
                        <li class="nav-item">
                            <a class="nav-link" href="orders.html">
                                New Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paid_order.html">
                                Paid Online
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pending_orders.html">
                                Pending Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rejected_orders.html">
                                Rejected Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cancelled_orders.html">
                                Cancelled Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="completed_orders.html">
                                Completed Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_orders.html">
                                All Orders
                            </a>
                        </li>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link active" href="#collapseProducts" data-toggle="collapse" aria-expanded="false" aria-controls="collapseProducts">
                            <i class="ni ni-bag-17 text-blue"></i>Products
                        </a>
                    </li>
                    <div class="collapse container" id="collapseProducts">
                        <li class="nav-item">
                            <a class="nav-link" href="products.html">
                                All Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add_product.html">
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.index')}}">
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="subcategory.html">
                                Sub-Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="colors.html">
                                Colors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sizes.html">
                                Sizes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shipping.html">
                                Shipping
                            </a>
                        </li>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="#collapseAdmin" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAdmin">
                            <i class="ni ni-circle-08 text-blue"></i> Manage Admins
                        </a>
                    </li>
                    <div class="collapse container" id="collapseAdmin">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                Add New Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                Edit Admins
                            </a>
                        </li>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="#collapseCustomers" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCustomers">
                            <i class="ni ni-single-02 text-blue"></i>Customers
                        </a>
                    </li>
                    <div class="collapse container" id="collapseCustomers">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                Reviews
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                View Customers
                            </a>
                        </li>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="ni ni-button-power text-blue"></i>Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
