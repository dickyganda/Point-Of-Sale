<?php

namespace App\Http\Controllers;

use App\Models\M_Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\M_Pelanggan;
use App\Models\T_Cuci;

class DatapelangganController extends Controller
{

    function Index()
    {

        // $datapelanggan = DB::table('m_pelanggan')->get();
        $datapelanggan = M_Pelanggan::get();

        // $dataCuci = M_Barang::where('nama_barang', 'like', 'cuci%')->get();

        return view(
            'datapelanggan/index',
            [
                'datapelanggan' => $datapelanggan,
                // 'dataCuci' => $dataCuci,

            ]
        );
    }

    function tambahpelanggan(Request $request)
    {

        $add = new M_Pelanggan;
        $add->id_pelanggan = $request->input('id_pelanggan');
        // $add->kode_pelanggan = $request->input('rt') . '1' . str_pad(($dataconfig->nilai_config + 1), 4, '0', STR_PAD_LEFT);
        $add->nama_pelanggan = $request->input('nama_pelanggan');
        $add->alamat_pelanggan = $request->input('alamat_pelanggan');
        $add->no_telepon_pelanggan = $request->input('no_telepon_pelanggan');
        $add->status_pelanggan = 1;
        $add->tgl_add_pelanggan = Date('Y-m-d');;
        $add->save();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editpelanggan($id_pelanggan)
    {
        $datapelanggan = DB::table('m_pelanggan')
            ->where('id_pelanggan', $id_pelanggan)
            ->get();

        return view('/datapelanggan/editpelanggan', [
            'datapelanggan' => $datapelanggan,
        ]);
    }

    public function updatepelanggan(Request $request)
    {
        DB::table('m_pelanggan')->where('id_pelanggan', $request->id_pelanggan)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'status_pelanggan' => $request->status_pelanggan,

        ]);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deletepelanggan($id_pelanggan)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_pelanggan')->where('id_pelanggan', $id_pelanggan)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
