<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi {{ $namaBulan }}</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logo img {
            width: 30px;
        }

        .logo h1 {
            color: #ff6600;
            font-size: 16px;
            margin: 0;
        }

        .alamat {
            font-size: 10px;
            color: #444;
        }

        .user-info {
            text-align: right;
            font-size: 10px;
        }

        h2 {
            text-align: left;
            font-size: 13px;
            margin: 15px 0 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #ff6600;
            color: white;
        }

        .footer {
            margin-top: 10px;
            font-size: 11px;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <div>
            <div class="logo">
                <img src="{{ public_path('/images/logo-orange.svg') }}" alt="Logo">
                <h1>areakerja.com</h1>
            </div>
            <p class="alamat">
                Jl. Laksda Adisucipto No.80, Ambarrukmo, Caturtunggal, Kec.<br>
                Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281
            </p>
        </div>
        <div class="user-info">
            <p><strong>Username :</strong> {{ Auth::check() ? Auth::user()->username : 'user' }}</p>
            <p><strong>Email :</strong> {{ Auth::check() ? Auth::user()->email : 'example@gmail.com' }}</p>
        </div>
    </div>

    <h2>Laporan Transaksi Penghasilan - {{ $namaBulan }}</h2>

    <table>
        <thead>
            <tr>
                <th>Transaksi</th>
                <th>Perusahaan</th>
                <th>Jenis Transaksi</th>
                <th>Sumber Dana</th>
                <th>Nominal IDR</th>
                <th>Transaksi Koin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $t)
                <tr>
                    <td>{{ $t->no_referensi }}</td>
                    <td>{{ $t->dari ?? 'dari' }}</td>
                    <td>{{ $t->pesanan }}</td>
                    <td>{{ $t->sumber_dana ?? '-' }}</td>
                    <td>
                        {{ $t->tunai > 0 ? 'Rp' . number_format($t->tunai, 0, ',', '.') : '-' }}
                    </td>
                    <td>{{ $t->koin > 0 ? $t->koin : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Tunai : Rp{{ number_format($totalTunai, 0, ',', '.') }}</p>
        <p>Total Koin : {{ $totalKoin }} Koin</p>
    </div>
</body>

</html>