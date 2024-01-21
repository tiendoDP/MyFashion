@extends('client.layouts.app')

@section('styles')
    
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">List<span>Products</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">  
    </nav><!-- End .breadcrumb-nav --> 

   @if(!empty($keyword)) {
    @livewire('products.filter', ['cate' => $all_cate, 'keyword' => $keyword])
   }
   @else @livewire('products.filter', ['cate' => $all_cate])
   @endif
   
</main>
@endsection


@section('scripts')

<script>

</script>

@endsection