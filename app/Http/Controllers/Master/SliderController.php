<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\SliderModel;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actualhour= DB::table('tbl_mst_slider')->latest('id_slider')->first();
        $data['actualhour'] = [
            'id_slider' => $actualhour->id_slider,
            'max_actualrun_hour' => $actualhour->max_actualrun_hour,
            'min_actualrun_hour' => $actualhour->min_actualrun_hour
         
        ];
        // print_r($data['actualhour']);
        // die;
        return view('pages/master/slider/index',$data);
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
            if ($request->id_slider > 0) {
                $slider = SliderModel::find($request->id_slider);

                if (!$slider) {
                    return response()->json(['message' => 'Actual Run Hour'], 404);
                }
            } else {
                $slider = new SliderModel;
            }

            $slider->max_actualrun_hour = $request->ariaValuemax;
            $slider->min_actualrun_hour = $request->ariaValuenow;
           

            $slider->save();

            $message = ($request->machine_id > 0) ? 'Actual Run Hour updated successfully' : 'Actual Run Hour created successfully';

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
