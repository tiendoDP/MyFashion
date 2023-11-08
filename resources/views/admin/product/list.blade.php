@extends('admin.layouts.app')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Product list</p>
        <a href="{{url('admin/product/add')}}" class="btn btn-primary">Add new Product</a>
    </div>
    @if(!empty(session('success'))) <p class="h3">{{session('success')}}</p> @endif
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col-2" style="width: 30%">Description</th>
            <th scope="col">Category Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($getRecord))
            @foreach($getRecord as $value)
              <tr>
                <th scope="row">{{$value->id}}</th>
                <td>
                  <img src="{{asset('assets/images/'.$value->image)}}" class="card-img-top" alt="..." style="max-width: 150px">
                </td>
                <td>{{$value->name}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->category_name}}</td>
                <td>{{$value->quantity}}</td>
                <td>{{$value->price}}</td>
                <td>{{($value->status) == 0 ? 'active' : 'inactive'}}</td>
                <td>
                  <a href="{{url('admin/product/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                  <a href="{{url('admin/product/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Product is not found</p>
          @endif
        </tbody>
      </table>
</div>

@endsection

@section('script')

@endsection