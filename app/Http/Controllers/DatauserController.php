<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_User;

class DatauserController extends Controller
{

    function Index()
    {

        $datauser = DB::table('m_user')->get();

        return view(
            'datauser/index',
            [
                'datauser' => $datauser,

            ]
        );
    }

    function tambahuser(Request $request)
    {

        $add = new M_Pelanggan;
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->nama_pelanggan = $request->input('nama_pelanggan');
        $add->alamat_pelanggan = $request->input('alamat_pelanggan');
        $add->status_pelanggan = $request->input('status_pelanggan');
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function edituser($id_user)
    {
        $datapelanggan = DB::table('m_pelanggan')
            ->where('id_pelanggan', $id_pelanggan)
            ->get();

        return view('/datapelanggan/editpelanggan', [
            'datapelanggan' => $datapelanggan,
        ]);
    }

    public function updateuser(Request $request)
    {
        DB::table('m_pelanggan')->where('id_pelanggan', $request->id_pelanggan)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'status_pelanggan' => $request->status_pelanggan,

        ]);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deleteuser($id_user)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_pelanggan')->where('id_pelanggan', $id_pelanggan)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
