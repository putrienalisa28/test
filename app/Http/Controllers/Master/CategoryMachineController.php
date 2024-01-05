<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\CategoryMachineModel;
use App\Models\Master\MachineModel;
use Carbon\Carbon;

class CategoryMachineController extends Controller
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
        // // echo "tes";
        // $mesin = CategoryMachineModel::all();
        // $mesins = MachineModel::all();
        // $data = array(
        //     'mastermesincategory'    => $mesin,
        //     'mastermesin'            => $mesins
        // );

        $data['listOfCategoryMachine'] = CategoryMachineModel::where('deleted_at', '=', null)->get();
        $data['listOfMachine'] = MachineModel::all();
        // echo json_encode($data);
        // die;
        return view('pages/master/categorymachine/index', $data);
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
        try {
            if ($request->machine_category_id > 0) {
                // Find the machine by ID
                $categoryMachine = CategoryMachineModel::find($request->machine_category_id);

                // Check if the machine exists
                if (!$categoryMachine) {
                    return $this->httpResponse(404, 'Data Not Found', false);
                }
                $action = "Update";
            } else {
                $categoryMachine = new CategoryMachineModel;
                $action = "Save";
            }

            $categoryMachine->name_category_mesin = $request->categorymachine;
            $categoryMachine->tag = json_encode($request->tag);
            $categoryMachine->save();

            if ($categoryMachine->machine_category_id) {
                return $this->httpResponse(200, "$action Data Successfully", $categoryMachine);
            }
        } catch (\Throwable $e) {
            return $this->httpResponse(400, $e->getMessage(), false);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $categoryMachine_id = $request->get('category_id');
        $categoryMachine = CategoryMachineModel::find($categoryMachine_id);

        if ($categoryMachine) {
            // Set nilai deleted_date pada machine menjadi waktu saat ini
            $categoryMachine->deleted_at = Carbon::now();
            $categoryMachine->save();
    
            // Jika pengeditan berhasil, kirimkan respons sukses
            return $this->httpResponse(200, 'Deleted Successfully', false);
        } else {
            return  $this->httpResponse(400, 'Deleted Machine Filed', false);

        }
    }
}
