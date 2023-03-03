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
            width: 80mm;
        }

        img {
            max-width: inherit;
            width: 50px;
            height: 50px;
        }

        table {
            border-collapse: collapse;
            width: 98%;
            margin: auto;
            font-family: Arial;
            text-transform: uppercase;
        }

        th,
        td {
            padding: .4rem .8rem;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: normal;
            font-size: .6rem;
            color: #666;
            background: #ffffff;
        }

        td {
            font-size: .6rem;
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
    <div class="page" style="margin:auto">
        <table>
            <thead>
                <tr>
                    {{-- <th>N0</th> --}}
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalBayar = 0;
                @endphp
                <div style="display: flex;font-size:.8rem; justify-content:center;">
                    <img src="{{ asset('assets/img/logo1.jpeg') }}" alt="Logo">&nbsp;
                    <p style="font-size:.8rem">Godong Jati</p>

                </div>
                <p style="font-size:.6rem;text-align: center; ">Jl. KH. Achmad Dahlan No. 73 Lamongan</p>
                <div style="display: flex;justify-content: space-between">
                    <p style="margin-bottom: 0;font-size:.6rem"> {{ $penjualan->no_nota }}</p>
                    <p style="margin-bottom: 0;font-size:.6rem">{{$totalCuciPelanggan}}</p>
                </div>
                <div style="display: flex;justify-content: space-between">
                    <p style="margin-bottom: 10px; margin-top:0px;font-size:.6rem">
                        {{ isset($penjualan->pelanggan()->nama_pelanggan) ? $penjualan->pelanggan()->nama_pelanggan : '' }}
                    </p>
                    <p style="margin-bottom: 10px; margin-top:0px;font-size:.6rem"> {{ $penjualan->no_meja }}
                    </p>
                </div>
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
                    <td colspan="3">MATUR SUWUN</td>

                </tr>

            </tbody>
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
