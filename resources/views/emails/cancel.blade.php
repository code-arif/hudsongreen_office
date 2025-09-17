@component('mail::message')
# ❌ Dear {{ $teacher->name }},

We regret to inform you that your school registration request for
**{{ $school->name }}** has been **cancelled** by our admin team.

---

## School Details
- **School Name:** {{ $school->name }}
- **Principal:** {{ $school->principal_name }}
- **Registered Email:** {{ $school->email }}
- **Cancelled At:** {{ optional($school->cancelled_at)->format('d M, Y h:i A') }}

---

If you believe this is a mistake or need clarification,
please contact our support team at **{{ config('mail.from.address') }}**.

@component('mail::button', ['url' => 'https://your-frontend-domain.com/contact'])
Contact Support
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
