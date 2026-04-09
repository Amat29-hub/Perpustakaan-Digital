<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>

    <style>
        body {
            background: #444;
            font-family: Arial, Helvetica, sans-serif;
        }

        .paper {
            width: 900px;
            margin: 30px auto;
            background: #eee;
            padding: 40px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin: 0;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
        }

        hr {
            margin: 10px 0 20px;
        }

        .periode {
            text-align: center;
            color: #555;
        }

        .top-info {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .stat-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px auto;
            width: 400px;
        }

        .stat-box {
            border: 1px solid #bbb;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            background: #f5f5f5;
        }

        .stat-title {
            font-size: 14px;
            color: #444;
        }

        .stat-number {
            font-size: 30px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #999;
            padding: 8px;
            font-size: 13px;
        }

        table th {
            background: #e3e3e3;
        }

        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            color: #fff;
        }

        .status-dikembalikan {
            background: #2ecc71;
        }

        .status-terlambat {
            background: #e74c3c;
        }

        .status-dipinjam {
            background: #f1c40f;
            color: #000;
        }

        .ttd {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="paper">

        <h1>PERPUSTAKAAN SMKN 3 BANJAR</h1>
        <hr>

        <h2>LAPORAN PEMINJAMAN BUKU</h2>

        <div class="periode">
            Periode:
            {{ \Carbon\Carbon::parse($tanggal_awal)->format('d M Y') }}
            -
            {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d M Y') }}
        </div>

        <div class="top-info">
            <div></div>
            <div>
                Dicetak Pada:<br>
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </div>
        </div>

        <div class="stat-container">

            <div class="stat-box">
                <div class="stat-title">Total Transaksi</div>
                <div class="stat-number">{{ $totalTransaksi }}</div>
            </div>

            <div class="stat-box">
                <div class="stat-title">Total Anggota</div>
                <div class="stat-number">{{ $anggotaAktif }}</div>
            </div>

            <div class="stat-box">
                <div class="stat-title">Total Buku Dipinjam</div>
                <div class="stat-number">{{ $totalDipinjam }}</div>
            </div>

            <div class="stat-box">
                <div class="stat-title">Masih Dipinjam</div>
                <div class="stat-number">{{ $masihDipinjam }}</div>
            </div>

        </div>

        <table>
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th>Kode</th>
                    <th>Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($peminjamans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            PMJ-{{ str_pad($item->id_peminjaman, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <td>{{ $item->anggota->nama ?? '-' }}</td>

                        <td>{{ $item->buku->judul ?? '-' }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}
                        </td>

                        <td>
                            @if ($item->status == 'dikembalikan')
                                <span class="status status-dikembalikan">Dikembalikan</span>

                            @elseif ($item->status == 'terlambat')
                                <span class="status status-terlambat">Terlambat</span>

                            @else
                                <span class="status status-dipinjam">Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="ttd">
            Mengetahui,<br>
            Kepala Perpustakaan

            <br><br><br>

            (John Doe)
        </div>

    </div>

    <script>
        window.print();
    </script>
</body>
</html>