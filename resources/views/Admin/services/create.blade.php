@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Service')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New Service</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.services.store')}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Service Name</b>
                                <input type="text" class="form-control" placeholder="Enter Service Name" name="name"><br>
        
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Cost</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Service Cost" name="cost">
                                </div>
                                @error('cost')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                   <div class="row">
                       <div class="col-4">
                        <div class="form-group">
                            <b>Taxable</b>
                            <input type="checkbox" id="checkbox_check">
                            @error('tax')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                       </div>
                       <div class="col-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Tax value" name="tax" disabled id="tax">
                        </div>
                       </div>
                   </div>
    
                    <button type="submit" class="btn btn-primary ">Create</button>
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
    $(function(){
        var i=0;
        $('#checkbox_check').change(function() {
            if (this.checked) {
                i++;
            } else {
                i--;
            }
            if(i%2==0){
                $("#tax").prop('disabled', true);
            }else{
                $('#tax').removeAttr("disabled");
            }
     });
    });
    </script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>

@stop
