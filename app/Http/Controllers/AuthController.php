<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        Session::put('module_active', '');
        return view('admin.home');
    }



    public function login()
    {
        return view("admin.login");
    }
    public function check(Request $request)
    {



        $request->validate(
            [
                'name' => "required|min:6|max:30|",
                'password' => 'required|min:6|max:30',

            ],
            [
                "required" => " :attribute không được để trống",
                "max" => " :attribute có tối đa :max ki tự",
                "min" => " :attribute có tối thiểu :min ki tự",
            ],
            [

                "name" => "Tên Đăng Nhập",
                "password" => "Mật Khẩu"

            ]
        );

        $creds = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($creds, $request->has('remember') ? true : false)) {
            return redirect()->route('admin.home');
        } else {

            return redirect()->route('admin.login')->with('fail', 'Tên Đăng Nhập hoặc Mật Khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
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
