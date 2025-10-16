<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            position: relative;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #e85d04;
        }

        .header .info {
            text-align: right;
            font-size: 11px;
        }

        hr {
            margin: 10px 0 20px;
            border: 0;
            border-top: 1px solid #000;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .summary {
            margin-top: 20px;
            width: 40%;
        }

        .summary td {
            padding: 4px;
        }

        .bold {
            font-weight: bold;
        }

        .orange {
            color: #e85d04;
        }

        /* ✅ Footer selalu di bawah */
        .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="brand">AREAKERJA.COM</div>

        <div class="info">
            <p><strong>Username :</strong> {{ Auth::check() ? Auth::user()->username : 'user' }}</p>
            <p><strong>Email :</strong> {{ Auth::check() ? Auth::user()->email : 'example@gmail.com' }}</p>
        </div>
    </div>
    <hr>

    <h3>DAFTAR OMSET BULANAN</h3>

    <table>
        <tr>
            <th>Bulan</th>
            <th>Omset</th>
        </tr>
        @foreach($transaksis as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->created_at)->translatedFormat('F Y') }}</td>
                <td>Rp {{ number_format($t->tunai, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <table class="summary">
        <tr>
            <td>Total Omset :</td>
            <td class="bold orange">Rp {{ number_format($totalOmset, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Rata-rata :</td>
            <td class="bold orange">Rp {{ number_format($rataRata, 2, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        Copyright © AREAKERJA.COM
    </div>
</body>

</html>