<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

use App\Models\DT_Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $total_penjualan_day = DT_Penjualan::selectRaw('sum(total_penjualan) as total')
            ->where('dt_penjualan.deleted_at', '=', null)
            ->whereDay('tgl_transaksi_penjualan', date('d'))
            ->first()->total;

        $total_penjualan_month = DT_Penjualan::selectRaw('sum(total_penjualan) as total')
            ->whereMonth('tgl_transaksi_penjualan', date('m'))
            ->first()->total;
        // dd($total_penjualan_day);

        // dataset penjualan per bulan
        $omzet_penjualan_byMonth = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('dt_penjualan.tgl_transaksi_penjualan', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.total_penjualan) as omzet'), (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as blnthn")))
            ->groupBy('blnthn')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('omzet')->all();
            // dd($omzet_penjualan_byMonth);

            // labels penjualan per bulan
            $monthPenjualan = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('dt_penjualan.tgl_transaksi_penjualan', (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as blnthn")))
            ->groupBy('blnthn')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('blnthn')->all();
            // dd($monthPenjualan);

        $chart_byMonth = new DT_Penjualan;
        $chart_byMonth->labels = ($monthPenjualan);
        $chart_byMonth->dataset = (array_values($omzet_penjualan_byMonth));
        // dd($chart->dataset);

        // dataset penjualan per hari
        $omzet_penjualan_byDay = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('dt_penjualan.tgl_transaksi_penjualan', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.total_penjualan) as omzet'))
            ->groupBy('dt_penjualan.tgl_transaksi_penjualan')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('omzet')->all();
            // dd($omzet_penjualan_byDay);

            // labels penjualan per hari
            $dayPenjualan = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('dt_penjualan.tgl_transaksi_penjualan')
            ->groupBy('dt_penjualan.tgl_transaksi_penjualan')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('dt_penjualan.tgl_transaksi_penjualan')->all();
            // dd($dayPenjualan);

        $chart_byDay = new DT_Penjualan;
        $chart_byDay->labels = ($dayPenjualan);
        $chart_byDay->dataset = (array_values($omzet_penjualan_byDay));

        // dataset per rekanan
        $omzet_penjualan_byRekanan = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.total_penjualan) as omzet'), (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as blnthn")))
            ->groupBy('blnthn','m_rekanan.nama_rekanan')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('omzet')->all();
            // dd($omzet_penjualan_byRekanan);

            // label rekanan per bulan
            // $rekananPenjualan = DB::table('t_penjualan')
            // ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            // ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            // ->select('dt_penjualan.tgl_transaksi_penjualan', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan','m_rekanan.nama_rekanan', (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as blnthn")))
            // ->groupBy('blnthn', 'm_rekanan.nama_rekanan')
            // ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            // ->pluck('m_rekanan.nama_rekanan')->all();
            // dd($rekananPenjualan);
$statement = DB::statement("set lc_time_names = 'id_ID'");
            $rekananPenjualan = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan','m_rekanan.nama_rekanan', (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as blnthn")), DB::raw("CONCAT(m_rekanan.nama_rekanan,' ',monthname(dt_penjualan.tgl_transaksi_penjualan)) as REKBUL"))
            ->groupBy('blnthn', 'm_rekanan.nama_rekanan')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('REKBUL')->all();
            // dd($rekananPenjualan);

            // $bulan_byRekanan = DB::table('t_penjualan')
            // ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            // ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            // ->select('dt_penjualan.tgl_transaksi_penjualan', (DB::raw("SUBSTR(dt_penjualan.tgl_transaksi_penjualan, 1, 7) as bln")))
            // ->groupBy('bln')
            // ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            // ->pluck('bln')->all();
            // dd($bulan_byRekanan);

        $chart_byRekanan = new DT_Penjualan;
        $chart_byRekanan->labels = ($rekananPenjualan);
        $chart_byRekanan->dataset = (array_values($omzet_penjualan_byRekanan));
        // dd($chart_byRekanan);


        // dataset cuci by qty total
        $qty_cuci = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan','m_barang.nama_barang', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.total_penjualan) as harga'), DB::raw('sum(dt_penjualan.qty_penjualan) as qty'))
            ->whereIn('m_barang.id_barang', [106, 107, 108, 109, 110, 111, 112, 113])
            ->groupBy('m_barang.nama_barang')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('qty')->all();
            // dd($qty_cuci_harian);

            // label cuci total by barang
            $cuciBarang = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan','m_barang.nama_barang', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.qty_penjualan) as qty'))
            ->whereIn('m_barang.id_barang', [106, 107, 108, 109, 110, 111, 112, 113])
            ->groupBy('m_barang.nama_barang')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('m_barang.nama_barang')->all();
            // dd($cuci_harian);

        $chart_bycuciTotal = new DT_Penjualan;
        $chart_bycuciTotal->labels = ($cuciBarang);
        $chart_bycuciTotal->dataset = (array_values($qty_cuci));

        // dataset total omzet cuci
        $omzet_cuciTotal = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan','m_barang.nama_barang', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.total_penjualan) as harga'), DB::raw('sum(dt_penjualan.qty_penjualan) as qty'))
            ->whereIn('m_barang.id_barang', [106, 107, 108, 109, 110, 111, 112, 113])
            ->groupBy('m_barang.nama_barang')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('harga')->all();
            // dd($omzet_cuciTotal);

            // label total omzet cuci
            $omzet_cuciBarang = DB::table('t_penjualan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            // ->join('m_rekanan', 'm_barang.id_rekanan', 'm_rekanan.id_rekanan')
            ->select('dt_penjualan.tgl_transaksi_penjualan','m_barang.nama_barang', 'dt_penjualan.qty_penjualan', 'dt_penjualan.total_penjualan', DB::raw('sum(dt_penjualan.qty_penjualan) as qty'))
            ->whereIn('m_barang.id_barang', [106, 107, 108, 109, 110, 111, 112, 113])
            ->groupBy('m_barang.nama_barang')
            ->orderBy('dt_penjualan.tgl_transaksi_penjualan', 'asc')
            ->pluck('m_barang.nama_barang')->all();
            // dd($omzet_cuciBarang);

        $chart_omzetcuciTotal = new DT_Penjualan;
        $chart_omzetcuciTotal->labels = ($omzet_cuciBarang);
        $chart_omzetcuciTotal->dataset = (array_values($omzet_cuciTotal));
            

        return view(
            '/dashboard/index',
            [
                'total_penjualan_day' => $total_penjualan_day,
                'total_penjualan_month' => $total_penjualan_month,
                'omzet_penjualan_byMonth' => $omzet_penjualan_byMonth,
                'chart_byDay' => $chart_byDay,
                'chart_byMonth' => $chart_byMonth,
                'chart_byRekanan' => $chart_byRekanan,
                'chart_bycuciTotal' => $chart_bycuciTotal,
                'chart_omzetcuciTotal' => $chart_omzetcuciTotal,
                compact('chart_byMonth','chart_byDay'),

            ]
        );
    }
}
