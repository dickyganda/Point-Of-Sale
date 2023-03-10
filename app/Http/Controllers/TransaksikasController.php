<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Kas;

class TransaksikasController extends Controller
{

    function Index()
    {


        $t_kas = DB::table('t_kas')
            ->leftJoin('m_rekanan', 'm_rekanan.id_rekanan', '=', 't_kas.id_rekanan')
            ->where('t_kas.deleted_at', '=', null)
            ->get();

        $dataSaldo = DB::table('t_kas')->select(DB::raw('sum(t_kas.debit) as debit, sum(t_kas.kredit) as kredit'))->first();

        $last_saldo = DB::table('t_kas')
            ->join('m_rekanan', 'm_rekanan.id_rekanan', '=', 't_kas.id_rekanan')
            ->select('t_kas.saldo_kas')
            ->latest('tgl_kas')
            ->first();


        $databarang = DB::table('m_barang')->get();

        $datarekanan = DB::table('m_rekanan')->get();

        return view(
            'transaksikas/index',
            [
                'dataSaldo' => $dataSaldo,
                'last_saldo' => $last_saldo,
                't_kas' => $t_kas,
                'databarang' => $databarang,
                'datarekanan' => $datarekanan,

            ]
        );
    }

    function tambahkas(Request $request)
    {
        $last_saldo = DB::table('t_kas')->select(DB::raw('sum(t_kas.debit) as debit, sum(t_kas.kredit) as kredit'))
            ->latest('tgl_kas')->first();
        $saldo_terakhir = $last_saldo->debit - $last_saldo->kredit;

        $add = new T_Kas;
        $add->id_kas = $request->input('id_kas');
        $add->id_rekanan = $request->input('id_rekanan');
        if ($request->type) {
            $add->kredit = null;
            $add->debit = $request->input('jumlah');
            $add->saldo_kas = ($saldo_terakhir + $request->input('jumlah'));
        } else {
            $add->debit = null;
            $add->kredit = $request->input('jumlah');
            $add->saldo_kas = ($saldo_terakhir - $request->input('jumlah'));
        }

        $add->keterangan = $request->input('keterangan');
        $add->tgl_kas = Date('Y-m-d');
        $add->save();
        // dd($add);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    // public function updateharga(Request $request)
    // {
    //     DB::table('m_harga')->where('id_harga', $request->harga)->update([
    //         'harga_satuan' => $request->harga_satuan,

    //     ]);
    //     return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    // }

    public function deletekas($id_kas)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('t_kas')->where('id_kas', $id_kas)->update([
            'deleted_at' => date('Y-m-d h:i:s')
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
