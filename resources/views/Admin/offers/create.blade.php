@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Offer')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Offer</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.offers.store')}}" id="advanced-form" data-parsley-validate
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Category</label>
                                <select name="category_id" class="form-control" style="width: 100%;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" id="category">
                                    <option value="">Choose Category</option>

                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="item_id">Items</label>
                            <div class="form-group">
                                <select class="mul-select" multiple="true" name="item_id[]" id="item">
                                    <option value="">Choose Items</option>

                                </select>
                            </div>

                            @error('item_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Disccount Type</label>
                                <select name="discount_type" class="form-control" style="width: 100%;"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Choose</option>
                                    <option value="precentage">Precentage</option>
                                    <option value="amount">amount</option>
                                </select>
                                @error('discount_type')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Discount Value</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Ex:" name="discount_value"
                                        value="{{old('discount_value')}}"><br>
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
<style>
    .mul-select {
        width: 100%;
    }
</style>
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
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
    $(".mul-select").select2({
                    placeholder: "select Items", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "]
                });
});
</script>
@stop
