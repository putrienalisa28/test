<?php

namespace App\Http\Controllers\Accounting\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounting\Master\Coa;

class CoaController extends Controller
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


        return view('pages/accounting/master/coa/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $users = DB::table('users')->leftJoin('posts', 'users.id', '=', 'posts.user_id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->input();


        $coa = Coa::where('NoCOA', $post['accountNumber'])->first();

        $coa = new Coa;
        $coa->NoCOA = $post['accountNumber'];
        $coa->AccountName = $post['accountName'];
        $coa->GroupCOA = $post['groupName'];
        $coa->save();

        if ($coa->exists) {
            echo $this->httpResponse(200, "Save Coa Successfully");
        } else {
            echo $this->httpResponse(400, "Save Coa Failed");
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

    public function getAllByParam(Request $request)
    {
        $requestData = $request->all();

        $coas = Coa::join('zhl_acc_group_coa', 'zhl_acc_master_coa.GroupCOA', '=', 'zhl_acc_group_coa.id_group')
            ->select('zhl_acc_master_coa.*', 'zhl_acc_group_coa.*');

        // check if request contains a parameter for COA code
        if (isset($requestData['coa_code'])) {
            $coas->where('zhl_acc_master_coa.COACode', $requestData['coa_code']);
        }

        // check if request contains a parameter for COA name
        if (isset($requestData['coa_name'])) {
            $coas->where('zhl_acc_master_coa.COAName', 'LIKE', '%' . $requestData['coa_name'] . '%');
        }

        // check if request contains a parameter for Group COA name
        if (isset($requestData['groupcoa_name'])) {
            $coas->where('zhl_acc_group_coa.GroupCOAName', 'LIKE', '%' . $requestData['groupcoa_name'] . '%');
        }

        // execute the query and get the results
        $coas = $coas->get();

        return $this->httpResponse(200, "OK", $coas);
    }
}
