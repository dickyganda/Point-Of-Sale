<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>

    <style>
        * {
            font-size: 10px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: 50px;
            height: 50px;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }

    </style>
</head>

<body>
    {{-- @foreach($datatransaksi as $key => $transaksi) --}}
    <div class="ticket">
        <img src="{{asset('assets/img/logo.png') }}" alt="Logo">
        <p class="centered">BADAN PENGELOLAN SARANA PENYEDIAAN AIR MINUM<br>
            (BP-SPAMS) "TIRTA SUMARI"</p>
        <table>
            <tr>
                <th class="quantity">Kd Plg</th>
                {{-- <td class="description">{{ $transaksi->kode_pelanggan}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Nama</th>
                {{-- <td class="description">{{ $transaksi->nama}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Alamat</th>
                {{-- <td class="description">{{ $transaksi->alamat}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">RT</th>
                {{-- <td class="description">{{ $transaksi->rt}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Bln/Th</th>
                {{-- <td class="description">{{ $transaksi->tgl_scan}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">St Akhir</th>
                {{-- <td class="description">{{ $transaksi->stand_meter_bulan_lalu}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">St Awal</th>
                {{-- <td class="description">{{ $transaksi->stand_meter_bulan_ini}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Pmkn</th>
                {{-- <td class="description">{{ $transaksi->pemakaian}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Tghn</th>
                {{-- <td class="description">{{ $transaksi->tagihan}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Biaya Adm</th>
                {{-- <td class="description">{{ $transaksi->biaya_admin}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Biaya Prwtn</th>
                {{-- <td class="description">{{ $transaksi->biaya_perawatan}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Tgkn</th>
                {{-- <td class="description">{{ $transaksi->tunggakan}}</td> --}}
            </tr>
            <tr>
                <th class="quantity">Total</th>
                {{-- <td class="description">{{ $transaksi->saldo}}</td> --}}
            </tr>
        </table>
        <p class="centered">Thanks for your purchase!
            <br>BP SPAMS "TIRTA SUMARI"</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    @endforeach
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });

    </script>
</body>

</html>
