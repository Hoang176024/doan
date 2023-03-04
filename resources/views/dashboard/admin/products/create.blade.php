@extends('dashboard.layouts.app')
@section('title', 'Add new product')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add new product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Product</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                   
                    <div class="card-body">
                        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{old('name')}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price_in">Purchase price <span style="color: red">*</span></label>
                                        <input type="number"
                                               class="form-control @error('price_in') is-invalid @enderror"
                                               id="price_in" name="price_in" placeholder=".....VNĐ"
                                               value="{{old('price_in')}}">
                                        @error('price_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price_out">Selling price <span style="color: red">*</span></label>
                                        <input type="number"
                                               class="form-control @error('price_out') is-invalid @enderror"
                                               id="price_out" name="price_out" placeholder=".....VNĐ"
                                               value="{{old('price_out')}}">
                                        @error('price_out')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity <span style="color: red">*</span></label>
                                        <input type="number"
                                               class="form-control  @error('quantity') is-invalid @enderror"
                                               id="quantity" name="quantity"
                                               value="{{old('quantity')}}">
                                        @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="category_id">Category <span
                                                style="color: red">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                            <option value="">-----Pick category-----</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Brand <span
                                                style="color: red">*</span></label>
                                        <select class="form-control @error('brand_id') is-invalid @enderror"
                                                name="brand_id" id="brand_id">
                                            <option value="">-----Pick brand-----</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier_id">Supplier <span style="color: red">*</span></label>
                                        <select class="form-control @error('supplier_id') is-invalid @enderror"
                                                name="supplier_id" id="supplier_id">
                                            <option value="">-----Pick supplier-----</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="photo">Picture</label>
                                        <input class="form-control  @error('photo') is-invalid @enderror" type="file"
                                               id="photo" name="photo">
                                        @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror"
                                                  id="ckeditor1" name="description"
                                                  placeholder="Description">{{old('description')}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="mfg">Date of manufacture</label>
                                        <input type="text"
                                               class="form-control datepicker @error('mfg') is-invalid @enderror"
                                               id="mfg" name="mfg" placeholder="dd-mm-yyyy">
                                        @error('mfg')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="exp">Expiry</label>
                                        <input type="text"
                                               class="form-control datepicker @error('exp') is-invalid @enderror"
                                               id="exp" name="exp" placeholder="dd-mm-yyyy">

                                        @error('exp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_id">Unit<span style="color: red">*</span></label>
                                        <select class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" id="unit_id">
                                            <option value="">-----Pick unit-----</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">
                                                    {{$unit->unit_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="barcode">Barcode <span style="color: red">*</span></label>
                                        <input type="number"
                                               class="form-control @error('barcode') is-invalid @enderror"
                                               id="barcode" name="barcode"
                                               value="{{old('barcode')}}">
                                        @error('barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </section>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/plugins/date-picker/bootstrap-datepicker.min.css')}}">
@stop


@section('js')

    <script src="{{asset('js/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="{{asset('js/plugins/date-picker/bootstrap-datepicker.min.js')}}"></script>


    <script type="text/javascript">
        CKEDITOR.replace('ckeditor1');
        $('.datepicker').datepicker({format: 'dd-mm-yyyy',});
    </script>
@stop
