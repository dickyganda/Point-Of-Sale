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
}
