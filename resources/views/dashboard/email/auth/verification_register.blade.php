@component('mail::message')


Hello {{$user->full_name}} !

@component('mail::button', ['url' => route('register.verify_email', $user->email_verification_code)])
Please click on the following URL to activate your account.
@endcomponent

<p>Or click on the URL below</p>
<p>
    <a href="{{route('register.verify_email', $user->email_verification_code)}}">
        {{route('register.verify_email', $user->email_verification_code)}}
    </a>
</p>

Thank you <3<br>
{{ config('app.name') }}
@endcomponent
