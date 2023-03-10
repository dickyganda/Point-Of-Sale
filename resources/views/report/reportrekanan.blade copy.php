<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Rekanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex flex-column">
        <div class="d-flex mb-2">
            Tanggal {{ $from }} sampai {{ $to }}
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rekanan</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $qtyMobil = 0;
                    $qtyMotor = 0;
                    $totalMobil = 0;
                    $totalMotor = 0;
                    $disMobil = 0;
                    $disMotor = 0;
                    
                    $subTotal = 0;
                    $grandTotal = 0;
                @endphp
                @foreach ($report as $key => $item)
                    @php
                        $rekananNow = $item->id_rekanan;
                        $rekananBef = isset($report[$key - 1]) ? $report[$key - 1]->id_rekanan : $item->id_rekanan;
                    @endphp

                    @if ($rekananNow == $rekananBef)
                        @if (in_array($item->id_barang, $mobil))
                            @php
                                $qtyMobil += $item->qty_penjualan;
                                $totalMobil += $item->total_penjualan;
                                if ($item->total_penjualan < $item->qty_penjualan * $item->harga_barang) {
                                    $disMobil++;
                                }
                            @endphp
                        @elseif(in_array($item->id_barang, $motor))
                            @php
                                $qtyMotor += $item->qty_penjualan;
                                $totalMotor += $item->total_penjualan;
                                if ($item->total_penjualan < $item->qty_penjualan * $item->harga_barang) {
                                    $disMotor++;
                                }
                            @endphp
                        @else
                            <tr>
                                <td>{{ $item->nama_rekanan }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->qty_penjualan }}</td>
                                <td>{{ $item->harga_barang }}</td>
                                <td>{{ $item->total_penjualan }}</td>
                                <td>-</td>
                            </tr>

                            @php
                                $subTotal += $item->total_penjualan;
                            @endphp
                        @endif
                    @else
                        @if ($qtyMobil)
                            <tr>
                                <td>{{ $report[$key - 1]->nama_rekanan }}</td>
                                <td>cuci mobil</td>
                                <td>{{ $qtyMobil }}</td>
                                <td>-</td>
                                <td>{{ $totalMobil }}</td>
                                <td>
                                    @if ($disMobil)
                                        Free {{ $disMobil }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @php
                                $subTotal += $totalMobil;
                            @endphp
                        @endif

                        @if ($qtyMotor)
                            <tr>
                                <td>{{ $report[$key - 1]->nama_rekanan }}</td>
                                <td>cuci motor</td>
                                <td>{{ $qtyMotor }}</td>
                                <td>-</td>
                                <td>{{ $totalMotor }}</td>
                                <td>
                                    @if ($disMotor)
                                        Free {{ $disMotor }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @php
                                $subTotal += $totalMotor;
                            @endphp
                        @endif
                        <tr style="background-color: #f2f2f2">
                            <td colspan="4" class="text-center">SubTotal</td>
                            <td class="text-center">{{ $subTotal }}</td>
                            <td></td>
                        </tr>

                        @php
                            $grandTotal += $subTotal;
                            $subTotal = 0;
                            
                            $qtyMobil = 0;
                            $qtyMotor = 0;
                            $totalMobil = 0;
                            $totalMotor = 0;
                            $disMobil = 0;
                            $disMotor = 0;
                        @endphp
                        @if (in_array($item->id_barang, $mobil))
                            @php
                                $qtyMobil += $item->qty_penjualan;
                                $totalMobil += $item->total_penjualan;
                                if ($item->total_penjualan < $item->qty_penjualan * $item->harga_barang) {
                                    $disMobil++;
                                }
                            @endphp
                        @elseif(in_array($item->id_barang, $motor))
                            @php
                                $qtyMotor += $item->qty_penjualan;
                                $totalMotor += $item->total_penjualan;
                                if ($item->total_penjualan < $item->qty_penjualan * $item->harga_barang) {
                                    $disMotor++;
                                }
                            @endphp
                        @else
                            <tr>
                                <td>{{ $item->nama_rekanan }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->qty_penjualan }}</td>
                                <td>{{ $item->harga_barang }}</td>
                                <td>{{ $item->total_penjualan }}</td>
                                <td>-</td>
                            </tr>
                            @php
                                $subTotal += $item->total_penjualan;
                            @endphp
                        @endif
                    @endif

                    @if ($loop->last)
                        @if ($qtyMobil)
                            <tr>
                                <td>{{ $item->nama_rekanan }}</td>
                                <td>cuci mobil</td>
                                <td>{{ $qtyMobil }}</td>
                                <td>-</td>
                                <td>{{ $totalMobil }}</td>
                                <td>
                                    @if ($disMobil)
                                        Free {{ $disMobil }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @php
                                $subTotal += $totalMobil;
                            @endphp
                        @endif

                        @if ($qtyMotor)
                            <tr>
                                <td>{{ $item->nama_rekanan }}</td>
                                <td>cuci motor</td>
                                <td>{{ $qtyMotor }}</td>
                                <td>-</td>
                                <td>{{ $totalMotor }}</td>
                                <td>
                                    @if ($disMotor)
                                        Free {{ $disMotor }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @php
                                $subTotal += $totalMotor;
                                
                                $grandTotal += $subTotal;
                            @endphp
                        @endif
                        <tr style="background-color: #f2f2f2">
                            <td colspan="4" class="text-center">SubTotal</td>
                            <td class="text-center">{{ $subTotal }}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="4" class="text-center">Grand Total</td>
                    <td class="text-center">{{ $grandTotal }}</td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
