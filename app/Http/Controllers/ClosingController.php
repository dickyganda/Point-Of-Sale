<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\T_Cuci;
use App\Models\T_Cart;
use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Pelanggan;


class ClosingController extends Controller
{

    function Index()
    {

        $t_penjualan = DB::table('t_penjualan')
            // ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_penjualan.id_pelanggan')
            ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')
            ->get();

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'closing/index',
            [
                't_penjualan' => $t_penjualan,
                // 't_cart' => $t_cart,
                'databarang' => $databarang,
                'datapelanggan' => $datapelanggan,

            ]
        );
    }
}
