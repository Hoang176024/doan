@extends('dashboard.layouts.app')
@section('title', 'Edit Units')
@section('content')
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h1 class="m-0">EDIT UNIT</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-2">
                            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('admin.units.create')}}">Create Unit</a>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                         <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
               @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <div>
                    Input has errors, please see below !!
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <form method="post" enctype="multipart/form-data" action="{{ route('admin.units.edit.update', $unit->id )}}">
                <div class="card-body">
                 @csrf
                 @method('PUT')
                  <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Unit_code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('unit_code') is-invalid @enderror"
                    id="title" name="unit_code" value="{{ old('unit_code',$unit->unit_code)}}">
                    @error('unit_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="address" class="col-sm-2 col-form-label">Unit_name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('unit_name') is-invalid @enderror"
                    id="unit_name" name="unit_name" value="{{ old('unit_name',$unit->unit_name)}}">
                    @error('unit_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
                        <!-- /.card -->
                    
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
 </div>
@stop

