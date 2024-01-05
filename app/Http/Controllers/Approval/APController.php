<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\PmModel;
use App\Models\Master\MachineModel;
use App\Models\Master\SparepartModel;


class APController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $mastermachine_ = MachineModel::all();
        $sparepart      = SparepartModel::all();


        $pmdetail_ = PmModel::whereIn('machine_id', function ($query) {
            $query->select('machine_id')
                ->from('tb_trn_pm_hdr')
                ->distinct();
        })
            ->with(['pmDetail' => function ($query) {
                $query->where('approval_status', false);
            }])
            ->whereHas('pmDetail', function ($query) {
                $query->where('approval_status', false);
            })
            ->get();


        // echo json_encode($pmdetail_);
        // die;

        $machine_ids = $pmdetail_->pluck('machine_id')->toArray();
        $sparepart_ids = $pmdetail_->pluck('sparepart_id')->toArray();


        $data['approval'][] = [
            'listmachine' => MachineModel::whereIn('machine_id', $machine_ids)->get(),
            'pmd'         => $pmdetail_,
            'sparepart'   => SparepartModel::whereIn('id', $sparepart_ids)->get(),
        ];

        // echo json_encode($data['approval']);
        // die;

        // echo print_r($data['list_approval']);
        // die;


        return view('pages/Approval/index', $data);
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

        $dtlId = $request->dtl_id;
        $action = $request->action;


        $pmModel = PmModel::whereHas('pmDetail', function ($query) use ($dtlId) {
            $query->where('id', $dtlId);
        })->first();

        if ($pmModel) {
            if ($action === 'approve') {
                // Update the approval field to 1 for the specific dtl_id
                $pmModel->pmDetail()->where('id', $dtlId)->update([
                    'approval_status' => 1,
                    'approval_by' => $request->session()->get('username'),
                    'approval_date' => now()->format('Y-m-d H:i:s'),
                ]);

                // Return a response indicating success
                return response()->json(['message' => 'Approval  successfully'], 200);
            } else {
                // Update the rejection field to 1 for the specific dtl_id
                $pmModel->pmDetail()->where('id', $dtlId)->update([
                    'approval_status' => 0,
                    'reject_by' => $request->session()->get('username'),
                    'reject_date' => now()->format('Y-m-d H:i:s'),
                ]);


                // Return a response indicating success
                return response()->json(['message' => 'Rejected  successfully'], 200);
            }
        }

        // Return a response indicating failure (record not found)
        return response()->json(['message' => 'Record not found'], 404);
    }




    // Access the form data



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
