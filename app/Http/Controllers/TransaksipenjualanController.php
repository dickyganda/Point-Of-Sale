<?php

namespace App\Http\Controllers;

use App\Models\DT_Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Penjualan;
use App\Models\M_Barang;
use App\Models\M_Harga;
use App\Models\M_Pelanggan;


class TransaksipenjualanController extends Controller
{

    function Index()
    {

        $dt_penjualan = DT_Penjualan::orderBy('tgl_transaksi_penjualan', 'DESC')->get();
        // ->join('m_barang', 'm_barang.id_barang', '=', 't_penjualan.id_barang')

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view(
            'transaksipenjualan/index',
            [
                'dt_penjualan' => $dt_penjualan,
                // 't_cart' => $t_cart,
                'databarang' => $databarang,
                'datapelanggan' => $datapelanggan,

            ]
        );
    }

    function tambahtransaksipenjualan(Request $request)
    {
        $barangCuci = M_Barang::where('nama_barang', 'like', 'cuci%')->pluck('id_barang')->toArray();

        // dd($barangCuci);
        // $pelanggan = M_Pelanggan::find($request->id_pelanggan);
        // if ($pelanggan->jumlahCuci() % 9 == 0) {
        //     dd(true);
        // }
        // dd(false);

        $penjualan = new T_Penjualan;
        $penjualan->id_pelanggan = $request->id_pelanggan;
        $penjualan->status_closing = 0;
        $penjualan->save();

        foreach ($request->id_barang as $key => $value) {
            $add = new DT_Penjualan();
            $add->id_barang = $value;
            $add->id_t_penjualan = $penjualan->id_penjualan;
            // $add->id_id_pelanggan = $request->id_penjualan;
            $add->qty_penjualan = $request->qty_penjualan[$key];
            if (in_array($value, $barangCuci)) {
                $pelanggan = M_Pelanggan::find($request->id_pelanggan);
                if ($pelanggan->jumlahCuci() % 9 == 0) {
                    $add->total_penjualan = 0;
                }
            } else {
                $add->total_penjualan = $request->total_penjualan[$key];
            }

            $add->tgl_transaksi_penjualan = Date('Y-m-d');
            $i_nota = 1;
            $i_nota++;
            $add->no_nota = Date('m.d') . '.00' . $i_nota;
            $add->no_meja = $request->no_meja;
            // dd($add);
            $add->save();
        }

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data', 'id_penjualan' => $penjualan->id_penjualan));
    }

    public function editpenjualan($id_dt_penjualan)
    {

        $id_dt_penjualan = DT_Penjualan::find($id_dt_penjualan);

        // dd($t_cuci);

        $databarang = DB::table('m_barang')->get();

        $datapelanggan = DB::table('m_pelanggan')->get();

        return view('/transaksipenjualan/editpenjualan', [
            'dt_penjualan' => $id_dt_penjualan,
            'databarang' => $databarang,
            'datapelanggan' => $datapelanggan,
        ]);
    }

    public function updatepenjualan(Request $request)
    {
        $dt_penjualan = DT_Penjualan::find($request->id_dt_penjualan);

        $databarang = DB::table('m_barang')->where('id_barang', $dt_penjualan->id_barang)->first();

        // dd($databarang);

        $dt_penjualan->update([
            'qty_penjualan' => $request->qty_penjualan,
            'total_penjualan' => $request->qty_penjualan * $databarang->harga_barang,
        ]);
        // DB::table('dt_penjualan')->where('id_dt_penjualan', $request->id_dt_penjualan)->update([
        //     'qty_penjualan' => $request->qty_penjualan,
        //     'total_penjualan' => $request->qty_penjualan * $databarang->harga_barang,
        // ]);

        // dd($request);
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Edit Data'));
    }

    public function deletepenjualan($id_dt_penjualan)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('dt_penjualan')->where('id_dt_penjualan', $id_dt_penjualan)->delete();

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }

    public function getbarang(Request $request)
    {
        // menghapus data warga berdasarkan id yang dipilih
        // Warga::where('nik',$request->input('nik'))->first();
        $getbarang = DB::table('m_barang')->where('id_barang', $request->input('id_barang'))->first();

        return response()->json($getbarang);
    }

    function printthermal($id_penjualan)
    {
        $detailPenjualan = DB::table('t_penjualan')
            ->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', '=', 't_penjualan.id_penjualan')
            ->join('m_barang', 'm_barang.id_barang', '=', 'dt_penjualan.id_barang')
            ->where('id_penjualan', $id_penjualan)
            ->get();
        // dd($detailPenjualan);

        return view('/print/printpenjualan', [
            'detailPenjualan' => $detailPenjualan,
        ]);
    }

    public function closingpenjualan()
    {
        // menghapus data warga berdasarkan id yang dipilih
        $dataClosing = DB::table('t_penjualan')->where('status_closing', '0');

        $totalClosing = $dataClosing->join('dt_penjualan', 'dt_penjualan.id_t_penjualan', 't_penjualan.id_penjualan')
            ->sum('total_penjualan');

        $debit = $totalClosing * 5 / 100;
        // dd($totalClosing, $debit);

        $dataClosing->update([
            'status_closing' => 1,
            //     'total_penjualan' => $request->qty_penjualan * $databarang->harga_barang,
        ]);

        DB::table('t_kas')->insert([
            'debit' => $debit,
            'tgl_kas' => Date('Y-m-d'),
            'keterangan' => 'Kas Masuk'
        ]);

        return redirect('/transaksipenjualan/index');
        // view('/transaksipenjualan/index', [
        //     'detailPenjualan' => $detailPenjualan,
        // ]);
    }
}
