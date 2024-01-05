<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MachineModel;
use App\Models\Master\DepartementModel;
use App\Models\Master\DepartementDtlModel;
use App\Models\Master\FRM\Sys015aMachineModel;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;


class DepartementController extends Controller
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

        $url = 'http://192.168.12.68/Memo_API/APDApi/getDeptTPM'; // Ganti dengan URL API yang sesuai

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        
        $dept               = json_decode($response);
        $mesin              = Sys015aMachineModel::all();
        $list_machine       = DepartementModel::where('deleted_at', '=', null)->with('deptDtl', 'deptDtl.machine')->get();

        //   echo json_encode([$list_machine]);
        //     die;

        $data = array(
                    'dept'      => $dept,
                    'mesin'     => $mesin,          
                    'list_data' => $list_machine
            
        );
        // echo json_encode($data['list_data']);
        //     die;

        return view('pages/master/departement/index', $data);
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $keyword
     * @return \Illuminate\Http\Response
     */
    public function getDeptByPay(Request $request)
    {
        // $item = new MysamInModel();

        // $listItem = $item->getItemById($request->input('keyword'));

        $url = 'http://192.168.12.68/Memo_API/APDApi/getDeptTPMById/' . $request->input('dept_id'); // Ganti dengan URL API yang sesuai

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response);

        // Lakukan operasi lain dengan data yang diterima dari API
        // ...

        $response = response()->json($data);



        // if (count($response->original) == 0) return $this->httpResponse(404, 'Data Not Found', false);

        return $this->httpResponse(200, 'Data From Master', $response->original);
    }
  
    public function store(Request $request)
    {
       
        DB::beginTransaction();
        try {
            if ($request->header_id > 0) {
                 // Update
                // Find the sparepart by ID
                $post = DepartementModel::find($request->header_id);

                // Check if the sparepart exists
                if (!$post) {
                    DB::rollback();
                    return $this->httpResponse(404, 'Department Not Found', false);
                }

                // Update the sparepart with the new data
                $post->dept_id = $request->iddept;
                $post->dept_abbr = $request->namadeptabbr;
                $post->nama_panjang = $request->namapanjang;

                //  echo json_encode($post);
                // // die;
               
                // Save the changes
                $post->save();

                // Save detail sparepart detail machine
                DepartementDtlModel::where('header_id', $post->header_id)->delete();
                
                $data = collect($request->IdMachine)->map(function ($item) use ($post) {
                    return [
                        'header_id' => $post->header_id,
                        'machine_id' => $item,
                      
                    ];
                });             
                DepartementDtlModel::insert($data->toArray());

                DB::commit();

                return $this->httpResponse(200, 'Save Data Successfully', true);
            } else {
                // Insert
                $postData = [
                    'dept_id' => $request->iddept,
                    'nama_panjang' => $request->namapanjang,
                    'dept_abbr' => $request->namadeptabbr,
                    
                ];
               
                $post = DepartementModel::create($postData);

                $data = collect($request->IdMachine)->map(function ($item) use ($post) {
                    return [
                        'header_id' => $post->header_id,
                        'machine_id' => $item
                    ];
                });
                // echo json_encode($data);
                // die;
                DepartementDtlModel::insert($data->toArray());

                DB::commit();

                return $this->httpResponse(200, 'Save Data Successfully', true);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function delete(Request $request)
    {
        $header_id = $request->get('header_id');
        $department = DepartementModel::find($header_id);

        // Hapus baris berikut jika Anda tidak ingin mengecho $department
        // echo json_encode($department);
        // die;

        if ($department) {
            // Set nilai deleted_date pada $department menjadi waktu saat ini
            $department->deleted_at = \Carbon\Carbon::now();
            $department->save();

            // Jika pengeditan berhasil, kirimkan respons sukses
            return $this->httpResponse(200, 'Deleted Successfully', false);
        } else {
            return $this->httpResponse(400, 'Deleted Dept Failed', false);
        }
    }



}
