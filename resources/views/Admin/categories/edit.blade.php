@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Tax')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Category</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.categories.update', ['category' => $category->id])}}"
                    id="advanced-form" data-parsley-validate novalidate>
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <b>Category Name</b>
                            <input type="text" class="form-control" value="{{$category->name}}" name="name"><br>
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tax_id">Tax</label>
                            <select name="tax_id" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="">Choose Tax</option>

                                @foreach($taxes as $tax)
                                <option value="{{$tax->id}}" {{$category->tax_id==$tax->id?'selected':''}}>
                                    {{$tax->percentage}}%</option>
                                @endforeach
                            </select>
                            @error('tax_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
