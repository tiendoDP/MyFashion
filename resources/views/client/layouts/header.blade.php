<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->
            
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <ul>
                            <li><i class="icon-phone"></i>Call: +0123 456 789</li>
                            <li><a href="{{route('wishlist.index')}}"><i class="icon-heart-o"></i>Wishlist <span>({{!empty($all_wishlist) ? count($all_wishlist) : 0 }})</span></a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li>
                                
                                @if(!empty(Auth::check()) && Auth::User()->role == 0)
                                    <div class="header-dropdown">
                                        <a href="#">{{Auth::user()->name}}</a>
                                        <div class="header-menu">
                                            <ul>
                                                <li><a href="{{route('logout')}}">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else <a href="{{route('login')}}"><i class="icon-user"></i>Login</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('home')}}" class="logo">
                    <img src="{{asset('assets/images/logo/1.webp')}}" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="active">
                            <a href="{{route('home')}}" class="pr-0">Home</a>
                        </li>

                        <li>
                            <a href="#" class="sf-with-ul">Pages</a>

                            <ul>
                                <li>
                                    <a href="about.html" class="sf-with-ul">About</a>

                                    <ul>
                                        <li><a href="about.html">About 01</a></li>
                                        <li><a href="about-2.html">About 02</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="contact.html" class="sf-with-ul">Contact</a>

                                    <ul>
                                        <li><a href="contact.html">Contact 01</a></li>
                                        <li><a href="contact-2.html">Contact 02</a></li>
                                    </ul>
                                </li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog.html" class="sf-with-ul">Blog</a>

                            <ul>
                                <li><a href="blog.html">Classic</a></li>
                                <li><a href="blog-listing.html">Listing</a></li>
                                <li>
                                    <a href="#">Grid</a>
                                    <ul>
                                        <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                        <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                        <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                        <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry</a>
                                    <ul>
                                        <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                        <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                        <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                        <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mask</a>
                                    <ul>
                                        <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                        <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Single Post</a>
                                    <ul>
                                        <li><a href="single.html">Default with sidebar</a></li>
                                        <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                        <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <div class="p-1 pl-3 bg-white rounded rounded-pill shadow-sm">
                        <div class="input-group">
                          <input type="search" placeholder="Search ?" name="search" value="{{session('keyword')}}" aria-describedby="button-addon1" class="form-control border-0 bg-white p-0 pl-3">
                          <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary pl-0" style="border: none"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </div>
                </form>
                <div class="dropdown cart-dropdown">
                    <a href="{{route('cart.view')}}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">
                            {{(!empty($count_cart)) ? $count_cart : '0'}}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        @if(Auth::check() && !empty($all_cart) && count($all_cart) > 0)
                        
                        <div class="dropdown-cart-products">
                            @foreach($all_cart as $cart)
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="#">{{$cart->product_name}}</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">{{$cart->quantity}}</span>
                                        x ${{$cart->price}}
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="#" class="product-image">
                                        <img src="{{asset('assets/images/'.$cart->image)}}" alt="product">
                                    </a>
                                </figure>
                                <a href="{{ route('cart.delete', ['id' => $cart->id]) }}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div>                           
                            @endforeach
                        </div><!-- End .cart-product -->
                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">${{$total}}</span>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="{{route('cart.view')}}" class="btn btn-primary">View Cart</a>
                            <a href="{{route('checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                        @else <p class="text-center">Product is not found</p>
                        @endif
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
