<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 30px 15px;
            margin: 0;
        }
        .card {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            border: 3px solid #03AFED;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card-header{
            padding: 20px;
            text-align: center;
        }

        .card-footer {
            background-color: #f1f9ff;
            padding: 20px;
            text-align: center;
        }
        .card-body {
            padding: 25px;
        }
        h2 {
            margin: 0 0 10px;
            color: #0b1727;
        }
        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
        }
        .text-right { text-align: right; }
        .total-row td {
            font-weight: bold;
        }
        .thank-you {
            font-size: 18px;
            font-weight: bold;
            color: #03AFED;
            margin-bottom: 15px;
        }
        .qr-code {
            text-align: center;
            margin-top: 25px;
        }
        .footer-note {
            font-size: 14px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-body" style="text-align: left;">
            <p class="thank-you">Hi {{ $customer_name }},</p>
            <div style="text-align: left;">
                <p>{!! nl2br($email_message) !!}</p>
            </div>
        </div>
    </div>
    <div style="font-family: 'Arial', sans-serif; text-align:center">
        <p style="">© {{ date('Y') }} All Rights Reserved — medproglob.com</p>
    </div>
    
</body>
</html>