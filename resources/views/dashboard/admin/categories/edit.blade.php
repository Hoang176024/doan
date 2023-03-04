@extends('dashboard.layouts.app')
@section('title', 'Update Category')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Category</a></li>
                            <li class="breadcrumb-item active">Update</li>
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
                        <form action="{{route('admin.categories.edit.update', $category->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{old('name', $category->name)}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="parent_id">Main category <span style="color: red;">*</span></label>
                                        <select name="parent_id" id="parent_id"
                                                class="form-control @error('parent_id') is-invalid @enderror">
                                            <option value="">-----Pick main category-----</option>
                                            <option value="0" @if($category->parent_id == 0) selected @endif>Không
                                            </option>
                                            @foreach($categories as $c)
                                                <option value="{{$c->id}}"
                                                        @if($c->id == $category->parent_id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description"
                                                  rows="5">{{$category->description}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection


@section('js')
    <script src="{{asset('js/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@stop
