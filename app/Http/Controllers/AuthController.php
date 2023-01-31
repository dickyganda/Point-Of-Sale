<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

use Redirect; //untuk redirect


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Models\M_User;
use App\Models\M_User_Level;


class AuthController extends Controller
{
    public function login()
    {
        return view('/autentikasi/login')->with('sukses', 'Anda Berhasil Login');
    }

    function postlogin2(Request $request)
    {
        $nama_user = $request->input('nama_user');
        $password_user = $request->input('password_user');

        $query = DB::table('m_user')
            ->where('nama_user', $nama_user)
            ->where('password_user', md5($password_user))
            ->where('status_user', '=', '1')
            ->first();
        if (empty($query)) {
            return response()->json(array('status' => 'failed', 'reason' => 'data tidak ada'));
        }
        Session::put('level_user', $query->level_user);
        return response()->json(array('status' => 'success', 'reason' => 'sukses'));

        // if($request->Session()->has('email', 'password'))
        // {
        //     return redirect('/dashboard/index');
        // }else{
        //     return redirect('/autentikasi/login');
        // }
    }

    public function logout2()
    {
        Session::flush();
        Session::save();

        return redirect('/autentikasi/login');
    }

    public function ubahpassword($id_user)
    {
        $datauser = DB::table('m_user')->where('id_user', $id_user)->get();

        return view('/autentikasi/ubahpassword', ['datauser' => $datauser]);
    }

    public function updatepassword(Request $request)
    {
        DB::table('m_user')->where('id_user', $request->id_user)->update([
            'password' => $request->password,
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }
}
