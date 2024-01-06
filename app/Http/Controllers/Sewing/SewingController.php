<?php

namespace App\Http\Controllers\Sewing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sewing\SewingModel;

class SewingController extends Controller
{
    public function output()
    {
        $sewingModel = new SewingModel();
        $data['lygDestination'] = $sewingModel->getItemByIlygStyleSize();
        $data['lygStyleSize'] = $sewingModel->getItemByIlygStyleSize();
        $data['lygSewingOutput'] = $sewingModel->getItemByIlygSewingOutput();
        // echo json_encode($data['lygSewingOutput']);
        // die;
        return view('sewing/sewing',$data);
    }

    public function getlygSewingOutput(Request $request){

        $sewingModel = new SewingModel();
        $data['nametable'] = $sewingModel->getSIze($request->date,$request->style);
        $size = $sewingModel->getSIze($request->date,$request->style);
        $data['transaction'] = $sewingModel->countIlygSewingOutput($request->date,$request->style,$size);
        // echo json_encode($data['transaction']);
        // die;
        // $response = response()->json($data);

        // if (count($response->original) == 0) return $this->httpResponse(404, 'Item Not Found', false);

        // return $this->httpResponse(200, 'Data From MySamIn', $response->original);
        return view('sewing/AjaxSewing',$data);
    }

    public function editDataTransaction(Request $request) {
        try {
            $sewingModel = new SewingModel();
            $trn_date = $request->trn_date;
            $style_code = $request->style_code;
            $operator_name = $request->operator_name;
            $destination_code = $request->destination_code;

            // Iterasi terhadap size_name dan qty_output
            for ($i = 0; $i < count($request->detail['size_name']); $i++) {
                // Membuat entri baru dengan kombinasi data yang sesuai
                $data = [
                    'trn_date' => $trn_date,
                    'operator_name' => $operator_name,
                    'style_code' => $style_code,
                    'size_name' => $request->detail['size_name'][$i],
                    'destination_code' => $destination_code,
                    'qty_output' => $request->detail['qty_output'][$i]
                ];
                $result = $sewingModel->saveDataTransaction($data);
            }
                        
                 

            
    
            return response()->json(['status' => 'success', 'message' => 'Data transaction edited successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
