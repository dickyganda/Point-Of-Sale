<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Barang extends Model
{
    protected $table = 'm_barang';
    public $timestamps = false;
    protected $primaryKey = 'id_barang';

    public function jumlah($id_pelanggan, $date)
    {
        $from = date('Y-m-d', strtotime($date->min));
        $to = date('Y-m-d', strtotime($date->max));
        return $this->belongsTo(DT_Penjualan::class, 'id_barang', 'id_barang')
            ->join('t_penjualan', 'dt_penjualan.id_t_penjualan', 't_penjualan.id_penjualan')
            ->where('t_penjualan.id_pelanggan', $id_pelanggan)
            ->where('deleted_at', '=', null)
            ->whereBetween('dt_penjualan.tgl_transaksi_penjualan', [$from, $to])
            // ->get();
            ->sum('dt_penjualan.qty_penjualan');

        // dd($data);
    }
}
