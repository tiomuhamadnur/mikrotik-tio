<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Voucher</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            margin: 15mm 5mm 5mm 5mm;
        }

        .container {
            text-align: center;
            /* Menyelaraskan konten ke tengah */
        }

        .card {
            border: 1px solid black;
            /* Border untuk kartu */
            border-radius: 5px;
            /* Sudut membulat */
            margin: 3px;
            /* Jarak antar kartu */
            padding: 15px;
            /* Padding dalam kartu */
            display: inline-block;
            /* Mengizinkan kartu untuk berbaris */
            width: 120px;
            /* Lebar kartu */
            height: auto;
            /* Tinggi otomatis */
            text-align: left;
            /* Teks di tengah */
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            /* Font default Bootstrap */
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($user as $item)
            <div class="card">
                <h6 class="mb-0">USER: <strong>{{ $item['name'] ?? '' }}</strong></h6>
                <h6 class="mb-0">PASS: <strong>{{ $item['password'] ?? '' }}</strong></h6>
                <h6 class="mb-0">PROFILE: <strong>{{ $item['profile'] ?? '' }}</strong></h6>
            </div>
        @endforeach
    </div>
</body>

</html>
