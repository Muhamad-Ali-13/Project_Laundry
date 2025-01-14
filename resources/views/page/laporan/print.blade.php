<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        * {
            box-sizing: border-box;
        }

        .page {
            width: 297mm;
            min-height: 210mm;
            padding: 10mm;
            margin: 0 auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 10pt;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            margin-top: 20mm;
            text-align: center;
            font-size: 10pt;
            color: gray;
        }

        @page {
            size: A4 landscape;
            margin: ;
        }


        @media print {

            body,
            html {
                width: 300mm;
                height: 210mm;
                margin: 0;
                padding: 0;
            }

            .page {
                padding: 5mm;
                margin: 0 auto;
                box-shadow: none;
                border: none;
            }

            table {
                table-layout: auto;
                width: 100%;
            }

            th,
            td {
                padding: 5px;
                font-size: 9pt;
            }
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="header">
            <h1 style="text-align: center;">Laporan Transaksi</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>OUTLET</th>
                    <th>KODE INVOICE</th>
                    <th>MEMBER</th>
                    <th>TANGGAL</th>
                    <th>BATAS WAKTU</th>
                    <th>TGL BAYAR</th>
                    <th>BIAYA TAMBAHAN</th>
                    <th>DISKON</th>
                    <th>PAJAK</th>
                    <th>TOTAL</th>
                    <th>STATUS</th>
                    <th>DIBAYAR</th>
                    <th>ID USER</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $d->outlet->nama_outlet }}</td>
                        <td class="text-left">{{ $d->kode_invoice }}</td>
                        <td>{{ $d->member->id }}</td>
                        <td>{{ $d->tanggal }}</td>
                        <td>{{ $d->batas_waktu }}</td>
                        <td>{{ $d->tgl_bayar }}</td>
                        <td>{{ $d->biaya_tambahan }}</td>
                        <td>{{ $d->diskon }}</td>
                        <td>{{ $d->pajak }}</td>
                        <td class="text-right">{{ number_format($d->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ $d->status }}</td>
                        <td>{{ $d->dibayar }}</td>
                        <td>{{ $d->user->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Dicetak pada {{ date('d-m-Y') }}</p>
        </div>
    </div>

</body>

</html>
<script>
    // window.print(); // Aktifkan jika ingin otomatis mencetak
</script>
