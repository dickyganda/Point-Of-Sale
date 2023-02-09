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

        // $t_penjualan = DB::table('t_penjualan')
        //     ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', 't_penjualan.id_penjualan')
        //     ->join('m_barang', 'm_barang.id_barang', 'dt_penjualan.id_barang')
        //     ->join('m_rekanan', 'm_rekanan.id_rekanan', 'm_barang.id_rekanan')
        //     ->whereNull('dt_penjualan.deleted_at')
        //     ->where('dt_penjualan.tgl_transaksi_penjualan', '<=', "'2023-02-05'")
        //     ->where('t_penjualan.status_closing', '=', '0')
        //     ->groupBy('m_rekanan.nama_rekanan')
        //     ->select(
        //         'dt_penjualan.tgl_transaksi_penjualan AS DATE',
        //         'm_rekanan.nama_rekanan',
        //         DB::raw('SUM( dt_penjualan.qty_penjualan ) AS SUM_QTY'),
        //         DB::raw('SUM( dt_penjualan.total_penjualan ) AS SUM_PRICE'),
        //         DB::raw('SUM( dt_penjualan.total_penjualan * 0.05 ) AS `SUM KAS 5%`'),
        //         DB::raw('SUM( dt_penjualan.total_penjualan )- SUM( dt_penjualan.total_penjualan * 0.05 ) AS INCOME'),
        //         't_penjualan.status_closin',
        //     )
        //     ->get();
        $t_penjualan = DB::select(
            DB::raw("SELECT
                dt_penjualan.tgl_transaksi_penjualan AS tanggal,
                m_rekanan.nama_rekanan AS partner,
                SUM( dt_penjualan.qty_penjualan ) AS sum_qty,
                SUM( dt_penjualan.total_penjualan ) AS sum_price,
                SUM( dt_penjualan.total_penjualan * 0.05 ) AS sum_kas,
                SUM( dt_penjualan.total_penjualan )- SUM( dt_penjualan.total_penjualan * 0.05 ) AS income,
                t_penjualan.status_closing 
            FROM
                t_penjualan
                INNER JOIN dt_penjualan ON t_penjualan.id_penjualan = dt_penjualan.id_t_penjualan
                INNER JOIN m_barang ON dt_penjualan.id_barang = m_barang.id_barang
                INNER JOIN m_rekanan ON m_barang.id_rekanan = m_rekanan.id_rekanan 
            WHERE
                dt_penjualan.deleted_at IS NULL 
                -- AND dt_penjualan.tgl_transaksi_penjualan <= date('Y-m-d')
                AND t_penjualan.status_closing = '0' 
            GROUP BY
                m_rekanan.nama_rekanan")
        );

        // dd($t_penjualan);

        // $databarang = DB::table('m_barang')->get();

        // $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'closing/index',
            [
                't_penjualan' => $t_penjualan,
            ]
        );
    }
}
