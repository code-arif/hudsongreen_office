@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $user->username }} 🎉

Thank you for registering your school account.
Before we can activate your account, we need to verify your email address.

@component('mail::button', ['url' => $verificationUrl])
Verify My Email
@endcomponent

This link will expire in **24 hours** for security reasons.
If you didn’t create an account, no action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
