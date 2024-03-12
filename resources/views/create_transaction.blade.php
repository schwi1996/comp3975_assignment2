@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Transaction</title>
    </head>

    <body>

        <h1>Create Transaction</h1>

        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/transactions">
            @csrf

            <label for="date">Date:</label>
            <input type="date" name="date" required><br>

            <label for="vendor">Vendor:</label>
            <input type="text" name="vendor" required><br>

            <label for="spend">Spend:</label>
            <input type="number" name="spend" required><br>

            <label for="deposit">Deposit:</label>
            <input type="number" name="deposit" required><br>

            <label for="balance">Balance:</label>
            <input type="number" name="balance" required><br>

            <button type="submit">Submit</button>
        </form>

    </body>

    </html>
@endsection
