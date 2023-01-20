<?php

namespace App\Http\Controllers;

use App\Models\DT_Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Pelanggan;


class TransaksipenjualanController extends Controller
{

    function Index()
    {

        $t_penjualan = T_Penjualan::latest()->get();
        // ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'transaksipenjualan/index',
            [
                't_penjualan' => $t_penjualan,
                // 't_cart' => $t_cart,
                'databarang' => $databarang,
                'datapelanggan' => $datapelanggan,

            ]
        );
    }

    function tambahtransaksipenjualan(Request $request)
    {

        $penjualan = new T_Penjualan;
        $penjualan->status_closing = 0;
        $penjualan->save();

        foreach ($request->id_barang as $key => $value) {
            $add = new DT_Penjualan();
            $add->id_barang = $value;
            $add->id_t_penjualan = $penjualan->id_penjualan;
            $add->qty_penjualan = $request->qty_penjualan[$key];
            $add->total_penjualan = $request->total_penjualan[$key];
            $add->tgl_transaksi_penjualan = Date('Y-m-d');
            $add->save();
        }

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data', 'id_penjualan' => $penjualan->id_penjualan));
    }

    public function deleteharga($id_harga)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_harga')->where('id_harga', $id_harga)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }

    public function getbarang(Request $request)
    {
        // menghapus data warga berdasarkan id yang dipilih
        // Warga::where('nik',$request->input('nik'))->first();
        $getbarang = DB::table('m_barang')->where('id_barang', $request->input('id_barang'))->first();

        return response()->json($getbarang);
    }

    function printthermal($id_penjualan)
    {
        $detailPenjualan = DB::table('t_penjualan')
            ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', '=', 't_penjualan.id_penjualan')
            ->join('m_barang', 'm_barang.id_barang', '=', 'dt_penjualan.id_barang')
            ->where('id_penjualan', $id_penjualan)
            ->get();
        // dd($detailPenjualan);

        return view('/print/printpenjualan', [
            'detailPenjualan' => $detailPenjualan,
        ]);
    }
}
