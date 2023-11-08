@extends('admin.layouts.app')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Edit new Product</p>
        <a href="{{url('admin/product/list')}}" class="btn btn-primary">Back</a>
    </div>
    <form class="m-4" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{old('name', $product->name)}}" name="name" placeholder="Name">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Description" >{{old('description', $product->description)}}</textarea>
            @error('description')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Image</label> <br>
            <input  type="file" name="image" onchange="showFile(event)">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <img src="{{asset('assets/images/'.$product->image)}}" id="file" class="card-img-top" alt="" style="max-width: 150px">
        <input type="hidden" name="old_image" value="{{$product->image}}" />
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" >
                @foreach($getRecord_Category as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" value="{{old('quantity', $product->quantity)}}" name="quantity" placeholder="Quantity">
            @error('quantity')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" value="{{old('price', $product->price)}}" name="price" placeholder="Price">
            @error('price')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
                <option value="0" value="{{(old('email') == 0) ? 'selected' : ''}}">Active</option>
                <option value="1" value="{{(old('email') == 1) ? 'selected' : ''}}">Inactive</option>
            </select>
            <small class="form-text text-muted"></small>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    
</div>

@endsection

@section('script')
function showFile(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('file');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}
@endsection