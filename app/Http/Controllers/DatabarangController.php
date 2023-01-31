<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Rekanan;

class DatabarangController extends Controller
{

    function Index()
    {

        $databarang = DB::table('m_barang')
            ->join('m_rekanan', 'm_rekanan.id_rekanan', '=', 'm_barang.id_rekanan')
            ->where('m_barang.deleted_at', '=', null)
            ->get();

        $datarekanan = DB::table('m_rekanan')->where('deleted_at', '=', null)->get();
        // dd($datarekanan);

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
        $add->nama_barang = $request->input('nama_barang');
        $add->harga_barang = $request->input('harga_barang');
        $add->tgl_edit_barang = Date('Y-m-d');
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
            'harga_barang' => $request->harga_barang,
            'tgl_edit_barang' => Date('Y-m-d'),
        ]);

        DB::table('m_harga')->where('id_barang', $request->id_barang)->update([
            'status_harga' => 0,
            'tgl_edit_harga' => Date('Y-m-d')
        ]);

        $add = new M_Harga;
        $add->id_harga = $request->id_harga;
        $add->id_barang = $request->id_barang;
        $add->id_rekanan = $request->id_rekanan;
        $add->harga_satuan = $request->harga_barang;
        $add->status_harga = 1;
        $add->tgl_edit_harga = Date('Y-m-d');
        $add->save();
        // dd($add);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deletebarang($id_barang)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_barang')->where('id_barang', $id_barang)->update([
            'deleted_at' => date('Y-m-d h:i:s')
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
