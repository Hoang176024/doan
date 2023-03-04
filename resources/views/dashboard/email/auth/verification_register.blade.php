@component('mail::message')


Xin chào {{$user->full_name}} !

@component('mail::button', ['url' => route('register.verify_email', $user->email_verification_code)])
Vui lòng click vào url sau đây để kích hoạt tài khoản
@endcomponent

<p>Hoặc click vào đường dẫn url dưới đây</p>
<p>
    <a href="{{route('register.verify_email', $user->email_verification_code)}}">
        {{route('register.verify_email', $user->email_verification_code)}}
    </a>
</p>

Cảm Ơn Bạn <3<br>
{{ config('app.name') }}
@endcomponent
