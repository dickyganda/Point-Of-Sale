<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Total Motor</th>
                <th>Total Mobil</th>
                <th>Gratis Cuci Motor</th>
                <th>Gratis Cuci Mobil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPelanggan as $pelanggan)
                @if ($pelanggan->jumlahType($request))
                    <tr>

                        {{-- <td rowspan="{{ count($dataBarang->toArray()) + 1 }}">{{ $pelanggan->nama_pelanggan }}</td> --}}
                        <td
                            rowspan="{{ $pelanggan->jumlahType($request) > 1 ? $pelanggan->jumlahType($request) + 1 : 2 }}">
                            {{ $pelanggan->nama_pelanggan }}</td>
                    </tr>
                    @foreach ($dataBarang as $barang)
                        @if ($barang->jumlah($pelanggan->id_pelanggan, $request))
                            @php
                                $type = explode(' ', $barang->nama_barang);
                            @endphp
                            <tr>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $type[1] == 'motor' ? $barang->jumlah($pelanggan->id_pelanggan, $request) : 0 }}
                                </td>
                                <td>{{ $type[1] == 'mobil' ? $barang->jumlah($pelanggan->id_pelanggan, $request) : 0 }}
                                </td>
                                <td>
                                    {{ $type[1] == 'motor' ? floor($barang->jumlah($pelanggan->id_pelanggan, $request) / 10) : 0 }}
                                </td>
                                <td>
                                    {{ $type[1] == 'mobil' ? floor($barang->jumlah($pelanggan->id_pelanggan, $request) / 10) : 0 }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            window.print()
        });
    </script>

</body>

</html>
