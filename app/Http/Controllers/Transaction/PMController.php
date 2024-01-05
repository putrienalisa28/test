<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MachineModel;
use App\Models\Master\CategoryMachineModel;
use App\Models\Master\SparepartModel;
use App\Models\Master\SparepartModelDtlMachine;
use App\Models\Transaction\MaintenanceModel;
use App\Models\Transaction\PmdtlModel;
use App\Models\Transaction\PmdtlteamModel;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction\PmModel;
use App\Models\Transaction\PmIntervalDetail;
use App\Models\Transaction\RencanaTpmModel;
use Illuminate\Support\Facades\URL;
use App\Models\Transaction\RencanaTpmDetail;

class PMController extends Controller
{
    public function index()
    {
        return view('pages/master/pm/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uht()
    {


        foreach (MachineModel::get() as $machine) {
            $connectionName = 'secondary';
            $hrmMachine = null;

            // Periksa apakah mesin memiliki tabel terkait dalam koneksi yang ditentukan
            if ($machine->tbl_from_prk_server != null) {
                // Ambil record terbaru dari tabel terkait
                $hrmMachine = DB::connection($connectionName)->table($machine->tbl_from_prk_server)->latest('id')->first();
            }

            // Siapkan data untuk array 'machine'
            $data['machine'][] = [
                'machine_id' => $machine->machine_id,
                'machine_name' => $machine->machine_name,
                'location' => $machine->location,
                'hrm_machine' => $hrmMachine,
            ];

            // Atur kembali koneksi database default menjadi 'pgsql'
            DB::setDefaultConnection('pgsql');
        }

        // Kirimkan data ke view dan render template 'pages/transaction/pm/index'
        return view('pages/transaction/pm/index', $data);
    }

    public function maintenance($id)
    {
        $machine = MachineModel::find($id);
        $connectionName = 'secondary';
        $prk = DB::connection($connectionName)->table($machine->tbl_from_prk_server)->latest('id')->first();

        DB::setDefaultConnection('pgsql');


        $data = [
            'machine_id' => $machine->machine_id,
            'machine_name' => $machine->machine_name,
            'location' => $machine->location,
            'tag' => $machine->tag,
            'serial_number' => $machine->serial_number,
            'last_interval_maintenance' => $machine->last_interval_maintenance,
            'interval_detail' => PmModel::with('sparepart', 'pmDetail', 'pmIntervalDetail')->where('machine_id', $id)->get(),
            'prkserver' => $prk,
        ];

        $data['listSparepart'] = SparepartModelDtlMachine::with(['sparepart', 'pmHeader' => function ($query) use ($id) {
            $query->where('machine_id', $id);
        }, 'pmHeader.pmIntervalDetail'])->where('id_machine', $id)->get();

        $rencanaTpmDetail = new RencanaTpmModel();
        $listRencanaTpmDetail = $rencanaTpmDetail->getSparepart($id);
        $data['sparepartNotReady'] = array_column(json_decode($listRencanaTpmDetail, true), 'sparepart_id');

        // echo json_encode($data['listSparepart']);
        // die;
        // dd($data['listSparepart']);
        // die;


        return view('pages/transaction/pm/maintenance', $data);


        echo json_encode($data['list_category_machine']);
        die;


        return view('pages/transaction/pm/maintenance', $data);
    }

    function getByParam(Request $request)
    {
        $param = $request->all();


        $row = $data['firstRecord'] = PmModel::with(['pmDetail', 'sparepart'])
            ->where(['machine_id' => $param['machineId'], 'sparepart_id' => $param['sparepartId']])
            ->orderBy('id', 'desc')
            ->first();

        $sparepart = SparepartModel::find($param['sparepartId']);

        if ($row == false) return $this->httpResponse(404, 'Data Not Found', $sparepart);



        return $this->httpResponse(200, 'OK', $row);

        // return $this->httpResponse(200, 'OK', $row);
    }

    function getIntervalDetail(Request $request)
    {

        // echo json_encode($request->all());
        // die;
        $sql = PmModel::with('pmIntervalDetail', 'sparepart')->where([
            'sparepart_id' => $request->sparepartId,
            'category_maintenance' => $request->categoryMaintenance,
            'machine_id' => $request->machineId
        ])->first();
        // if ($sql == null) return $this->httpResponse(404, 'Data Not Found', $sql);
        return $this->httpResponse(200, 'OK', $sql);
    }

    function saveIntervalDetail(Request $request)
    {

        try {
            if ($request->interval_id > 0) {
                PmIntervalDetail::where('id', $request->interval_id)
                    ->update([
                        'lable' => $request->lable,
                        'interval' => $request->interval,
                        'last_interval' => $request->last_interval,
                        'action_lable' => $request->action_lable,
                    ]);
                return $this->httpResponse(200, 'Update Interval Success', true);
            } else {
                $hdr = PmModel::where('sparepart_id', $request->sparepart_id)
                    ->where('machine_id', $request->machine_id)
                    ->first();

                if (!$hdr) {
                    $hdr = PmModel::create([
                        'sparepart_id' => $request->sparepart_id,
                        'machine_id' => $request->machine_id
                    ]);
                }

                $data = [
                    'hdr_id' => $hdr->id,
                    'lable' => $request->lable,
                    'interval' => $request->interval,
                    'last_interval' => $request->last_interval,
                    'action_lable' => $request->action_lable,
                ];

                $sql = PmIntervalDetail::insert($data);
                return $this->httpResponse(200, 'Save Interval Success', $sql);
            }
        } catch (\Throwable $th) {
            return $this->httpResponse(500, 'OK', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $pmHeader = PmModel::where('machine_id', $request->machine_id)
                ->where('sparepart_id', $request->sparepart_id)
                ->first();

            if (!$pmHeader) {
                $pmHeader = new PmModel();
                $pmHeader->sparepart_id = $request->sparepart_id;
                $pmHeader->machine_id = $request->machine_id;
                $pmHeader->last_interval = $request->last_interval;
                $pmHeader->save();
            } else {
                if ($request->last_interval != 'Check') {
                    $pmHeader->last_interval = $request->last_interval;
                    $pmHeader->updated_at = date('Y-m-d H:i:s');
                    $pmHeader->save();
                }
            }

            $pmDetail = new PmdtlModel();
            $pmDetail->hdr_id = $pmHeader->id;
            $pmDetail->indication = $request->indication;
            $pmDetail->problem_solv = $request->problem_solv;
            $pmDetail->checking_result = $request->checking_result;
            $pmDetail->maintenance_status = $request->maintenance_status;
            $pmDetail->remarks = $request->remarks;
            $pmDetail->last_interval = $request->last_interval;
            $pmDetail->maintenance_date = $request->maintenance_date;
            $pmDetail->save();

            DB::commit();
            return $this->httpResponse(200, "Save Data Success", $pmHeader);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    function saveTPM(Request $request)
    {
        // echo json_encode($request->all());
        // die;
        try {

            // $filterCheckTpm = array_filter($request->condition, function ($subArray) {
            //     return !empty(array_filter($subArray, function ($item) {
            //         return $item !== null;
            //     }));
            // });

            foreach ($request->condition as $key => $val) {
                if ($val != null) {
                    $getSparepart = DB::table('tb_trn_pm_interval AS a')
                        ->join('tb_trn_pm_hdr AS b', 'a.hdr_id', '=', 'b.id')
                        ->select('b.id as hdr_id', 'sparepart_id', 'machine_id', 'a.id AS interval_id')
                        ->where('a.id', $key)
                        ->first();

                    if ($getSparepart) {
                        $data[] = [
                            'hdr_id' => $getSparepart->hdr_id,
                            'interval_id' => $key,
                            'remarks' => $request->remarksTpm[$key],
                            'condition' => $val,
                            'create_at' => date('Y-m-d H:i:s'),
                            'create_by' => $request->session()->get('username'),
                        ];

                        MachineModel::where('machine_id',  $getSparepart->machine_id)->update([
                            'last_interval_maintenance' => $request->last_interval,
                        ]);

                        PmIntervalDetail::where('id', $key)->update([
                            'last_interval' => $request->last_interval,
                            'pm_status' => 1
                        ]);

                        $getRencanaDetail = DB::table('tbl_trn_rencana_tpms_detail')
                            ->where('sparepart_id', $getSparepart->sparepart_id)
                            ->where('machine_id', $getSparepart->machine_id)
                            ->first();

                        if ($getRencanaDetail) {
                            DB::table('tbl_trn_rencana_tpms_detail')
                                ->where('sparepart_id', $getSparepart->sparepart_id)
                                ->where('machine_id', $getSparepart->machine_id)
                                ->update(['sudah_dilakukan_tpm' => true]);
                        }
                    }
                }
            }

            $sql = PmdtlModel::insert($data);


            // foreach ($filterCheckTpm as $key => $val) {
            //     foreach ($filterCheckTpm[$val] as $item) {
            //         if ($item != null) {
            //             $data[] = [
            //                 'interval_id' => $val,
            //             ];
            //         }
            //     }
            // }

            echo json_encode($sql);
            die;



            $i = 0;
            foreach ($request->header_id as $key => $headerId) {
                if (isset($request->condition[$headerId]) && $request->condition[$headerId] != null) {
                    $i += count(array_filter($request->condition[$headerId], function ($val) {
                        return $val != null;
                    }));
                }
            }

            if ($i == 0) {
                return $this->httpResponse(400, 'Silahkan Pilih Salah Satu Sparepart', false);
            }

            DB::beginTransaction();

            $insertHeader = MaintenanceModel::updateOrCreate(
                [
                    'machine_id' => $request->machine_id,
                    'maintenance_date' => dateFormater($request->maintenance_date, 'Y-m-d'),
                ],
                [
                    'maintenance_date' => dateFormater($request->maintenance_date, 'Y-m-d H:i:s'),
                    'remarks' => $request->catatan,
                ]
            )->id;


            // $insertHeader berisi ID jika data sudah ada, atau null jika data baru dibuat


            if ($insertHeader) {
                $data = [];
                foreach ($request->header_id as $key => $headerId) {
                    if (isset($request->condition[$headerId]) && $request->condition[$headerId] != null) {
                        $condition = $request->condition[$headerId];
                        $intervalIds = $request->interval_id[$headerId];
                        $remarks = $request->remarks[$headerId] ?? [];

                        foreach ($intervalIds as $index => $intervalId) {
                            if ($condition && isset($condition[$index])) {
                                PmIntervalDetail::where('id', $intervalId)->update([
                                    'last_interval' => $request->last_interval,
                                    'sudah_dilakukan_tpm' => true,
                                    'pm_status' => 1
                                ]);

                                $$data[] = [
                                    "maintenance_id" => $insertHeader,
                                    "hdr_id" => $headerId,
                                    "condition" => $condition[$index],
                                    "interval_id" => $intervalId,
                                    "remarks" => isset($remarks[$index]) ? $remarks[$index] : null,
                                ];
                            }
                        }
                    }
                }

                if (!empty($data)) {
                    PmdtlModel::insert($data);
                } else {
                    DB::rollback();
                    return $this->httpResponse(400, 'Database Occured', false);
                }
            }

            DB::commit();
            return $this->httpResponse(200, "Maintenance Berhasil Dilakukan", true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function saveHdr(Request $request)
    {

        try {

            foreach ($request->sparepart_id as $key => $sparepart_id) {
                $pmHeader = PmModel::where('machine_id', $request->machine_id)
                    ->where('sparepart_id', $sparepart_id)
                    ->where('category_maintenance', $request->category_maintenance[$key])
                    ->first();

                if (!$pmHeader) {
                    $pmHeader = new PmModel();
                    $pmHeader->sparepart_id = $sparepart_id;
                    $pmHeader->machine_id = $request->machine_id;
                    $pmHeader->category_maintenance = $request->category_maintenance[$key];
                    $pmHeader->save();
                }
            }
            return $this->httpResponse(200, "Save Data Success", true);
        } catch (\Throwable $th) {
            return $this->httpResponse(500, $th->getMessage(), false);
        }
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

    //////////////TPMS////////////////////
    public function rencanaTpm()
    {
        $data['title'] = 'Rencana TPM';
        // $data['listRencanaTpm'] = RencanaTpmModel::with(["machine", "rencanaTpmDetail", "rencanaTpmDetail.sparepart"])->get();

        $data['listRencanaTpm'] = RencanaTpmModel::with(["machine", "rencanaTpmDetail" => function ($query) {
            $query->where(["sudah_dilakukan_tpm" => false]);
        }, "rencanaTpmDetail.sparepart"])->where('tpm_selesai',  false)->get();


        return view('pages/transaction/pm/rencana-tpm', $data);
    }

    function confirmStatusSparepart(Request $request)
    {
        try {
            $rencanaTpmModel = new RencanaTpmModel();


            $rencanaTpmDetail = $rencanaTpmModel->getRencanaTpmDetail($request);

            $data = [
                'status_stock' => $request->status_stock,
                'check_by' => $request->session()->get('username'),
                'check_date' => date('Y-m-d H:i:s'),
                'sparepart_id' => $rencanaTpmDetail->sparepart_id,
                'machine_id' => $rencanaTpmDetail->machine_id,
            ];

            $sql = $rencanaTpmModel->updateRencanaTpmDetail($data);

            if ($sql) return $this->httpResponse(200, "Success", true);

            $this->httpResponse(400, "Failed", false);
        } catch (\Throwable $th) {
            return $this->httpResponse(500, $th->getMessage(), false);
        }

        // TransactionRencanaTpmDetail::where('id', $request->id)->update([
        //     'sudah_dilakukan_tpm' => $request->sudah_dilakukan_tpm,
        //     'keterangan' => $request->keterangan,
        // ]);


    }


    /////////////END TPMS/////////////////
}
