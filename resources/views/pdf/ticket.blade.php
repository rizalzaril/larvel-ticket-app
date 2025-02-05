<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Tiket</h1>
        <table>
            <tr>
                <th>Nama Tiket</th>
                <td>{{ $ticket->name_tickets }}</td>
            </tr>
            <tr>
                <th>Slug</th>
                <td>{{ $ticket->slug }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $ticket->address }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $ticket->category->category_name ?? 'Tidak ada kategori' }}</td>
            </tr>
            <tr>
                <th>Is Popular</th>
                <td>{{ $ticket->is_popular }}</td>
            </tr>
            <tr>
                <th>Open time at</th>
                <td>{{ $ticket->open_time_at }}</td>
            </tr>
            <tr>
                <th>Close time at</th>
                <td>{{ $ticket->closed_time_at }}</td>
            </tr>
            <tr>
                <th>Seller</th>
                <td>{{ $ticket->seller->seller_name }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
