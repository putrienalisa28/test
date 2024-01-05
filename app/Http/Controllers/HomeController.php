<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $connectionName = 'secondary';
        DB::setDefaultConnection($connectionName);

        $sqlRunHours = DB::table('homo1_hourmeter')
            ->select(DB::raw("'vtis1' AS machine"), DB::raw('MAX(actualrun_hour) AS run_hour'))
            ->union(function ($query) {
                $query->select(DB::raw("'vtis2' AS machine"), DB::raw('MAX(actualrun_hour) AS run_hour'))
                    ->from('homo2_hourmeter');
            })
            ->union(function ($query) {
                $query->select(DB::raw("'vtis3' AS machine"), DB::raw('MAX(actualrun_hour) AS run_hour'))
                    ->from('homo3_hourmeter');
            })
            ->union(function ($query) {
                $query->select(DB::raw("'vtis4' AS machine"), DB::raw('MAX(actualrun_hour) AS run_hour'))
                    ->from('homo4_hourmeter');
            })
            ->get();


        // Setel koneksi kembali ke koneksi default
        DB::setDefaultConnection('pgsql');

        $data['runningMachine'] = $sqlRunHours;


        return view('pages/index', $data);
    }
}
