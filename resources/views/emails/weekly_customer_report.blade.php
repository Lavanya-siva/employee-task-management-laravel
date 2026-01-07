<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weekly Customer Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h2 {
            color: #2c3e50;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 8px;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777777;
        }
        .no-customers {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Hello {{ $manager->firstname }} {{ $manager->middlename }},</h2>

    <p>Please find the attached CSV file containing the list of newly added customers assigned to you this week.</p>

    @if($customers->isEmpty())
        <p class="no-customers">No new customers this week.</p>
    @else
        <p>Total new customers: <strong>{{ $customers->count() }}</strong></p>
    @endif

    <p class="footer">
        Regards,<br>
        Admin Team
    </p>
</div>
</body>
</html>
