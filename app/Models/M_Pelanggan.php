<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Pelanggan extends Model
{
    protected $table = 'm_pelanggan';
    public $timestamps = false;
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'jumlah_cucian',
        'no_telepon_pelanggan',
        'status_pelanggan',
        'tgl_add_pelanggan',
        'deleted_at',
    ];

    public function jumlahType($request)
    {
        $from = date('Y-m-d', strtotime($request->min));
        $to = date('Y-m-d', strtotime($request->max));

        $barang = $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('m_barang.id_barang')
            ->where('m_barang.nama_barang', 'like', '%cuci%')
            ->whereBetween('dt_penjualan.tgl_transaksi_penjualan', [$from, $to])
            ->groupBy('m_barang.id_barang')
            ->get();

        // dd($barang);
        return count($barang);
    }

    public function jumlahCuciMotor()
    {
        $jmlCuci = $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('m_barang.nama_barang', 'dt_penjualan.qty_penjualan')
            ->where('m_barang.nama_barang', 'like', '%motor%')
            ->sum('dt_penjualan.qty_penjualan');
        // ->get();

        return $jmlCuci % 10;
    }

    public function totalCuciMotor($request)
    {
        $min = isset($request->min) && $request->min != null ? date('Y-m-d', strtotime($request->min)) : date('Y-m-d');
        $max = isset($request->max) && $request->max != null ? date('Y-m-d', strtotime($request->max)) : date('Y-m-d');

        $jmlCuci = $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->whereBetween('dt_penjualan.tgl_transaksi_penjualan', [$min, $max])
            ->select('m_barang.nama_barang', 'dt_penjualan.qty_penjualan')
            ->where('m_barang.nama_barang', 'like', '%motor%')
            ->sum('dt_penjualan.qty_penjualan');
        // ->get();

        return $jmlCuci;
    }

    public function jumlahCuciMobil()
    {
        $jmlCuci = $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('m_barang.nama_barang', 'dt_penjualan.qty_penjualan')
            ->where('m_barang.nama_barang', 'like', '%mobil%')
            ->sum('dt_penjualan.qty_penjualan');
        // ->get();

        return $jmlCuci % 10;
    }

    public function totalCuciMobil($request)
    {
        $min = isset($request->min) && $request->min != null ? date('Y-m-d', strtotime($request->min)) : date('Y-m-d');
        $max = isset($request->max) && $request->max != null ? date('Y-m-d', strtotime($request->max)) : date('Y-m-d');

        $jmlCuci = $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->whereBetween('dt_penjualan.tgl_transaksi_penjualan', [$min, $max])
            ->select('m_barang.nama_barang', 'dt_penjualan.qty_penjualan')
            ->where('m_barang.nama_barang', 'like', '%mobil%')
            ->sum('dt_penjualan.qty_penjualan');
        // ->get();

        return $jmlCuci;
    }
}
