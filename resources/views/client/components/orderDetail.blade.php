@extends('client.layouts.app')

@section('styles')
    
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Information Detail<span>({{$details[0]->id}})</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <table class="">
                        <tr>
                            <td style="font-weight: 600; min-width: 100px">Name</td>
                            <td>: {{$details[0]->full_name}}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Address</td>
                            <td>: {{$details[0]->street_address}}, {{$details[0]->province}}, {{$details[0]->country}}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Amount</td>
                            <td>:
                                {{number_format($details[0]->amount, 0, ',', '.')}} VND
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Status</td>
                            <td>: @if($details[0]->status == 1) <span style="color: red;">Processing</span>
                                  @elseif($details[0]->status == 2) <span style="color: rgb(60, 71, 58);">Delivering</span>
                                  @else	<span style="color: rgb(132, 151, 214);">Successful delivery</span>
                                  @endif  
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Payment</td>
                            <td>: @if ($details[0]->payment_method == 1) <span style="color: rgb(134, 221, 34);">Payment on delivery</span>	
                                @else <span style="color: rgb(132, 151, 214);">Payment online (Already paid)</span>	     
                                @endif</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Date</td>
                            <td>: {{$details[0]->created_at}}</td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        @if ($details->count() > 0)
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $item)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="{{route('product', ['id' => $item->product_id])}}">
                                                        <img src="{{ asset('assets/images/products/' . $item->image) }}" alt="Product image">
                                                    </a>
                                                </figure>
                
                                                <h3 class="product-title">
                                                    <a href="{{route('product', ['id' => $item->product_id])}}">{{ $item->product_name }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">đ {{number_format($item->price, 0, ',', '.')}}</td>
                                        <td class="quantity-col">
                                            {{$item->quantity}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Order is not found</p>
                    @endif                   
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main>

@endsection


@section('scripts')

<script>
    
</script>

@endsection
