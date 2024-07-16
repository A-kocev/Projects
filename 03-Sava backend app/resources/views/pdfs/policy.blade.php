<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Полиса</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap&subset=cyrillic');
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .policy-container {
            width: 100%;
            padding: 30px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        .policy-title {
            text-align: center;
            font-size: 2.5em;
            color: rgba(1, 161, 128, 1);
            margin-bottom: 20px;
        }
        .policy-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid rgba(1, 161, 128, 1);
            padding-bottom: 20px;
        }
        .policy-header div {
            width: 32%;
        }
        .policy-header div strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
            color: rgba(1, 161, 128, 1);
        }
        .policy-header div p {
            color: rgba(1, 161, 128, 1);
            margin: 0;
        }
        .policy-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .policy-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .policy-details th, .policy-details td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .policy-details th {
            background-color: rgba(1, 161, 128, 1);
            color: #fff;
            font-size: 1em;
            font-weight: bold;
        }
        .policy-details td {
            font-size: 0.95em;
        }
        .policy-summary {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .policy-summary p {
            margin: 0;
        }
        .policy-summary p strong {
            font-size: 1.3em;
            color: rgba(1, 161, 128, 1);
        }
    </style>
</head>
<body>
    <div class="policy-container">
        <div class="policy-title">Полиса</div>
        <div class="policy-header">
            <div>
                <strong>Полиса од</strong>
                <p>Sava</p>
            </div>
            <div>
                <strong>Рок:</strong>
                {{ \Carbon\Carbon::parse($policy->start_date)->format('d.m.Y') }}
                <span>-</span>
                {{ \Carbon\Carbon::parse($policy->expiration_date)->format('d.m.Y') }}
            </div>
            <div>
                <strong>Број на полиса:</strong>
                {{ $policy->policy_number }}
            </div>
        </div>
        <table class="policy-details">
            <thead>
                <tr>
                    <th>Опис</th>
                    <th>Количина</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $policy->type }}</td>
                    <td>1</td>
                    <td>{{ number_format($policy->price, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="policy-summary">
            <p><strong>Вкупна цена:</strong> {{ number_format($policy->price, 2) }}</p>
        </div>
    </div>
</body>
</html>
