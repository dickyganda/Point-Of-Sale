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

        $datauser = DB::table('m_user')->where('deleted_at', '=', null)->get();

        return view(
            'datauser/index',
            [
                'datauser' => $datauser,

            ]
        );
    }

    function tambahuser(Request $request)
    {

        $add = new M_User();
        $add->id_user = $request->input('id_user');
        $add->nama_user = $request->input('nama_user');
        $add->password_user = md5($request->input('password_user'));
        $add->level_user = $request->input('level_user');
        $add->status_user = 1;
        $add->tgl_edit_user = Date('Y-m-d');
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function edituser($id_user)
    {
        $datauser = DB::table('m_user')
            ->where('id_user', $id_user)
            ->get();

        return view('/datauser/edituser', [
            'datauser' => $datauser,
        ]);
    }

    public function updateuser(Request $request)
    {
        DB::table('m_user')->where('id_user', $request->id_user)->update([
            'nama_user' => $request->nama_user,
            'password_user' => md5($request->password_user),
            'level_user' => $request->level_user,
            'status_user' => $request->status_user,
            'tgl_edit_user' => Date('Y-m-d'),

        ]);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deleteuser($id_user)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_user')->where('id_user', $id_user)->update([
            'deleted_at' => date('Y-m-d h:i:s'),
            'status_user' => 0
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
