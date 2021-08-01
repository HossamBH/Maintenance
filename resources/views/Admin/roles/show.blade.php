@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Show Role')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Show Role</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input disabled type="text" name="name" class="form-control" value="{{$role->name}}"
                                style="width: 100%;">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="admin_permissions_list[]">Permission List</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>{{$permission->name}}
                                            @if($role->hasPermissionTo($permission->name))
                                            <input disabled type="checkbox" value="{{$permission->id}}"
                                                name="admin_permissions_list[]" checked>
                                            @else
                                            <input disabled type="checkbox" value="{{$permission->id}}"
                                                name="admin_permissions_list[]">
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
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
