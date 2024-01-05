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
}
