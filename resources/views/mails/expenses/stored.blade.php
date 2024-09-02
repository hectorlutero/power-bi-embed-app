<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>New Expense Registered</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>New Expense Registered</h2>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->total_amount }}</td>
                    <td>{{ $expense->date }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Best regards,<br>
                Your Website Team</p>
        </div>
    </div>
</body>

</html>
