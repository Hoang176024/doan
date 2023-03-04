@extends('dashboard.layouts.app')
@section('title', 'Import Customer')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Import Data by CSV</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <section style="padding-top: 60px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 offset-md-3">
                        <div class="card">
                            <div class="card-header bg-primary">
                                IMPORT CSV
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.suppliers.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="file">Choose CSV</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection