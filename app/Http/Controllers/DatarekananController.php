<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Rekanan;

class DatarekananController extends Controller
{

    function Index()
    {

        $datarekanan = DB::table('m_rekanan')->where('deleted_at', '=', null)->get();

        return view(
            'datarekanan/index',
            [
                'datarekanan' => $datarekanan,

            ]
        );
    }

    function tambahrekanan(Request $request)
    {

        $add = new M_Rekanan;
        $add->id_rekanan = $request->input('id_rekanan');
        $add->nama_rekanan = $request->input('nama_rekanan');
        $add->alamat_rekanan = $request->input('alamat_rekanan');
        $add->no_telepon_rekanan = $request->input('no_telepon_rekanan');
        $add->email_rekanan = $request->input('email_rekanan');
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editrekanan($id_rekanan)
    {
        $datarekanan = DB::table('m_rekanan')
            ->where('id_rekanan', $id_rekanan)
            ->get();

        return view('/datarekanan/editrekanan', [
            'datarekanan' => $datarekanan,
        ]);
    }

    public function updaterekanan(Request $request)
    {
        DB::table('m_rekanan')->where('id_rekanan', $request->id_rekanan)->update([
            'nama_rekanan' => $request->nama_rekanan,
            'alamat_rekanan' => $request->alamat_rekanan,
            'no_telepon_rekanan' => $request->no_telepon_rekanan,
            'email_rekanan' => $request->email_rekanan,

        ]);
        // dd($request);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deleterekanan($id_rekanan)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_rekanan')->where('id_rekanan', $id_rekanan)->update([
            'deleted_at' => date('Y-m-d h:i:s')
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
