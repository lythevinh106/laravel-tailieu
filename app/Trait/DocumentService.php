<?php

namespace App\Trait;

use App\Jobs\DeleteS3;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait DocumentService
{
    use UploadService;

    public function show_document($request)
    {


        $limit = $request->limit ?? 5;
        $sort = $request->sort ?? "asc";
        $query =  Document::orderBy("id",  $sort);

        if ($request->has("search")) {


            $query->where("name", "LIKE", "%$request->search%");
        }

        return $query->paginate($limit)->withQueryString();
    }




    public function create_document($request)
    {


        $validated =  $request->validate(
            [
                "name" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "doc" => "mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|required",
                "category_id" => "required",



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "mimes" => ":attribute phải là tệp tin có định dạng doc, docx, xls, xlsx, ppt, pptx hoặc pdf"




            ],
            [
                "name" => "tên tài liệu",
                "description" => "mô tả",
                "doc" => "tệp tin",
                "category_id" => "danh mục"
            ]

        );
        // dd($request->all());

        DB::beginTransaction();


        try {



            // dd($category_exist);
            $request_data = $request->all();

            $request_data["name"] = Str::lower($request->input("name"));

            $path =  $this->upload_image($request->file("doc"), "tailieu/document");
            $category = Document::create($request_data);
            $category->update([
                "doc" => $path,
                "type" => $request->file("doc")->getClientOriginalExtension(),
                "size" => round($request->file("doc")->getSize() / (1024 * 1024), 2) . "MB",

            ]);



            DB::commit();
            return redirect()->back()->with("success", "Thêm Tài Liệu Thành Công ");
        } catch (\Exception $err) {

            DB::rollBack();

            return redirect()->back()->with("error", $err->getMessage());
        }
    }












    public function update_document($request, $document_id)
    {





        $validated =  $request->validate(
            [
                "name" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "doc" => "mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:30000",
                "category_id" => "required",



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "mimes" => ":attribute phải là tệp tin có định dạng doc, docx, xls, xlsx, ppt, pptx hoặc pdf",
                "max" => ":attribute phải có kích thước nhỏ hơn hoặc bằng :max KB",



            ],
            [
                "name" => "tên danh mục",
                "description" => "mô tả",
                "doc" => "tệp tin",
                "category_id" => "danh mục",


            ]

        );
        // dd($request->all());
        DB::beginTransaction();


        try {
            $old_document = Document::find($document_id);
            $query = Document::find($document_id);
            $query->fill($request->all());
            $query->save();
            if ($request->hasFile("doc")) {
                $path =  $this->upload_image($request->file("doc"), "tailieu/document");
                $query->update([
                    "doc" => $path,
                    "type" => $request->file("doc")->getClientOriginalExtension(),

                    "size" => round($request->file("doc")->getSize() / (1024 * 1024), 2) . "MB",
                ]);
            }

            DB::commit();
            if ($request->hasFile("doc")) {
                DeleteS3::dispatch($old_document->doc, "document")->delay(now()->addSecond(2));
            }


            return redirect()->back()->with("success", "Cập Nhật Tài Liệu Thành Công ");
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with("error", $err->getMessage());
        }
    }


    public function delete_document($document_id)
    {


        // dd($document_id);
        DB::beginTransaction();
        try {

            $old_document = Document::find($document_id);
            $checkExits = Document::find($document_id)->count();



            if ($checkExits <= 0) {
                return response()->json([
                    "code" => "400",
                    "message" => "Tài Liệu Không hợp lệ hoặc không tìm thấy trên hệ thống nữa"
                ], 400);
            }

            Document::find($document_id)->delete();


            DB::commit();

            DeleteS3::dispatch($old_document->doc, "document")->delay(now()->addSecond(2));

            return response()->json([
                "code" => "201",
                "data" => $document_id,
                "message" => "Danh Mục Được Xóa Thành Công"
            ], 200);
        } catch (\Exception $err) {
            // DB::rollBack();
            return response()->json([
                "code" => "400",
                "message" => $err->getMessage(),

            ], 400);
        }
    }
}
