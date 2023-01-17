<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Harga;

class DatahargaController extends Controller
{

    function Index()
    {

        $dataharga = DB::table('m_harga')->get();

        return view(
            'dataharga/index',
            [
                'dataharga' => $dataharga,

            ]
        );
    }

    function tambahharga(Request $request)
    {

        $add = new M_Harga;
        $add->id_harga = $request->input('id_harga');
        $add->harga_satuan = $request->input('harga_satuan');
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function updateharga(Request $request)
    {
        DB::table('m_harga')->where('id_harga', $request->harga)->update([
            'harga_satuan' => $request->harga_satuan,

        ]);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deleteharga($id_harga)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_harga')->where('id_harga', $id_harga)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
