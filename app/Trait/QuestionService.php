<?php

namespace App\Trait;

use App\Jobs\DeleteS3;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Document;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

trait QuestionService
{

    public function show_question($request, $id)
    {


        $limit = $request->limit ?? 10;
        $sort = $request->sort ?? "desc";

        $query = Question::where("exam_id", $id)->orderBy("id", $sort);
        // $query->questions()
        // $query =  Question::);
        if ($request->has("search")) {


            $query->where("content", "LIKE", "%$request->search%");
        }

        return $query->paginate($limit)->withQueryString();
    }


    public function create_question($request, $id)
    {
        // dd($request);
        // return response()->json([
        //     'data' => $request->input("title"),
        //     "id" => $id

        // ], 201);

        // return;

        $validator = Validator::make($request->all(), [
            "title" => "required|min:3|max:1000",
            // 'content1' => [
            //     'required',
            //     'string',
            //     'min:1',
            //     'max:1000',
            //     Rule::json()
            // ]
            'content1' => 'required|string|min:1|max:1000',
            'content2' => 'required|string|min:1|max:1000',
            'content3' => 'required|string|min:1|max:1000',
            'content4' => 'required|string|min:1|max:1000',
        ], [
            "required" => ":attribute không được để trống",
            "min" => ":attribute có tối thiểu :min kí tự",
            "max" => ":attribute có tối đa :max kí tự",

        ], [
            "title" => "tên đề thi",
            "content1" => "câu trả lời 1",
            "content2" => "câu trả lời 2",
            "content3" => "câu trả lời 3",
            "content4" => "câu trả lời 4",

        ]);

        if ($validator->fails()) {
            // Gửi phản hồi lỗi
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }



        DB::beginTransaction();
        try {
            $question = Question::create([
                "exam_id" => (int)$id,
                "content" => trim($request->input("title"))
            ]);



            $data =
                [
                    $request->input("content1"), $request->input("content2"), $request->input("content3"),
                    $request->input("content4")
                ];

            foreach ($data as $key => $answer) {

                if ($key + 1 ==  $request->input("is_correct")) {
                    Answer::create([
                        "content" => $answer,
                        "question_id" => $question->id,
                        "is_correct" => 1

                    ]);
                } else {
                    Answer::create([
                        "content" => $answer,
                        "question_id" => $question->id,

                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "success" => true,
                "message" => "Thêm Dữ Liệu Thành Công",
                "data" => [
                    "question" => $question,
                    "answer" => Answer::where("question_id", $question->id)->get()

                ]

            ], 201);
        } catch (\Exception $err) {

            DB::rollBack();


            return response()->json([
                'success' => false,
                'errors' => $err->getMessage(),


            ], 400);
        }
    }

    public function update_question($request, $exam_id, $question_id)

    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            "title" => "required|min:3|max:1000",

            'content1' => 'required|string|min:1|max:1000',
            'content2' => 'required|string|min:1|max:1000',
            'content3' => 'required|string|min:1|max:1000',
            'content4' => 'required|string|min:1|max:1000',
        ], [
            "required" => ":attribute không được để trống",
            "min" => ":attribute có tối thiểu :min kí tự",
            "max" => ":attribute có tối đa :max kí tự",

        ], [
            "title" => "tên đề thi",
            "content1" => "câu trả lời 1",
            "content2" => "câu trả lời 2",
            "content3" => "câu trả lời 3",
            "content4" => "câu trả lời 4",

        ]);

        if ($validator->fails()) {
            // Gửi phản hồi lỗi
            return response()->json([
                'success' => false,
                "data" => ["question_id" => $question_id],
                'errors' => $validator->errors(),
            ], 422);
        }


        DB::beginTransaction();
        try {

            $question_update = Question::find($question_id);
            $question_update->content = trim($request->input('title'));
            $question_update->save();


            $data =
                [
                    $request->input("content1"), $request->input("content2"), $request->input("content3"),
                    $request->input("content4")
                ];

            foreach (Answer::where("question_id", $question_id)->get() as $key => $answer) {

                foreach ($data as $key2 => $answer2) {
                    if ($key2 == $key) {


                        $answer->update([
                            "content" => $answer2,
                            "question_id" => $question_update->id,
                            "is_correct" => 0

                        ]);
                    }

                    if ($key + 1 == (int)$request->input("is_correct")) {

                        $answer->update([

                            "is_correct" => 1

                        ]);;
                    }
                }
            }


            // if ($key2 ==  $request->input("is_correct")) {
            //     Answer::find($answer->id)->update([
            //         "content" => $answer2,
            //         "question_id" => $question_update->id,
            //         "is_correct" => 1

            //     ]);
            // } else {

            DB::commit();

            return response()->json([
                "success" => true,
                "message" => "Cập nhật Dữ Liệu Thành Công",
                "data" => [
                    "question" => $question_update,
                    "answer" => Answer::where("question_id", $question_update->id)->get()

                ]

            ], 201);
        } catch (\Exception $err) {

            DB::rollBack();


            return response()->json([
                'success' => false,
                'errors' => $err->getMessage(),


            ], 400);
        }
    }


    public function delete_question($question_id)
    {



        DB::beginTransaction();
        try {


            $checkExits = Question::find($question_id)->count();


            if ($checkExits <= 0) {
                return response()->json([
                    "code" => "400",
                    "message" => "Câu Hỏi Không hợp lệ hoặc không tìm thấy trên hệ thống nữa"
                ], 400);
            }

            Question::find($question_id)->delete();


            DB::commit();
            return response()->json([
                "code" => "201",
                "data" => $question_id,
                "message" => "Câu Hỏi Được Xóa Thành Công"
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

    // public function document_for_slug($request, $slug = "")
    // {

    //     $limit = $request->limit ?? 3;
    //     $sort = $request->sort ?? "asc";
    //     $query = Document::orderBy("id",  $sort)->where("active", 1);

    //     if ($slug != "")
    //         $query->whereHas('category', function ($query2) use ($slug) {
    //             $query2->where('slug', $slug);
    //         });

    //     if ($request->has("search")) {

    //         // dd($request->search);
    //         $query->where("name", "LIKE", "%$request->search%");
    //     }


    //     return $query->paginate($limit)->withQueryString();
    // }
}