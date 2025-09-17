<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Registration Approval</title>
    <style>
        @media only screen and (max-width: 640px) {
            .container {
                width: 100% !important;
            }

            .mobile-full {
                width: 100% !important;
                display: block !important;
            }

            .mobile-padding {
                padding: 15px !important;
            }

            .mobile-stack {
                display: block !important;
                width: 100% !important;
                padding: 10px 0 !important;
            }

            .button-container {
                text-align: center !important;
            }

            .button-mobile {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
                margin: 10px 0 !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; background-color:#f4f4f4;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:20px 0;">
        <tr>
            <td align="center">
                <!-- Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" class="container"
                    style="max-width:100%; background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    <!-- Header -->

                    <tr>
                        <td align="center" style="padding:5px; background-color:#f9f9f9;">
                            <img src="{{ asset('default/logo.png') }}" alt="Logo"
                                style="display:block; max-width:100px; height:auto;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td align="center" style="padding:30px 25px;" class="mobile-padding">
                            <h1 style="margin:0 0 20px; color:#333; font-size:24px; text-align:center;">New School
                                Registration Request</h1>

                            <table width="100%" cellpadding="20" cellspacing="0" border="0"
                                style="background-color:#f9f9f9; border-radius:8px; text-align:left; border:1px solid #eee;"
                                class="mobile-full">
                                <tr>
                                    <td>
                                        <h2 style="margin:0 0 15px; color:#7a2048; font-size:20px;">School Information
                                        </h2>

                                        <table width="100%" cellpadding="5" cellspacing="0"
                                            style="margin-bottom:20px;">
                                            <tr>
                                                <td width="30%" style="color:#555; padding:8px 0;"><strong>School
                                                        Name:</strong></td>
                                                <td style="padding:8px 0;">{{ $school->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>Principal Name:</strong>
                                                </td>
                                                <td style="padding:8px 0;">{{ $school->principal_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>School Email:</strong>
                                                </td>
                                                <td style="padding:8px 0;">{{ $school->email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>School Phone:</strong>
                                                </td>
                                                <td style="padding:8px 0;">{{ $school->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>Location:</strong></td>
                                                <td style="padding:8px 0;">
                                                    {{ $school->street_address }},
                                                    {{ $school->city }},
                                                    {{ $school->state }} {{ $school->zip_code }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>Number of
                                                        students:</strong></td>
                                                <td style="padding:8px 0;">
                                                    {{ $school->approximate_student_count ?? 'N/A' }}
                                                </td>
                                            </tr>

                                        </table>

                                        <h2 style="margin:20px 0 15px; color:#7a2048; font-size:20px;">Teacher Details
                                        </h2>

                                        <table width="100%" cellpadding="5" cellspacing="0"
                                            style="margin-bottom:25px;">
                                            <tr>
                                                <td width="30%" style="color:#555; padding:8px 0;">
                                                    <strong>Name:</strong>
                                                </td>
                                                <td style="padding:8px 0;">{{ $contact->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>Email:</strong></td>
                                                <td style="padding:8px 0;">{{ $contact->email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#555; padding:8px 0;"><strong>Phone:</strong></td>
                                                <td style="padding:8px 0;">{{ $contact->phone }}</td>
                                            </tr>
                                        </table>

                                        <hr>
                                        <p style="margin:0 0 20px; color:#666; text-align:center;">Please review the
                                            registration request and take appropriate action</p>

                                        <!-- Button Container -->
                                        <table width="100%" cellspacing="0" cellpadding="0" class="button-container">
                                            <tr>
                                                <td align="center">
                                                    <table cellspacing="0" cellpadding="0"
                                                        style="display:inline-table;">
                                                        <tr>
                                                            <!-- Approve Button -->
                                                            <td align="center" style="padding-right:10px;"
                                                                class="mobile-stack">
                                                                <a href="{{ route('admin.schools.approve', $school->approval_token) }}"
                                                                    style="background-color:transparent; color:#ffffff; padding:12px 30px; border:1px solid #7a2048; border-radius:5px; cursor:pointer; font-weight:bold; font-size:14px; background-color:#7a2048;">
                                                                    Approve
                                                                </a>
                                                            </td>
                                                            <!-- Cancel Button -->
                                                            <td align="center" style="padding-left:10px;"
                                                                class="mobile-stack">
                                                                <a href="{{ route('admin.schools.cancel', $school->approval_token) }}"
                                                                    class="button-mobile"
                                                                    style="background-color:#ffffff; color:#7a2048; padding:12px 30px; border:1px solid #7a2048; border-radius:5px; cursor:pointer; font-weight:bold; font-size:14px; min-width:120px;">
                                                                    Cancel
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding:20px; font-size:12px; color:#888; background-color:#f9f9f9;">
                            <p style="margin:0;">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
                            <p style="margin:5px 0 0; font-size:11px; color:#999;">This is an automated message. Please
                                do not reply to this email.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
