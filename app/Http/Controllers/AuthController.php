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
    	return view('/autentikasi/login')->with('sukses','Anda Berhasil Login');
    }

    function postlogin2(Request $request ){
        $email = $request->input('email');
        $password = $request->input('password');

        $query = DB::table('m_user')
        ->join('m_user_level', 'm_user_level.id_level', '=', 'm_user.id_level')
        ->where('email', $email)
        ->where('password' ,md5($password))
        ->first();
        if(empty($query)){
            return response()->json(array('status' => 'failed', 'reason' => 'data tidak ada'));
        }
        Session::put('nama_level',$query->nama_level);
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
        $datauser = DB::table('m_user')->where('id_user',$id_user)->get();

        return view('/autentikasi/ubahpassword',['datauser' => $datauser]);
    
    }

    public function updatepassword(Request $request)
{
	DB::table('m_user')->where('id_user',$request->id_user)->update([
		'password' => $request->password,
	]);

    return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

}