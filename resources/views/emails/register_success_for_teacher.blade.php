<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Registration Confirmation</title>
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

            .mobile-text-center {
                text-align: center !important;
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
                        <td align="center" style="padding:10px; background-color:#f9f9f9;">
                            <img src="{{ asset('default/logo.png') }}" alt="Logo"
                                style="display:block; max-width:100px; height:auto;" class="mobile-full">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td align="center" style="padding:30px 25px;" class="mobile-padding">
                            <h1 style="margin:0 0 20px; color:#7a2048; font-size:24px; text-align:center;"
                                class="mobile-text-center">Welcome {{ $contact->name }}!</h1>

                            <table width="100%" cellpadding="20" cellspacing="0" border="0"
                                style="background-color:#f9f9f9; border-radius:8px; text-align:left; border:1px solid #eee;"
                                class="mobile-full">
                                <tr>
                                    <td>
                                        <p style="margin:0 0 20px; color:#555; line-height:1.6; font-size:16px;">
                                            Thank you for registering your school <strong
                                                style="color:#7a2048;">{{ $school->name }}</strong> with our platform.
                                        </p>

                                        <div
                                            style="background-color:#7a2048; color:#ffffff; padding:15px; border-radius:6px; margin:20px 0;">
                                            <p style="margin:0; text-align:center; font-weight:bold;">
                                                Registration Status: Pending Approval
                                            </p>
                                        </div>

                                        <p style="margin:20px 0; color:#555; line-height:1.6; font-size:16px;">
                                            Your registration has been received and is currently awaiting administrative
                                            review.
                                            This process typically takes 3-5 hours.
                                        </p>

                                        <p style="margin:20px 0; color:#555; line-height:1.6; font-size:16px;">
                                            You will receive a notification email once your registration has been
                                            approved.
                                        </p>

                                        <div
                                            style="background-color:#f5f5f5; border-left:4px solid #7a2048; padding:15px; margin:25px 0;">
                                            <p style="margin:0; color:#555; font-style:italic;">
                                                "Take care of your body. It's the only place you have to live."
                                                <br>- Jim Rohn
                                            </p>
                                        </div>

                                        <p style="margin:20px 0 10px; color:#555; line-height:1.6; font-size:16px;">
                                            Thank you for choosing us as your educational partner. We look forward to
                                            supporting
                                            your institution's journey.
                                        </p>

                                        <p style="margin:10px 0 0; color:#555; line-height:1.6; font-size:16px;">
                                            Best regards,<br>
                                            <strong>The FitnessQ Platform</strong>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding:20px; font-size:12px; color:#888; background-color:#f9f9f9;">
                            <p style="margin:0;">&copy; {{ date('Y') }} Education Platform. All rights reserved.</p>
                            <p style="margin:5px 0 0; font-size:11px; color:#999;">This is an automated message. Please
                                do not reply to this email.</p>
                            <p style="margin:5px 0 0; font-size:11px; color:#999;">
                                Need help? <a href="mailto:support@eduplatform.com" style="color:#7a2048;">Contact our
                                    support team</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
