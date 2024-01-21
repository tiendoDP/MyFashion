@extends('admin.layouts.app')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Account list</p>
        <a href="{{url('admin/admin/add')}}" class="btn btn-primary">Add new Account</a>
    </div>
    @if(!empty(session('success'))) <p class="h3">{{session('success')}}</p> @endif
    <table class="table ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($getAdmin))
            @foreach($getAdmin as $admin)
              <tr>
                <th scope="row">{{$admin->id}}</th>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{($admin->status) == 0 ? 'active' : 'inactive'}}</td>
                <td>{{($admin->roles) == 0 ? 'user' : 'admin'}}</td>
                <td>
                  <a href="{{url('admin/admin/edit/'.$admin->id)}}" class="btn btn-primary">Edit</a>
                  @if ($admin->is_deleted == 0)
                      <a href="{{ url('admin/admin/delete/'.$admin->id) }}" class="btn btn-danger">Lock</a>
                  @else
                      <a href="{{ url('admin/admin/unlock/'.$admin->id) }}" class="btn btn-info">Unlock</a>
                  @endif

                  
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Không có admin nào</p>
          @endif
        </tbody>
      </table>
</div>

@endsection

@section('script')

@endsection