<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Barang extends Model
{
    protected $table = 'm_barang';
    public $timestamps = false;
    protected $primaryKey = 'id_barang';

    public function jumlah($id_pelanggan)
    {
        return $this->belongsTo(DT_Penjualan::class, 'id_barang', 'id_barang')
            ->join('t_penjualan', 'dt_penjualan.id_t_penjualan', 't_penjualan.id_penjualan')
            ->where('t_penjualan.id_pelanggan', $id_pelanggan)
            // ->get();
            ->sum('dt_penjualan.qty_penjualan');

        // dd($data);
    }
}
