<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фактура</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap&subset=cyrillic');
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .invoice-container {
            width: 100%;
            padding: 30px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        .invoice-title {
            text-align: center;
            font-size: 2.5em;
            color: rgba(1, 161, 128, 1);
            margin-bottom: 20px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid rgba(1, 161, 128, 1);
            padding-bottom: 20px;
        }
        .invoice-header div {
            width: 32%;
        }
        .invoice-header div strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
            color: rgba(1, 161, 128, 1);
        }
        .invoice-header div p {
            color: rgba(1, 161, 128, 1);
            margin: 0;
        }
        .invoice-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .invoice-details th {
            background-color: rgba(1, 161, 128, 1);
            color: #fff;
            font-size: 1em;
            font-weight: bold;
        }
        .invoice-details td {
            font-size: 0.95em;
        }
        .invoice-summary {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .invoice-summary p {
            margin: 0;
        }
        .invoice-summary p strong {
            font-size: 1.3em;
            color: rgba(1, 161, 128, 1);
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-title">Фактура</div>
        <div class="invoice-header">
            <div>
                <strong>Фактурирано од</strong>
                <p>Sava</p>
            </div>
            <div>
                <strong>Датум на достасување:</strong>
                {{ \Carbon\Carbon::parse($invoice->due_date)->format('d.m.Y') }}
            </div>
            <div>
                <strong>Број на случај:</strong>
                {{ $invoice->invoice_number }}
            </div>
        </div>
        <table class="invoice-details">
            <thead>
                <tr>
                    <th>Опис</th>
                    <th>Количина</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $price = 0;
                @endphp
                @foreach($invoice->policies as $policy)
                    <tr>
                        <td>{{ $policy->type }}</td>
                        <td>1</td>
                        <td>{{ number_format($policy->price, 2) }}</td>
                    </tr>
                    @php
                        $price += $policy->price;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="invoice-summary">
            <p><strong>Цена:</strong> {{ number_format($price, 2) }}</p>
            <p><strong>Данок (10%):</strong> {{ number_format($price * 0.10, 2) }}</p>
            <p><strong>Вкупен износ:</strong> {{ number_format($price * 1.10, 2) }}</p>
        </div>
    </div>
</body>
</html>
