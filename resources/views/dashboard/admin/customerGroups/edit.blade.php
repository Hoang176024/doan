@extends('dashboard.layouts.app')
@section('title', 'Edit')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit customer tier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('dashboard\admin\_alert\default')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="{{route('admin.customerGroups.update', $customerGroup->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('dashboard/admin/customerGroups/form')
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/plugins/fontawesome-free/all.min.css')}}">
@stop
@section('js')
<script src="{{ asset('js/dashboard/demo.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap/bs-custom-file-input.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{asset('js/plugins/jquery/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/plugins/jquery/additional-methods.min.js')}}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@stop