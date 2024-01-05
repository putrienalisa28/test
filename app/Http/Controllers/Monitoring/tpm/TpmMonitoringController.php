<?php

namespace App\Http\Controllers\monitoring\tpm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\SparepartModelDtlMachine;

class TpmMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/monitoring/pm/index');
    }

    function getTpmByParam(Request $request)
    {
        $machineId = $request->machine_id;
        $data = SparepartModelDtlMachine::with(['sparepart', 'pmHeader' => function ($query) use ($machineId) {
            $query->where('machine_id', $machineId);
        }, 'pmHeader.pmIntervalDetail', 'pmHeader.pmDetail'])->where('id_machine', $machineId)->get();

        return $this->httpResponse(200, 'success', $data);
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
