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
            height: 80mm;
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
            font-family: Arial, Helvetica, sans-serif;
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
            font-size: .7rem;
            color: #666;
            background: #eee;
        }

        td {
            font-size: .6rem;
        }

        @media print {
            .page {
                width: 80mm;
                height: 80mm;
            }

            .hidden-print {
                display: none !important;
            }
        }

    </style>
</head>

<body>
    {{-- @foreach ($datatransaksi as $key => $transaksi) --}}
    <div class="page" style="margin:auto">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalBayar = 0;
                @endphp
                <img src="{{asset('assets/img/logo1.jpeg') }}" alt="Logo">
                <p>No. Nota : </p>
                @foreach ($detailPenjualan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->qty_penjualan }}</td>
                    <td>{{ $item->total_penjualan }}</td>
                </tr>
                @php
                $totalBayar += $item->total_penjualan;
                @endphp
                @endforeach
                <tr>
                    <td colspan="3">Total Harga</td>
                    <td>{{ $totalBayar }}</td>
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
