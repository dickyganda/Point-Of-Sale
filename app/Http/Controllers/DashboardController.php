<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DT_Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $total_penjualan_day = DT_Penjualan::selectRaw('sum(total_penjualan) as total')
            ->whereDay('tgl_transaksi_penjualan', date('d'))
            ->first()->total;

        $total_penjualan_month = DT_Penjualan::selectRaw('sum(total_penjualan) as total')
            ->whereMonth('tgl_transaksi_penjualan', date('m'))
            ->first()->total;
        // dd($total_penjualan_day);

        return view(
            '/dashboard/index',
            [
                'total_penjualan_day' => $total_penjualan_day,
                'total_penjualan_month' => $total_penjualan_month,

            ]
        );
    }
}
