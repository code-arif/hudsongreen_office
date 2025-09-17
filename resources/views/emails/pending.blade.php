@component('mail::message')
# ⏳ Renewal Required - {{ $school->name }}

Dear {{ $teacher->name }},

Your school **{{ $school->name }}** has been set to **Pending** status.
This means your current subscription has expired, and renewal is required to continue using our services.

---

### School Details
- **School Name:** {{ $school->name }}
- **Principal:** {{ $school->principal_name }}
- **Registered Email:** {{ $school->email }}
- **Status Changed At:** {{ now()->format('d M, Y h:i A') }}

---

Without renewal, your school’s access to the platform (including event management, communication tools, and resources)
will remain **inactive**.

@component('mail::button', ['url' => config('app.frontend_url') . '/renew-subscription'])
    Contact For Renew
@endcomponent

If you need assistance with the renewal process, please reach out to our support team at
[{{ config('mail.from.address') }}](mailto:{{ config('mail.from.address') }}).

Thanks,
{{ config('app.name') }}
@endcomponent
