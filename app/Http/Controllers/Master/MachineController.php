<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MachineModel;
use Carbon\Carbon;

class MachineController extends Controller
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

        $data['listOfMachine'] = MachineModel::where('deleted_at', '=', null)->get();

        // echo json_encode($data);
        // die;

        return view('pages/master/machine/index', $data);
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
        // Check if a machine ID is provided in the request
        // if ($request->machine_id > 0) {
        //     // Find the machine by ID
        //     $machine = MachineModel::find($request->machine_id);

        //     // Check if the machine exists
        //     if (!$machine) {
        //         return response()->json(['message' => 'Machine not found'], 404);
        //     }

        //     // Update the machine with the new data
        //     $machine->machine_name = $request->machine_name;
        //     $machine->location = $request->location;
        //     $machine->tag = json_encode($request->tag);
        //     $machine->tbl_from_prk_server = $request->table_name;

        //     // Save the changes
        //     $machine->save();

        //     return response()->json(['message' => 'Machine updated successfully', 'machine' => $machine]);
        // } else {
        //     // Create a new machine if no machine ID is provided
        //     $machine = new MachineModel;

        //     $machine->machine_name = $request->machine_name;
        //     $machine->location = $request->location;
        //     $machine->tag = json_encode($request->tag);
        //     $machine->tbl_from_prk_server = $request->table_name;


        //     $machine->save();

        //     return response()->json(['message' => 'Machine created successfully', 'machine' => $machine]);
        // }

        try {
            if ($request->machine_id > 0) {
                $machine = MachineModel::find($request->machine_id);

                if (!$machine) {
                    return response()->json(['message' => 'Machine not found'], 404);
                }
            } else {
                $machine = new MachineModel;
            }

            $machine->machine_name = $request->machine_name;
            $machine->serial_number = $request->serial_number;
            $machine->location = $request->location;
            $machine->tag = $request->tag;
            $machine->tbl_from_prk_server = $request->table_name;

            $machine->save();

            $message = ($request->machine_id > 0) ? 'Machine updated successfully' : 'Machine created successfully';

            return $this->httpResponse(200, $message, true);
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

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        MachineModel::whereId($id)->update($validatedData);

        return redirect()->route('machine.index')->with('success', 'Master updated successfully');
        // $machine = MachineModel::find($request->machine_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $machine_id = $request->get('machine_id');
        $machine = MachineModel::find($machine_id);

        if ($machine) {
            // Set nilai deleted_date pada machine menjadi waktu saat ini
            $machine->deleted_at = Carbon::now();
            $machine->save();

            // Jika pengeditan berhasil, kirimkan respons sukses
            return $this->httpResponse(200, 'Deleted Successfully', false);
        } else {
            return  $this->httpResponse(400, 'Deleted Machine Filed', false);
        }
    }
}
