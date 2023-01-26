<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Pelanggan extends Model
{
    protected $table = 'm_pelanggan';
    public $timestamps = false;
    protected $primaryKey = 'id_pelanggan';

    public function jumlahType()
    {
        return $this->belongsTo(T_Penjualan::class, 'id_pelanggan', 'id_pelanggan')
            ->join('dt_penjualan', 't_penjualan.id_penjualan', 'dt_penjualan.id_t_penjualan')
            ->join('m_barang', 'dt_penjualan.id_barang', 'm_barang.id_barang')
            ->select('m_barang.id_barang')
            ->where('m_barang.nama_barang', 'like', '%cuci%')
            ->groupBy('m_barang.id_barang')
            ->get();

        // dd(count($barang));
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
}
