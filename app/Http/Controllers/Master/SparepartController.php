<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\SparepartModel;
use App\Models\Master\MachineModel;
use App\Models\MysamInModel;
use App\Models\Master\CategoryMachineModel;
use Illuminate\Support\Facades\DB;
use App\Models\Master\SparepartModelDtlMachine;
use PhpParser\Node\Stmt\Echo_;

use function PHPUnit\Framework\isNull;
use Carbon\Carbon;


class SparepartController extends Controller
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

        $sparepart    = SparepartModel::all();
        $mesins       = MachineModel::all();
        $category     = CategoryMachineModel::all();
        $sparepart_dtl = SparepartModelDtlMachine::all();
        $data = array(
            'mastersparepart'    => $sparepart,
            'mastermesin'        => $mesins,
            'categorymachine'    => $category,
            'sparepartdtl'       => $sparepart_dtl,
            'sparepart' => SparepartModel::with('sparepartDtl', 'sparepartDtl.machine')->where('deleted_at', '=', null)->get()
        );
        // dd($data['sparepart']);
        // die;
        // $data['sparepart'] = SparepartModel::with('sparepartDtl', 'sparepartDtl.machine')->get();
        // echo '<pre>';
        // print_r($data['sparepart']);
        // die;

        // echo json_encode($data['sparepart']);
        // die;
        return view('pages/master/sparepart/index', $data);
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

        DB::beginTransaction();
        try {
            if ($request->id > 0) {
                // Find the sparepart by ID
                $post = SparepartModel::find($request->id);

                // Check if the sparepart exists
                if (!$post) {
                    DB::rollback();
                    return $this->httpResponse(404, 'Sparepart Not Found', false);
                }

                // Update the sparepart with the new data
                $post->item_id = $request->itemNumber;
                $post->item_name = $request->itemName;
                $post->doc_no = $request->docNo;
                $post->actual_interval = $request->actualInterval;
                $post->interval = $request->interval;
                $post->spare_part_no = $request->sparePartNumber;
                $post->tag = json_encode($request->tag);

                // Save the changes
                $post->save();

                // Save detail sparepart detail machine
                SparepartModelDtlMachine::where('id_sparepart', $post->id)->delete();

                $data = collect($request->IdMachine)->map(function ($item) use ($post) {
                    return [
                        'id_sparepart' => $post->id,
                        'id_machine' => $item,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });

                SparepartModelDtlMachine::insert($data->toArray());

                DB::commit();

                return $this->httpResponse(200, 'Save Data Successfully', true);
            } else {

                if (count(SparepartModel::where('item_id', $request->itemNumber)->get()) > 0)
                    return $this->httpResponse(500, 'Item Number Already Exist', false);

                $postData = [
                    'item_id' => $request->itemNumber,
                    'item_name' => $request->itemName,
                    'doc_no' => $request->docNo,
                    'actual_interval' => $request->actualInterval,
                    'interval' => $request->interval,
                    'spare_part_no' => $request->sparePartNumber,
                    'tag' => json_encode($request->tag),
                ];

                $post = SparepartModel::create($postData);

                $data = collect($request->IdMachine)->map(function ($item) use ($post) {
                    return [
                        'id_sparepart' => $post->id,
                        'id_machine' => $item,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });

                SparepartModelDtlMachine::insert($data->toArray());

                DB::commit();

                return $this->httpResponse(200, 'Save Data Successfully', true);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
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
    public function delete(Request $request)
    {
        $sparepart_id = $request->get('sparepart_id');
        $sparepart = SparepartModel::find($sparepart_id);

        if ($sparepart) {
            // Set nilai deleted_date pada s$sparepart menjadi waktu saat ini
            $sparepart->deleted_at = Carbon::now();
            $sparepart->save();

            // Jika pengeditan berhasil, kirimkan respons sukses
            return $this->httpResponse(200, 'Deleted Successfully', false);
        } else {
            return  $this->httpResponse(400, 'Deleted Sparepart Filed', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $keyword
     * @return \Illuminate\Http\Response
     */
    public function getItemMySamin(Request $request)
    {
        // $item = new MysamInModel();

        // $listItem = $item->getItemById($request->input('keyword'));

        $url = 'http://192.168.12.68/Memo_API/APDApi/getItemByItemName/' . $request->input('keyword'); // Ganti dengan URL API yang sesuai

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

        if (count($response->original) == 0) return $this->httpResponse(404, 'Data Not Found', false);

        return $this->httpResponse(200, 'Data From Master', $response->original);
    }
}
