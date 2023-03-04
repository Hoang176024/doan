<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM 3 | ĐĂNG KÝ</title>

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
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2><b>POS - TEAM 3</b></h2>
        </div>
        <div class="card-body">
            <h3><p class="login-box-msg">ĐĂNG KÝ</p></h3>

            <form action="{{route('register.process')}}" method="post" id="form-register">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                           name="full_name" placeholder="Full Name" value="{{old('full_name')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
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
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('retype_password') is-invalid @enderror"
                           name="retype_password" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('retype_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">

                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" class="form-control @error('terms') is-invalid @enderror"
                               name="terms" value="agree">
                        <label for="agreeTerms">
                            Đồng ý với các <a href="#">Điều Khoản</a>
                        </label>
                        @error('terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_CAPTCHA_KEY')}}"
                     data-callback="recaptchaDataCallBackRegister"
                     data-expired-callback="recaptchaExpiredCallBackRegister"></div>
                <input type="hidden" name="grecaptcha" id="hiddenRecaptchaRegister">

                <div id="hiddenRecaptchaRegisterError" class="grecaptcha">
                    @if($errors->any('grecaptcha'))
                        <span class="text-danger">{{$errors->first('grecaptcha')}}</span>
                    @endif
                </div>

                <br>
                <div class="row">
                    <div class="mx-auto">
                        <button type="button" id="button-register" class="btn btn-md btn-primary btn-block">
                            Đăng Ký
                        </button>
                    </div>
                </div>
            </form>
            <br>


            <a href="{{route('login')}}" class="text-center">Đã có tài khoản --> Đăng nhập</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('js/dashboard/adminlte.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>

{{--Plugin Javascript Jquery loading overlay--}}
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

{{--Script for gg rapcaptcha--}}
<script type="text/javascript">

    @if(session('error'))
    toastr.error('{{session("error")}}', 'Đăng nhập thất bại !!!', {timeOut: 5000});
    @endif

    @if(session('success'))
    toastr.success('{{session("success")}}', 'Đăng ký tài khoản mới thành công !!!', {timeOut: 5000});
    @endif

    function recaptchaDataCallBackRegister(response) {
        $('#hiddenRecaptchaRegister').val(response);
    }

    function recaptchaExpiredCallBackRegister(response) {
        $('#hiddenRecaptchaRegister').val('');
    }


    $("#button-register").click(function () {
        $.LoadingOverlay("show");
        $("#form-register").submit();
    });
</script>
</body>
</html>
