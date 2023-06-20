<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Trait\ExamService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{

    use ExamService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            Session::put('module_active', 'exam');

            return $next($request);
        });
    }
    public function index(Request $request)
    {

        $list_exam =  $this->show_exam($request);
        return view('admin.exam.show', [

            "exams" => $list_exam,
            "title" => " Danh Sách Bài Thi",

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            "admin.exam.add",


            [


                "title" => "Thêm Bài Thi",


            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->create_exam($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("admin.exam.update", [
            "title" => "Cập Nhật Bài Thi",
            "exam" => Exam::find($id),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return  $this->update_exam($request, $id);
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
    public function destroy(Request $request)
    {
        return  $this->delete_exam($request->input("id"));
    }
}
