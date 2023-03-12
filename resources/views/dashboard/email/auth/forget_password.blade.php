@component('mail::message')


Hello {{$userFullName}} !

@component('mail::button', ['url' => route('resetPassword', $resetCode)])
Click on this button to reset your password.
@endcomponent

<p>Or click on the URL below</p>
<p>
    <a href="{{route('resetPassword', $resetCode)}}">
        {{route('resetPassword', $resetCode)}}
    </a>
</p>

Thank you <3<br>
{{ config('app.name') }}
@endcomponent
