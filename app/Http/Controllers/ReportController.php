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

    public function pelangganPrint(Request $request)
    {
        $pelanggan = M_Pelanggan::get();
        $barang = M_Barang::where('nama_barang', 'like', '%cuci%')->get();

        // dd($barang);
        return view(
            'report/reportpelanggan',
            [
                'dataPelanggan' => $pelanggan,
                'dataBarang' => $barang,
                'request' => $request,
            ]
        );
    }

    public function data(Request $request)
    {
        $min = isset($request->min) && $request->min != null ? date('Y-m-d', strtotime($request->min)) : date('Y-m-d');
        $max = isset($request->max) && $request->max != null ? date('Y-m-d', strtotime($request->max)) : date('Y-m-d');

        $pelanggan = M_Pelanggan::get();


        $return = null;
        foreach ($pelanggan as $key => $value) {
            // dd($value->totalCuciMotor());
            if ($value->totalCuciMotor($request) || $value->totalCuciMobil($request)) {
                $return[] = array(
                    'nama_pelanggan' => $value->nama_pelanggan,
                    'total_motor' => $value->totalMotor($request),
                    'total_mobil' => $value->totalMobil($request),
                    'cuci_motor' => $value->totalCuciMotor($request),
                    'cuci_mobil' => $value->totalCuciMobil($request),
                    'gratis_cuci_motor' => floor($value->totalCuciMotor($request) / 10),
                    'gratis_cuci_mobil' => floor($value->totalCuciMobil($request) / 10),
                );
            }
        }

        echo json_encode(array('data' => $return));
    }

    public function data1(Request $request)
    {
        $min = isset($request->min) && $request->min != null ? date('Y-m-d', strtotime($request->min)) : date('Y-m-d');
        $max = isset($request->max) && $request->max != null ? date('Y-m-d', strtotime($request->max)) : date('Y-m-d');

        $pelanggan = M_Pelanggan::join('t_penjualan', 't_penjualan.id_pelanggan', 'm_pelanggan.id_pelanggan')
            ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', 't_penjualan.id_penjualan')
            ->join('m_barang', 'm_barang.id_barang', 'dt_penjualan.id_barang')
            ->where('m_barang.nama_barang', 'like', 'cuci%')
            ->where('dt_penjualan.deleted_at', '=', null)
            ->whereBetween('dt_penjualan.tgl_transaksi_penjualan', [$min, $max])
            ->select('m_pelanggan.id_pelanggan', 'm_pelanggan.nama_pelanggan', 'm_barang.id_barang', 'm_barang.nama_barang', DB::raw('sum(dt_penjualan.qty_penjualan) as jumlah'))
            ->orderBy('m_pelanggan.id_pelanggan', 'asc')
            ->orderBy('m_barang.id_barang', 'asc')
            ->groupBy('m_barang.id_barang', 'm_pelanggan.id_pelanggan', 'm_pelanggan.nama_pelanggan', 'm_barang.nama_barang',)
            ->get();

        $return = null;
        foreach ($pelanggan as $key => $value) {
            $nama = explode(' ', $value->nama_barang);
            if ($nama[1] == 'motor') {
                $return[$key] = array(
                    'nama_pelanggan' => $value->nama_pelanggan,
                    'nama_barang' => $value->nama_barang,
                    'jumlah_motor' => $value->jumlah,
                    'jumlah_mobil' => '0',
                    'gratis_cuci_motor' => floor($value->jumlah / 10),
                    'gratis_cuci_mobil' => '0'
                );
            } else {
                $return[$key] = array(
                    'nama_pelanggan' => $value->nama_pelanggan,
                    'nama_barang' => $value->nama_barang,
                    'jumlah_motor' => '0',
                    'jumlah_mobil' => $value->jumlah,
                    'gratis_cuci_motor' => '0',
                    'gratis_cuci_mobil' => floor($value->jumlah / 10)
                );
            }
        }

        echo json_encode(array('data' => $return));
    }
}
