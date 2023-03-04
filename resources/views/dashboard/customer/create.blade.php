@extends('dashboard.layouts.app')
@section('title', 'Create a new Customer')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Quản lý Khách hàng</h1>
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

    <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><h4>Tạo mới Khách hàng</h4></div>
                      @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <div>
                            Input has errors, please see below !!
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      @endif
                    <div class="card-body">
                      <form method="post" enctype="multipart/form-data" action="{{ route('admin.customers.store') }}">
                        @csrf
                          <div class="row mb-3">
                              <label for="title" class="col-sm-2 col-form-label">Tên</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror"
                                  id="title" name="name" value="{{ old('name','')}}">
                                  @error('name')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>

                          <div class="row mb-3">
                              <label for="parent" class="col-sm-2 col-form-label">SĐT</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                  id="phone" name="phone" value="{{ old('phone','')}}">
                                  @error('phone')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>

                          <div class="row mb-3">
                              <label for="parent" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control @error('email') is-invalid @enderror"
                                  id="email" name="email" value="{{ old('email','')}}">
                                  @error('email')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                          
                          <div class="row mb-3">
                              <label for="address" class="col-sm-2 col-form-label">Ghi chú</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control @error('note') is-invalid @enderror"
                                  id="note" name="note" value="{{ old('note','')}}">
                                  @error('note')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                          
                          <div class="row mb-3">
                              <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" value="{{ old('address','')}}">
                                  @error('address')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                          
                          <div class="row mb-3">
                            <label for="customer_group_id" class="col-sm-2 col-form-label">Nhóm KH</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('customer_group_id') is-invalid @enderror"
                                id="customer_group_id" name="customer_group_id" value="{{ old('customer_group_id','')}}">
                                @error('customer_group_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>  

                          <button type="submit" class="btn btn-primary">Lưu</button>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script>
function initialize() {
  var input = document.getElementById('address');
  new google.maps.places.Autocomplete(input);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection

