<?php

namespace App\Http\Controllers\Eform;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Eform\Form015aModel;

class GetDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getmaster()
    {
        $data = Form015aModel::where('jenisform', 1)->with('fm015category', 'fm015category.Form015asubcategory')->get();
        return response()->json($data, 200);
    }

    public function getmastertahunan()
    {
        $data = Form015aModel::where('jenisform', 3)->with('fm015category', 'fm015category.Form015asubcategory')->get();
        return response()->json($data, 200);
    }

    public function ceklisharian(Request $request)
    {
        $data = DB::table('tbl_trn_formsys_dtl as a')
            ->join('tbl_trn_formsys_hdr as b', 'a.hdr_id', '=', 'b.id')
            ->where('b.mesin_id', $request->input('machine_id'))
            ->where('b.dept', $request->input('department'))
            ->whereMonth('b.month', $request->input('month'))
            ->whereYear('b.month', $request->input('year'))
            ->select('a.days', 'a.sub_category_id', 'a.status', 'a.remarks')
            ->get();
        return response()->json($data, 200);
    }

    public function ceklistahunan(Request $request)
    {
        $data = DB::table('tbl_formsys_tahun_dtl as a')
            ->join('tbl_formsys_tahun_hdr as b', 'a.hdr_id', '=', 'b.id')
            ->where('b.mesin_id', $request->input('machine_id'))
            ->where('b.dept', $request->input('department'))
            ->whereYear('b.tahun', $request->input('year'))
            ->select('a.plan', 'a.realisasi', 'a.status', 'a.statustpm', 'a.bulan', 'a.subcategory_id', 'a.nama')
            ->get();
        return response()->json($data, 200);
    }




    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
