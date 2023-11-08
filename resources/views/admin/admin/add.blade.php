@extends('admin.layouts.app')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Add new Admin</p>
        <a href="{{url('admin/admin/list')}}" class="btn btn-primary">Back</a>
    </div>
    <form class="m-4" action="" method="POST">
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
          <label>Email address</label>
          <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Enter email">
          @error('email')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Password">
          @error('password')
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

@endsection