@extends('client.layouts.app')

@section('styles')
    
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                    <form action="" method="POST">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div><!-- End .checkout-discount -->
                <form action="{{url('/checkout')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Full Name *</label>
                                        <input type="text" name="fullname" value="{{Auth::user()->name}}" class="form-control">
                                    </div>
                                    @error('fullname')
                                    <small class="form-text text-muted">
                                    <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div><!-- End .row -->

                                <label>Country *</label>
                                <input type="text" name="country" class="form-control">
                                @error('country')
                                    <small class="form-text text-muted">
                                    <div style="color:red">{{$message}}</div>
                                    </small>
                                @enderror
                                <label>Province *</label>
                                <input type="text" name="province" class="form-control">
                                @error('province')
                                    <small class="form-text text-muted">
                                    <div style="color:red">{{$message}}</div>
                                    </small>
                                @enderror
                                <label>Street address *</label>
                                <input type="text" name="street_address" class="form-control" placeholder="House number and Street name">
                                @error('street_address')
                                    <small class="form-text text-muted">
                                    <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Email address *</label>
                                        <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control">
                                        @error('email')
                                        <small class="form-text text-muted">
                                        <div style="color:red">{{$message}}</div>
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" name="phone" class="form-control">
                                        @error('phone')
                                        <small class="form-text text-muted">
                                        <div style="color:red">{{$message}}</div>
                                        </small>
                                        @enderror
                                    </div>
                                </div><!-- End .row -->

                            

                                <label>Order notes (optional)</label>
                                <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($all_cart as $cart)
                                        <tr>
                                            <td><a href="#">{{$cart->product_name}} <span style="opacity: 0.7;">x{{$cart->quantity}}</span></a></td>
                                            <td>${{$cart->money}}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{$total}}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>
                                                @if(session('type_shipping')) {{session('type_shipping')}}
                                                @else Free shipping
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>
                                                @if(session('fntotal')) ${{session('fntotal')}}
                                                @else ${{$total}}
                                                @endif
                                            </td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <input type="hidden" name="fntotal" value="{{session('fntotal') ? session('fntotal') : $total}}" />

                                <button type="submit" name="cod" class="btn btn-outline-primary-2 btn-order btn-block mb-3">
                                    <span class="btn-text">Payment on delivery</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>

                                <button type="submit" name="payUrl" class="btn btn-outline-primary-2 btn-order btn-block mb-3">
                                    <span class="btn-text">Payment with Momo</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>

                                <button type="submit" name="vnPay" class="btn btn-outline-primary-2 btn-order btn-block mb-3">
                                    <span class="btn-text">Payment with VNPay</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main>
@endsection

@section('scripts')

@endsection