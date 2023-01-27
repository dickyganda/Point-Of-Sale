<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\DT_Penjualan;
use App\Models\M_Barang;
use App\Models\M_Pelanggan;

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

        // dd($grand_total, $report_all);

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

    public function print(Request $request)
    {
        $from = date('Y-m-d', strtotime($request->min));
        $to = date('Y-m-d', strtotime($request->max));
        // $from = date('Y-m-d', )
        $report = DT_Penjualan::whereBetween('tgl_transaksi_penjualan', [$from, $to])
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->join('m_rekanan', 'm_rekanan.id_rekanan', 'm_barang.id_rekanan')
            ->orderBy('m_barang.id_rekanan')
            ->select('dt_penjualan.*', 'm_barang.nama_barang', 'm_barang.harga_barang', 'm_rekanan.nama_rekanan', 'm_rekanan.id_rekanan')
            ->get();

        $mobil = M_Barang::where('nama_barang', 'like', '%mobil%')->pluck('id_barang')->toArray();
        $motor = M_Barang::where('nama_barang', 'like', '%motor%')->pluck('id_barang')->toArray();

        // dd($report);

        return view(
            'report/reportrekanan',
            [
                'report' => $report,
                'from' => $from,
                'to' => $to,
                'mobil' => $mobil,
                'motor' => $motor,
            ]
        );
    }

    public function pelanggan()
    {
        $pelanggan = M_Pelanggan::get();
        $barang = M_Barang::where('nama_barang', 'like', '%cuci%')->get();

        // dd($barang);
        return view(
            'report/indexCuci',
            [
                'dataPelanggan' => $pelanggan,
                'dataBarang' => $barang,
            ]
        );
    }

    public function pelangganPrint()
    {
        $pelanggan = M_Pelanggan::get();
        $barang = M_Barang::where('nama_barang', 'like', '%cuci%')->get();

        // dd($barang);
        return view(
            'report/reportpelanggan',
            [
                'dataPelanggan' => $pelanggan,
                'dataBarang' => $barang,
            ]
        );
    }
}
