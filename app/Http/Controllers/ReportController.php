<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\DT_Penjualan;

class ReportController extends Controller
{

    function Index()
    {
        // item per pelanggan
        $report_all = DB::table('t_penjualan')
            ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', '=', 't_penjualan.id_penjualan')
            ->join('m_barang', 'm_barang.id_barang', '=', 'dt_penjualan.id_barang')
            ->join('m_rekanan', 'm_rekanan.id_rekanan', '=', 'm_barang.id_rekanan')
            // ->select('m_rekanan.nama_rekanan', 'm_barang.nama_barang')
            // ->groupBy('nama_rekanan', 'nama_barang')
            ->get();

        $grand_total = DT_Penjualan::selectRaw('sum(total_penjualan) as total')
            ->whereDate('tgl_transaksi_penjualan', Date('Y-m-d'))
            ->first()->total;
        // dd($grand_total);

        // $grand_total = DB::table('t_penjualan')
        //     ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', '=', 't_penjualan.id_penjualan')
        //     ->join('m_barang', 'm_barang.id_barang', '=', 'dt_penjualan.id_barang')
        //     ->join('m_rekanan', 'm_rekanan.id_rekanan', '=', 'm_barang.id_rekanan')
        //     ->select('m_rekanan.nama_rekanan', 'dt_penjualan.total_penjualan', DB::raw('SUM(total_penjualan) as total'))
        //     ->groupBy('m_rekanan.nama_rekanan')
        //     ->get();
        // ->selectRaw('sum(dt_penjualan.total_penjualan) as total')->first()->total;
        // dd($grand_total);

        return view(
            'report/index',
            [
                'report_all' => $report_all,
                'grand_total' => $grand_total,
                // 'databarang' => $databarang,
                // 'datarekanan' => $datarekanan,

            ]
        );
    }
}
