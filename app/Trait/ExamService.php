<?php

namespace App\Trait;

use App\Jobs\DeleteS3;
use App\Models\Category;
use App\Models\Document;
use App\Models\Exam;
use App\Models\History;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

trait ExamService
{

    public function show_exam($request, $limit_page = 5)
    {


        $limit = $request->limit ?? $limit_page;
        $sort = $request->sort ?? "asc";

        $query =  Exam::orderBy("id", $sort);

        if ($request->has("search")) {


            $query->where("title", "LIKE", "%$request->search%");
        }

        return $query->paginate($limit)->withQueryString();
    }


    public function create_exam($request)
    {



        $validated =  $request->validate(
            [
                "title" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "time" => "max_digits:36000|required"



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "max_digits" => ":attribute không được lớn hơn :max
                "


            ],
            [
                "title" => "tên đề thi",
                "description" => "mô tả",
                "time" => "thời gian của bài thi"
            ]

        );


        DB::beginTransaction();

        // dd($request);
        try {



            // dd($category_exist);
            $request_data = $request->all();
            $exam = Exam::create($request_data);




            DB::commit();
            // Route::get('/index/{id}', [QuestionController::class, "index"])->name('index');
            return redirect()->route("admin.question.index", ['id' => $exam->id])->with("success", "Thêm Bài Thi Thành Công Bây Giờ Hãy Tạo Câu Hỏi Cho Nó");
        } catch (\Exception $err) {

            DB::rollBack();

            return redirect()->back()->with("error", $err->getMessage());
        }
    }










    public function update_exam($request, $exam_id)

    {

        $validated =  $request->validate(
            [
                "title" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "time" => "max_digits:36000|required"



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "max_digits" => ":attribute không được lớn hơn :max
                "


            ],
            [
                "title" => "tên đề thi",
                "description" => "mô tả",
                "time" => "thời gian của bài thi"
            ]
        );

        DB::beginTransaction();


        try {
            $query = Exam::find($exam_id);
            $query->fill($request->all());
            $query->save();


            DB::commit();



            return redirect()->back()->with("success", "Cập Nhật Bài Thi Thành Công ");
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with("error", $err->getMessage());
        }
    }


    public function delete_exam($exam_id)
    {



        DB::beginTransaction();
        try {


            $checkExits = Exam::find($exam_id)->count();


            if ($checkExits <= 0) {
                return response()->json([
                    "code" => "400",
                    "message" => "Bài Thi Không hợp lệ hoặc không tìm thấy trên hệ thống nữa"
                ], 400);
            }

            Exam::find($exam_id)->delete();


            DB::commit();
            return response()->json([
                "code" => "201",
                "data" => $exam_id,
                "message" => "Bài Thi Được Xóa Thành Công"
            ], 200);
        } catch (\Exception $err) {
            // DB::rollBack();
            return response()->json([
                "code" => "400",
                "message" => $err->getMessage(),

            ], 400);
        }

        // $query->delete();


    }

    public function question_for_exam($id)
    {

        $limit =  2;
        $sort = "asc";
        $query = Question::where("exam_id", $id)->orderBy("id",  $sort);


        // if ($slug != "")
        //     $query->whereHas('category', function ($query2) use ($slug) {
        //         $query2->where('slug', $slug);
        //     });




        return $query->paginate($limit)->withQueryString();
    }


    public function handle_update_question($request, $exam_id)
    {


        // dd($request->all(), $exam_id);


        DB::beginTransaction();
        try {


            $checkExits = Exam::find($exam_id)->count();


            if ($checkExits <= 0) {
                return response()->json([
                    "code" => "400",
                    "message" => "Bài Thi Không hợp lệ hoặc không tìm thấy trên hệ thống nữa",
                    "success" => false
                ], 400);
            }


            $count = 0;
            $list_question = Question::where("exam_id", $exam_id)->with("answers")->get();

            $count_list_question = count($list_question);


            $arr_filter = [];

            foreach ($list_question as $question) {
                foreach ($request->all() as $key_question_request => $question_request) {
                    if ($question->id == $question_request["question_id"]) {

                        // dd($question);
                        $arr_filter[] = $question;
                    }
                }
            }



            ////check answer

            foreach ($arr_filter as $key_arr_filter => $question) {

                foreach ($request->all() as $key_question_request => $question_request) {

                    if ($question->id == $question_request["question_id"]) {

                        // foreach ($question->answers as $key_answer => $answer) {

                        //     dd($question->answers[$request->all()[$key_question_request]["value"]]);

                        // dd($question->answers[$request->all()[$key_question_request]["value"] - 1]);
                        if ($question->answers[$request->all()[$key_question_request]["value"] - 1]->is_correct == 1) {

                            $count++;
                        }
                        // }
                    }
                }
            }

            // dd($count);


            $history =  History::create([
                "count_questions" => $count,
                "point" => ($count / $count_list_question) * 100,
                "evaluate" => $this->create_evaluate(($count / $count_list_question) * 100),
                "user_id" => Auth::user()->id,
                "exam_id" => $exam_id


            ]);
            $history["total_questions"] = $count_list_question;

            DB::commit();
            return response()->json([
                "success" => true,
                "code" => "201",
                "message" => "Bài Thi Đã Hoàn Thành",
                "data" => [
                    "history" => $history,

                ]
            ], 200);
        } catch (\Exception $err) {
            // DB::rollBack();
            return response()->json([
                "code" => "400",
                "message" => $err->getMessage(),

            ], 400);
        }
    }


    function create_evaluate($number)
    {
        if ($number < 50) {
            return "yếu";
        } else if ($number <= 60) {
            return "trung bình";
        } else if ($number <= 79) {
            return "khá";
        } else if ($number <= 100) {
            return "tốt";
        }
    }
}
