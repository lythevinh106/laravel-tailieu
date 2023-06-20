<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Trait\QuestionService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    use QuestionService;
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


    public function index(Request $request, $id)
    {
        $list_question =  $this->show_question($request, $id);
        // dd($list_question);
        return view('admin.question.question', [

            // "exams" => $list_exam,
            "title" => " Danh Sách Câu Hỏi",
            "exam" => Exam::find($id),
            "questions" => $list_question

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // Xử lý dữ liệu JSON

        return $this->create_question($request, $id);

        // return response()->json($request->input());
        // return $this->create_question($request);
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
    public function edit(Request $request, $exam_id, $question_id)
    {
        // dd($exam_id, $question_id);
        return  $this->update_question($request, $exam_id, $question_id);
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
        return  $this->delete_question($request->input("id"));
    }
}
