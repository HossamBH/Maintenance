@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit User')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit User</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.users.update',['user'=>$user->id])}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                    style="width: 100%;">
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">User Email</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}"
                                    style="width: 100%;">
                                @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    style="width: 100%;">
                                @error('password_confirmation')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label for="roles_list[]">Role List</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>{{$role->name}}

                                                @if($user->hasRole($role->name))
                                                <input type="checkbox" value="{{$role->id}}" name="roles_list[]"
                                                    checked>
                                                @else
                                                <input type="checkbox" value="{{$role->id}}" name="roles_list[]">
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('roles_list')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mx-auto">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    var config ={
    _url:"{{url('/getItemsByCategory/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/get_items.js') }}"></script>

<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
