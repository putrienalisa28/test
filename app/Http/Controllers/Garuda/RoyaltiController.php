<?php

namespace App\Http\Controllers\Garuda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Garuda\InvoiceModel;
use App\Models\Garuda\TransactionModel;
use App\Models\Garuda\UserModel;
use App\Models\Garuda\VoucherModel;
use App\Models\Garuda\ItemModel;

class RoyaltiController extends Controller
{
    public function index()
    {
        $data['listOfItem'] = ItemModel::all();
        return view('garuda/royalti/index',$data);
    }

    public function getdatauser(Request $request){
        $data = UserModel::where('id',$request->input('idcard'))->get();
        $response = response()->json($data);

        if (count($response->original) == 0) return $this->httpResponse(404, 'User Not Found', false);

        return $this->httpResponse(200, 'Data From Tabel User', $response->original);
    }

    public function getitem(Request $request){
        $data = ItemModel::where('itemid',$request->input('itemid'))->get();
        //  echo json_encode($data);
        // die;
        $response = response()->json($data);

        if (count($response->original) == 0) return $this->httpResponse(404, 'User Not Found', false);

        return $this->httpResponse(200, 'Data From Tabel User', $response->original);
    }
}
