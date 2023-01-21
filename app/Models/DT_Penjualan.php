<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DT_Penjualan extends Model
{
    protected $table = 'dt_penjualan';
    public $timestamps = false;
    protected $primaryKey = 'id_dt_penjualan';
    protected $fillable = ['id_t_penjualan', 'id_barang', 'qty_penjualan', 'total_penjualan', 'tgl_transaksi_penjualan'];

    public function namaPelanggan()
    {
        $penjualan = $this->belongsTo(T_Penjualan::class, 'id_t_penjualan', 'id_penjualan')->first('id_pelanggan');

        if ($penjualan->id_pelanggan == null) {
            return null;
        } else {
            $pelanggan = M_Pelanggan::find($penjualan->id_pelanggan);
            // dd($pelanggan->nama_pelanggan);
            return $pelanggan->nama_pelanggan;
        }
    }

    public function namaBarang()
    {
        return $this->belongsTo(M_Barang::class, 'id_barang', 'id_barang')->first('nama_barang')->nama_barang;
    }

    public function closing()
    {
        $t_penjualan = $this->belongsTo(T_Penjualan::class, 'id_t_penjualan', 'id_penjualan')->first('status_closing');

        if ($t_penjualan->status_closing) {
            return false;
        } else {
            return true;
        }
    }
}
