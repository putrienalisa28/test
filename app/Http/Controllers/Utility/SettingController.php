<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Models\MenuHeader;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function menuList()
    {
        $data['menuList'] = MenuHeader::with('subMenus.subMenuDetails')->orderBy('order')->get();
        $data['groupList'] = GroupUser::all();
        // dd($data['groupList']);

        return view('pages/utility/menu/index', $data);
    }

    public function manageUser()
    {
        $data['menuList'] = MenuHeader::with('subMenus.subMenuDetails')->orderBy('order')->get();
        $data['groupList'] = GroupUser::with('users')->get();
        $data['userList'] = User::with('group')->get();


        // echo json_encode($data['groupList']);
        // die;


        return view('pages/utility/user/index', $data);
    }

    function userSave(Request $request)
    {

        try {
            if ($request->action == 'update') {
                $user = User::where('username', $request->username)->first();

                if (!$user) {
                    return $this->httpResponse(404, 'User Not Found', false);
                }
            } else {
                $user = new User;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->group_id = $request->group_id;
            $user->telegram_id = '0';

            $user->save();

            $message = ($request->action == 'save') ? 'Save User Successfully' : 'Update User Successfully';

            return $this->httpResponse(200, $message, true);
        } catch (\Throwable $th) {
            return $this->httpResponse(200, $th->getMessage(), true);
        }




        // return User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'username' => $request->username,
        //     'group_id' => $request->group_id,
        //     'password' => Hash::make($request->password),
        // ]);


        // echo json_encode($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
