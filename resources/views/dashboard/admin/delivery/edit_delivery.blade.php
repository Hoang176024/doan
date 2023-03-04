@extends('dashboard.layouts.app')
@section('title', 'Sửa Đổi Vận Chuyển')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa Đổi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.deliveries.index')}}">Vận Chuyển</a>
                            </li>
                            <li class="breadcrumb-item active">Sửa Đổi</li>
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
                        <form action="{{route('admin.deliveries.update', $delivery->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_id">Tỉnh/Thành Phố  <span style="color: red">*</span></label>
                                        <select class="form-control choose  @error('province_id') is-invalid @enderror"
                                                id="province_id" name="province_id">
                                            <option value="">-----Chọn Tỉnh/Thành Phố-----</option>
                                            @foreach($provinces as $province)
                                                @if($delivery->province->id == $province->id)
                                                    <option value="{{$province->id}}"
                                                            selected>{{$province->name}}</option>
                                                @else
                                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ward_id">Phường/Thị Trấn/Xã <span style="color: red">*</span></label>
                                        <select class="form-control choose @error('ward_id') is-invalid @enderror"
                                                id="ward_id" name="ward_id">
                                            <option value="">-----Chọn Phường/Thị Trấn/Xã-----</option>
                                            @foreach($wards as $ward)
                                                @if($delivery->ward->id == $ward->id)
                                                    <option value="{{$ward->id}}"
                                                            selected>{{$ward->name}}</option>
                                                @else
                                                    <option value="{{$ward->id}}">{{$ward->name}}</option>
                                                @endif
                                            @endforeach
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
                                            @foreach($districts as $district)
                                                @if($delivery->district->id == $district->id)
                                                    <option value="{{$district->id}}"
                                                            selected>{{$district->name}}</option>
                                                @else
                                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="fee">Phí Vận Chuyển  <span style="color: red">*</span></label>
                                        <input type="number" class="form-control @error('fee') is-invalid @enderror"
                                               id="fee" name="fee" value="{{$delivery->fee, 2, ''}}">
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

