<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Report</title>

    <style type="text/css" data-hse-inline-css="true">
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }
    </style>

</head>

<body>
    <section class="i">
        <div class="container">
            <h2>
                Attendance
            </h2>
            <br />
            <p> <strong>Dear Parent</strong>, </p>
            <br />
            <p>This mail is from St Philomena College Women's Hostel. This is to inform you that your daughter {{ $details['studentName'] }} is not present in the hostel.</p>
        </div>
    </section>
</body>

</html>