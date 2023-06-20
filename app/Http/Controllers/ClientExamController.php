<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\History;
use App\Trait\ExamService;
use Illuminate\Http\Request;

class ClientExamController extends Controller
{

    use ExamService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exams = $this->show_exam($request, 3);


        return view("client.exam.list", [
            "exams" => $exams,
            "title" => "Tổng Hợp Bài Thi"
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $questions = $this->question_for_exam($id);

        return view("client.exam.show", [
            "questions" => $questions,
            "title" => "BỘ ĐỀ  -->  " . $questions[0]->exam->title
        ]);
    }

    public function show_result($id)
    {


        $history = History::find($id);

        return view("client.exam.show_result", [
            "history" => $history,

        ]);
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
    public function update_exam(Request $request, $id)
    {
        return  $this->handle_update_question($request, $id);
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
