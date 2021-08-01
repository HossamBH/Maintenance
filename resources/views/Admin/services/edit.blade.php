@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Service')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Service</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.services.update',['service'=>$service->id])}}" id="advanced-form"
                    data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Service Name</b>
                            <input type="text" class="form-control" placeholder="Enter Service Name" name="name" value="{{$service->name}}"><br>
        
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
                                <input type="text" class="form-control" placeholder="Enter Service Cost" name="cost" value="{{$service->cost}}">
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
                            <input type="checkbox" id="checkbox_check"{{$service->tax>0?'checked':''}}>
                            @error('tax')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                       </div>
                       <div class="col-4">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tax value" name="tax" {{$service->tax==0?'disabled':''}} id="tax" value="{{$service->tax !=0 ? $service->tax:''}}">
                        </div>
                       </div>
                   </div>
    
                    <button type="submit" class="btn btn-primary ">Update</button>
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
