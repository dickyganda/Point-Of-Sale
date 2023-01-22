<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\T_Kas;

class ReportController extends Controller
{

    function Index()
    {

        return view(
            'report/index',
            [
                // 'dataSaldo' => $dataSaldo,
                // 't_kas' => $t_kas,
                // 'databarang' => $databarang,
                // 'datarekanan' => $datarekanan,

            ]
        );
    }
}
