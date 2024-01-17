<?php

namespace App\Http\Controllers\Garuda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GarudaController extends Controller
{
    public function input()
    {
        return view('garuda/index');
    }
}