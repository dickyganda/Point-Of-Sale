<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\T_Cart;
use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Pelanggan;


class TransaksipenjualanController extends Controller
{

    function Index()
    {

        $t_penjualan = DB::table('t_penjualan')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_penjualan.id_pelanggan')
            ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')
            ->get();
        // dd($t_penjualan);
        // $t_cart = DB::table('t_cart')
        //     ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_penjualan.id_pelanggan')
        //     ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')
        //     ->get();

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

        // $hargabarang = T_Penjualan::select('*')
        //     ->where('id_penjualan', $request->id_penjualan)
        //     ->first();
        // $hargabarang->harga_barang;
        // dd($hargabarang);

        $add = new T_Cart;
        $add->id_barang = $request->input('id_barang');
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->qty_penjualan = $request->input('qty_penjualan');
        $add->total_penjualan = $request->input('total_penjualan');
        $add->tgl_transaksi_penjualan = Date('Y-m-d');
        $add->save();
        // dd($add);

        // $add = new T_Penjualan;
        // $add->id_barang = $request->input('id_barang');
        // $add->id_pelanggan = $request->input('id_rekanan');
        // $add->qty_penjualan = $request->input('harga_satuan');
        // $add->total_penjualan = $request->input('harga_satuan');
        // $add->tgl_transaksi_penjualan = Date('Y-m-d');
        // $add->save();
        // dd($add);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function deleteharga($id_harga)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_harga')->where('id_harga', $id_harga)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
