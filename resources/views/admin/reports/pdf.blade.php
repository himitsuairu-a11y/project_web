<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Adopsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .stats {
            margin-bottom: 30px;
        }
        .stats p {
            margin: 5px 0;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Rekapitulasi Adopsi Kucing</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>

    <div class="stats">
        <p>Total Hewan Masuk: {{ $totalCats }} ekor</p>
        <p>Total Hewan Berhasil Diadopsi: {{ $adoptedCats }} ekor</p>
    </div>

    <h2>Daftar Adopsi Selesai (Completed)</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order Code</th>
                <th>Nama Kucing</th>
                <th>Nama Adopter</th>
                <th>Tanggal Pengambilan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($completedAdoptions as $index => $adoption)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $adoption->order_code }}</td>
                    <td>{{ $adoption->cat->name }}</td>
                    <td>{{ $adoption->user->name }}</td>
                    <td>{{ $adoption->pickup_datetime ? $adoption->pickup_datetime->format('d M Y') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data adopsi yang selesai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
