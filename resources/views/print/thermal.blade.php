<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Godong Jati</title>

    <style>
        .page {
            width: 58mm;

        }

        img {
            max-width: inherit;
            width: 30px;
            height: 30px;
        }

        table {
            border: 1px solid;
            border-collapse: collapse;
            font-family: Arial;
            text-transform: uppercase;
            position: left;
            left: 0px;
        }

        th,
        td {
            padding: .4rem .8rem;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: normal;
            font-size: 6pt;
            color: #000000;
            background: #ffffff;
        }

        td {
            font-size: 6pt;
        }

        @media print {
            .page {
                width: 58mm;

            }

            .hidden-print {
                display: none !important;
            }
        }

        p {
            font-family: Arial;
        }

    </style>
</head>

<body>
    {{-- @foreach ($datatransaksi as $key => $transaksi) --}}
    <div class="page">
        <table>
            <tr>
                {{-- <th>No</th> --}}
                <td>Nama Barang</td>
                <td>Qty</td>
                <td>Harga</td>
            </tr>
            <tr style="display: flex;justify-content: space-between">
                <td>
                    <img src="{{ asset('assets/img/logo1.jpeg') }}" alt="Logo"></td>
                <td style="margin-bottom: 0;font-size:6pt">Godong Jati Car Wash & Kuliner</td>
            </tr>
            <tr style="display: flex;justify-content: space-between">
                <td style="margin-bottom: 0;font-size:6pt"> {{ $penjualan->no_nota }}</td>
                <td style="margin-bottom: 10px; margin-top:0px;font-size:6pt">
                    {{ isset($penjualan->pelanggan()->nama_pelanggan) ? $penjualan->pelanggan()->nama_pelanggan : '' }}
                </td>
                <td style="margin-bottom: 10px; margin-top:0px;font-size:6pt"> {{ $penjualan->no_meja }}
                </td>
            </tr>
            @foreach ($detailPenjualan as $item)
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td style="text-align:left;">{{ $item->nama_barang }}</td>
                <td>{{ $item->qty_penjualan }}</td>
                <td style="text-align:right;">{{ $item->total_penjualan }}</td>
            </tr>
            @php
            $totalBayar += $item->total_penjualan;
            @endphp
            @endforeach

            <tr>
                <td colspan="2" style="text-align:left;">Total Harga</td>
                <td style="text-align:right;">{{ $totalBayar }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">Terimakasih</td>
            </tr>
        </table>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });

    </script>
</body>

</html>
