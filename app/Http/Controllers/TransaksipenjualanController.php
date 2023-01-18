<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;

class TransaksipenjualanController extends Controller
{

    function Index()
    {

        $t_penjualan = DB::table('t_penjualan')
            ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')
            ->join('m_harga', 'm_harga.id_harga', '=', 't_penjualan.id_harga')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_penjualan.id_pelanggan')
            ->get();

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'dataharga/index',
            [
                't_penjualan' => $t_penjualan,
                'databarang' => $databarang,
                'datapelanggan' => $datapelanggan,

            ]
        );
    }

    function tambahharga(Request $request)
    {
        DB::table('m_harga')->where('id_barang', $request->id_barang)->update([
            'status_harga' => 0,
            'tgl_edit_harga' => Date('Y-m-d')
        ]);

        $add = new M_Harga;
        $add->id_harga = $request->input('id_harga');
        $add->id_barang = $request->input('id_barang');
        $add->id_rekanan = $request->input('id_rekanan');
        $add->harga_satuan = $request->input('harga_satuan');
        $add->status_harga = 1;
        $add->tgl_edit_harga = Date('Y-m-d');
        $add->save();
        // dd($add);

        DB::table('m_barang')->where('id_barang', $request->id_barang)->update([
            'harga_barang' => $request->harga_satuan,
            'tgl_edit_barang' => Date('Y-m-d')
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    // public function updateharga(Request $request)
    // {
    //     DB::table('m_harga')->where('id_harga', $request->harga)->update([
    //         'harga_satuan' => $request->harga_satuan,

    //     ]);
    //     return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    // }

    public function deleteharga($id_harga)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_harga')->where('id_harga', $id_harga)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
