@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Role')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Role</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.roles.update',['role'=>$role->id])}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" class="form-control" value="{{$role->name}}"
                                    style="width: 100%;">
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>{{ $error }}</span>
                    </div>
                    @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-15 mb-1">
                            <div class="form-group">
                                <label for="admin_permissions_list[]">Dashboard Permission List</label>
                                </br>
                                <input id="select-all" type="checkbox"><label for='select-all'>Select All</label>
                                </br>
                                <div class="row">
                                    @foreach($adminPermissions as $permission)
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>{{$permission->name}}
                                                @if($role->hasPermissionTo($permission->name))
                                                <input type="checkbox" value="{{$permission->id}}"
                                                    name="admin_permissions_list[]" checked>
                                                @else
                                                <input type="checkbox" value="{{$permission->id}}"
                                                    name="admin_permissions_list[]">
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('admin_permissions_list')
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
<script>
    $("#select-all").click(function(){
      $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    });
</script>
@stop
