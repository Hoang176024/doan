@extends('dashboard.layouts.app')
@section('title', 'Thêm Mới Vận Chuyển')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm Mới</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.deliveries.index')}}">Vận Chuyển</a>
                            </li>
                            <li class="breadcrumb-item active">Thêm Mới</li>
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
                        <form action="{{route('admin.deliveries.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_id">Tỉnh/Thành Phố  <span style="color: red">*</span></label>
                                        <select class="form-control choose  @error('province_id') is-invalid @enderror"
                                                id="province_id" name="province_id">
                                            <option value="">-----Chọn Tỉnh/Thành Phố-----</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->id}}">
                                                    {{$province->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ward_id">Phường/Thị Trấn/Xã  <span style="color: red">*</span></label>
                                        <select class="form-control choose @error('ward_id') is-invalid @enderror"
                                                id="ward_id" name="ward_id">
                                            <option value="">-----Chọn Phường/Thị Trấn/Xã-----</option>
                                        </select>
                                        @error('ward_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_id">Quận/Huyện  <span style="color: red">*</span></label>
                                        <select class="form-control choose @error('district_id') is-invalid @enderror"
                                                id="district_id" name="district_id">
                                            <option value="">-----Chọn Quận/Huyện-----</option>
                                        </select>
                                        @error('district_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="fee">Phí Vận Chuyển  <span style="color: red">*</span></label>
                                        <input type="number" class="form-control @error('fee') is-invalid @enderror"
                                               id="fee" name="fee">
                                        @error('fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm Mới</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop

@section('css')

@stop


@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            //When click select City, District, Town
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action === 'province_id') {
                    result = 'district_id';
                } else if (action === 'district_id') {
                    result = 'ward_id';
                }

                $.ajax({
                    url: "{{route('admin.deliveries.selectDelivery')}}",
                    method: "POST",
                    data: {action: action, id: id, _token: _token},
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
@stop

