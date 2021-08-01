@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Role')
<style>
    .mul-select {
        width: 100%;
    }
</style>
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Role</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.roles.store')}}" id="advanced-form" data-parsley-validate
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" class="form-control" style="width: 100%;">
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
                                    @foreach($adminPermissions as $adminPermission)
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{$adminPermission->id}}"
                                                    name="admin_permissions_list[]">{{$adminPermission->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mx-auto">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();

    $(".mul-select").select2({
        placeholder: "select category", //placeholder
        tags: true,
        tokenSeparators: ['/',',',';'," "]
    });
});
</script>
<script>
    $("#select-all").click(function(){
      $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    });
</script>
@stop
