<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password</title>

    <style type="text/css">
        /* Inline CSS for Email Clients */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f5;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }
        .email-header img {
            width: 120px;
        }
        .email-body {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }
        .email-body h1 {
            font-size: 24px;
            color: #111;
        }
        .email-body p {
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #777;
        }
        .reset-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .reset-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>

                <!-- Email Container -->
                <div class="email-container">

                    <!-- Header Section with Logo -->
                    <div class="email-header">
                        <img src="{{ asset('assets/images/logo/Kerjo B2 1.png') }}" alt="Kerjo Logo">
                    </div>

                    <!-- Email Body Section -->
                    <div class="email-body">
                        <h1>Reset Password Request</h1>
                        <p>Halo,</p>
                        <p>Kamu telah meminta untuk mereset password akun kamu. Klik link di bawah ini untuk melanjutkan proses reset password.</p>

                        <!-- Reset Button -->
                        <p style="text-align: center;">
                            <a href="{{ $url }}" class="reset-button">Reset Password</a>
                        </p>

                        <p>Jika kamu tidak meminta reset password, abaikan email ini.</p>
                    </div>

                    <!-- Footer Section -->
                    <div class="email-footer">
                        <p>Copyright © {{ date('Y') }} Kerjo. All rights reserved.</p>
                    </div>

                </div>
                <!-- End Email Container -->

            </td>
        </tr>
    </table>

</body>
</html>
