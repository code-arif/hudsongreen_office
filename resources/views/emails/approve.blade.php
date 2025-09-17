@component('mail::message')
# 🎉 Congratulations {{ $teacher->name }},

Your school **{{ $school->name }}** has been successfully approved by our admin team.

---

## School Details
- **School Name:** {{ $school->name }}
- **Principal:** {{ $school->principal_name }}
- **Registered Email:** {{ $school->email }}
- **Approved At:** {{ $school->approved_at->format('d M, Y h:i A') }}

---

We are excited to have your school onboard 🎓.
You can now access the dashboard and start managing your account.

@component('mail::button', ['url' => route('dashboard')])
Go to Dashboard
@endcomponent

If you have any questions, feel free to contact our support team.

Thanks,
{{ config('app.name') }}

@endcomponent
