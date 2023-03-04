@component('mail::message')


Xin Chào {{$userFullName}} !

@component('mail::button', ['url' => route('resetPassword', $resetCode)])
Nhấn vào nút này để khôi phục lại mật khẩu
@endcomponent

<p>Hoặc click vào đường dẫn url dưới đây</p>
<p>
    <a href="{{route('resetPassword', $resetCode)}}">
        {{route('resetPassword', $resetCode)}}
    </a>
</p>

Cảm ơn bạn <3<br>
{{ config('app.name') }}
@endcomponent
