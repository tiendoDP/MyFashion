@extends('client.layouts.app')

@section('styles')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My order<span>({{count($allOrder)}})</span></h1>
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
                        @if(count($allOrder) > 0)
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                @php
                                    $stt = 0;
                                @endphp
                                <tbody>
                                    @foreach ($allOrder as $item)
                                        @php
                                            $stt++;
                                        @endphp
                                        <tr>
                                            <td class="total-col">{{$stt}}</td>
                                            <td class="product-col">
                                                <div class="product">
                                                    <h3 class="product-title">
                                                        <a href="{{route('orderDetail', ['id' => $item->id])}}">{{ $item->full_name }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="product-col">{{ $item->phone }}</td>
                                            
                                            <td class="product-col">${{ $item->amount }}</td>
                                            <td class="product-col">
                                                @php
                                                    if($item->status == 1) echo "Processing"; 
                                                    elseif($item->status == 2) echo "Delivering";
                                                    else echo "Successful delivery";	
                                                @endphp
                                            </td>
                                            <td class="product-col">
                                                @if($item->notes != null)
                                                    {{$item->notes}}
                                                @else Không có
                                                @endif
                                            </td>
                                            <td class="product-col">{{ $item->created_at}}</td>
                                            
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

@endsection