<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM 3 | ĐĂNG NHẬP</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2818147cbc.js" crossorigin="anonymous"></script>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <!-- Google Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Toastr-->
    <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.min.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2><b>POS - TEAM 3</b></h2>
        </div>
        <div class="card-body">
            <h3><p class="login-box-msg">ĐĂNG NHẬP</p></h3>

            <form action="{{route('login.process')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                           name="email" placeholder="Email" value="{{old('email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control  @error('password') is-invalid @enderror"
                           name="password" id="password" placeholder="Mật Khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="row">
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-md btn-primary btn-block">
                            Login
                        </button>
                    </div>

                </div>
            </form>

            <p class="mb-1">
                <a href="{{route('forgetPassword')}}">Forget password</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Register</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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

{{--Script for gg rapcaptcha--}}
<script type="text/javascript">

    @if(session('error'))
    toastr.error('{{session("error")}}', 'Failed to login !!!', {timeOut: 5000});
    @endif

    function recaptchaDataCallBackLogin(response) {
        $('#hiddenRecaptchaLogin').val(response);
    }

    function recaptchaExpiredCallBackLogin(response) {
        $('#hiddenRecaptchaLogin').val('');
    }

    @if(session('success'))
    toastr.success('{{session("success")}}', 'Change password successfully !!!', {timeOut: 5000});
    @endif
    @if(session('successfull'))
    toastr.success('{{session("successfull")}}', 'Create account successfully !!!', {timeOut: 5000});
    @endif
</script>
</body>
</html>
