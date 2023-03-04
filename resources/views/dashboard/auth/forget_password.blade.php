<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM 3 | QUÊN MẬT KHẨU</title>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2818147cbc.js" crossorigin="anonymous"></script>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <!-- Toastr-->
    <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2><b>POS - TEAM 3</b></h2>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Bạn đã quên mật khẩu của mình ? Nhập email để khôi phục lại mật khẩu .</p>
            <form action="{{route('forgetPassword.process')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                           placeholder="Email" value="{{old('email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Khôi Phục Mật Khẩu</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{route('login')}}">Đăng Nhập</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Đăng Ký Tài Khoản Mới</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('js/dashboard/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript">

    @if(session('success'))
    toastr.success('{{session("success")}}', 'Gửi email thành công !', {timeOut: 5000});
    @endif

    @if(session('error'))
    toastr.error('{{session("error")}}', 'Khôi Phục mật khẩu thất bại !', {timeOut: 5000});
    @endif

</script>
</body>
</html>
