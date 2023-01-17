<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Barang;
use App\Models\M_Rekanan;

class DatabarangController extends Controller
{

    function Index()
    {

        $databarang = DB::table('m_barang')
            ->join('m_rekanan', 'm_rekanan.id_rekanan', '=', 'm_barang.id_rekanan')
            ->get();

        $datarekanan = DB::table('m_rekanan')
            // ->groupBy('nama_rekanan')
            ->get();

        $dataharga = DB::table('m_harga')
            // ->groupBy('harga')
            ->get();

        return view(
            'databarang/index',
            [
                'databarang' => $databarang,
                'datarekanan' => $datarekanan,
                'dataharga' => $dataharga,

            ]
        );
    }

    function tambahbarang(Request $request)
    {

        $add = new M_Barang;
        $add->id_barang = $request->input('id_barang');
        $add->id_rekanan = $request->input('id_rekanan');
        $add->qty_barang = $request->input('qty_barang');
        $add->nama_barang = $request->input('nama_barang');
        $add->harga_satuan = $request->input('harga_satuan');
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editbarang($id_barang)
    {
        $databarang = DB::table('m_barang')
            ->where('id_barang', $id_barang)
            ->get();

        return view('/databarang/editbarang', [
            'databarang' => $databarang,
        ]);
    }

    public function updatebarang(Request $request)
    {
        DB::table('m_barang')->where('id_barang', $request->id_barang)->update([
            'nama_barang' => $request->nama_barang,
            'qty_barang' => $request->qty_barang,

        ]);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deletebarang($id_barang)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_barang')->where('id_barang', $id_barang)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
