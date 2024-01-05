<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Master\TagModel;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $userId;
    protected $groupId;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->userId = Session::get('username');
        $this->groupId = Session::get('group_id');
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }


    protected function httpResponse($code = 200, $message, $result = [])
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'result' => $result
        ];

        return response()->json($data, $code);
    }
    // protected function arrayToObject($data)
    // {
    //     return json_decode(json_encode($data));
    // }
}
