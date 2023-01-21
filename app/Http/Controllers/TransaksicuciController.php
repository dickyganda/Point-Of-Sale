<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\T_Cart;
use App\Models\T_Cuci;
use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Pelanggan;


class TransaksicuciController extends Controller
{

    function Index()
    {

        $t_cuci = DB::table('t_cuci')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_cuci.id_pelanggan')
            ->join('m_barang', 'm_barang.id_barang', '=', 't_cuci.id_barang')
            ->get();
        // dd($t_penjualan);

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'transaksicuci/index',
            [
                't_cuci' => $t_cuci,
                'databarang' => $databarang,
                'datapelanggan' => $datapelanggan,

            ]
        );
    }

    function tambahtransaksicuci(Request $request)
    {

        $add = new T_Cuci;
        $add->id_barang = 3;
        $add->id_pelanggan = $request->input('id_pelanggan');
        $add->tgl_cuci = Date('Y-m-d');
        $add->save();
        // dd($add);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function editcuci($id_cuci)
    {

        $t_cuci = DB::table('t_cuci')
            ->join('m_pelanggan', 'm_pelanggan.id_pelanggan', '=', 't_cuci.id_pelanggan')
            ->join('m_barang', 'm_barang.id_barang', '=', 't_cuci.id_barang')
            ->get();
        // dd($t_cuci);

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view('/transaksicuci/edittransaksicuci', [
            't_cuci' => $t_cuci,
            'databarang' => $databarang,
            'datapelanggan' => $datapelanggan,
        ]);
    }

    public function updatecuci(Request $request)
    {
        DB::table('t_cuci')->where('id_cuci', $request->id_cuci)->update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
        ]);

        // dd($request);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deleteharga($id_harga)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('m_harga')->where('id_harga', $id_harga)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
