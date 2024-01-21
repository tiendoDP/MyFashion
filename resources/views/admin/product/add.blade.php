@extends('admin.layouts.app')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Add new Product</p>
        <a href="{{url('admin/product/list')}}" class="btn btn-primary">Back</a>
    </div>
    <form class="m-4" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Name">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Description" >{{old('description')}}</textarea>
            @error('description')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Image</label> <br>
            <input type="file" name="image" accept="image/*" onchange="showFile(event)"/>
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
            
        </div>
        <div>
            <img src="" class="card-img-top" alt="" id="file" style="max-width: 150px">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" >
                @foreach($getRecord_Category as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label>Sex</label>
          <select class="form-control" name="sex" >
            <option value="0">Male</option>
            <option value="1">Female</option>
          </select>
      </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" value="{{old('quantity')}}" name="quantity" placeholder="Quantity">
            @error('quantity')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" value="{{old('price')}}" name="price" placeholder="Price">
            @error('price')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label>Discount</label>
          <input type="text" class="form-control" value="{{old('discount')}}" name="discount" placeholder="Discount">
          @error('discount')
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