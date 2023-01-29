<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class T_Penjualan extends Model
{
    protected $table = 't_penjualan';
    protected $primaryKey = 'id_penjualan';

    public function jumlahBarang()
    {
        return $this->belongsTo(DT_Penjualan::class, 'id_penjualan', 'id_t_penjualan')->count();
        // return $this->has(User::class, 'id_dokter');
    }

    public function totalHarga()
    {
        return $this->belongsTo(DT_Penjualan::class, 'id_penjualan', 'id_t_penjualan')->sum('total_penjualan');
        // return $this->has(User::class, 'id_dokter');
    }

    public function pelanggan()
    {
        return $this->belongsTo(M_Pelanggan::class, 'id_pelanggan', 'id_pelanggan')->first();
    }

    public function dt_penjualan()
    {
        return $this->belongsTo(DT_Penjualan::class, 'id_penjualan', 'id_t_penjualan')
            ->join('m_barang', 'm_barang.id_barang', 'dt_penjualan.id_barang')
            ->where('dt_penjualan.deleted_at', '=', null)
            ->select('dt_penjualan.*', 'm_barang.nama_barang', 'm_barang.harga_barang')
            ->get();
    }
}
