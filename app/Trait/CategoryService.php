<?php

namespace App\Trait;

use App\Jobs\DeleteS3;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait CategoryService
{
    use UploadService;

    public function show_category($request)
    {


        $limit = $request->limit ?? 5;
        $sort = $request->sort ?? "asc";

        $query =  Category::orderBy("id", $sort);

        if ($request->has("search")) {


            $query->where("name", "LIKE", "%$request->search%");
        }

        return $query->paginate($limit)->withQueryString();
    }


    public function create_category($request)
    {

        $validated =  $request->validate(
            [
                "name" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "images" => "mimes:png,jpg,jpeg,svg|required"



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "mimes" => ":attribute phải là tệp tin có định dạng png,jpg,jpeg,svg"



            ],
            [
                "name" => "tên danh mục",
                "description" => "mô tả",
                "images" => "tệp tin"
            ]

        );


        DB::beginTransaction();

        // dd($request);
        try {



            // dd($category_exist);
            $request_data = $request->all();

            $request_data["name"] = Str::lower($request->input("name"));

            $path =  $this->upload_image($request->file("images"), "tailieu/category");
            $category = Category::create($request_data);
            $category->update([
                "images" => $path,

                "slug" => Str::slug(Str::upper($request->input("name")))
            ]);



            DB::commit();
            return redirect()->back()->with("success", "Thêm Danh Mục Môn Học Thành Công ");
        } catch (\Exception $err) {

            DB::rollBack();

            return redirect()->back()->with("error", $err->getMessage());
        }
    }










    public function update_category($request, $category_id)
    {

        $validated =  $request->validate(
            [
                "name" => "required|min:3|max:100",

                "description" => "min:4|max:10000|required",
                "images" => "mimes:png,jpg,jpeg,svg"



            ],
            [
                "required" => " :attribute không được để trống",
                "min" => ":attribute có tối thiểu :min kí tự",
                "max" => ":attribute có tối đa :max kí tự",
                "unique" => ":attribute đã tồn tại trong hệ thống",
                "mimes" => ":attribute phải là tệp tin có định dạng png,jpg,jpeg,svg"



            ],
            [
                "name" => "tên danh mục",
                "description" => "mô tả",
                "images" => "tệp tin"
            ]

        );

        DB::beginTransaction();

        $old_category = Category::find($category_id);
        try {
            $query = Category::find($category_id);
            $query->fill($request->all());
            $query->save();
            if ($request->hasFile("images")) {
                $path =  $this->upload_image($request->file("images"), "tailieu/category");
                $query->update([
                    "images" => $path
                ]);
            }

            DB::commit();
            if ($request->hasFile("images")) {
                DeleteS3::dispatch($old_category->images, "category");
            }


            return redirect()->back()->with("success", "Cập Nhật Danh Mục Môn Học Thành Công ");
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with("error", $err->getMessage());
        }
    }


    public function delete_category($category_id)
    {



        DB::beginTransaction();
        try {


            $checkExits = Category::find($category_id)->count();


            if ($checkExits <= 0) {
                return response()->json([
                    "code" => "400",
                    "message" => "Danh Mục Không hợp lệ hoặc không tìm thấy trên hệ thống nữa"
                ], 400);
            }

            Category::find($category_id)->delete();


            DB::commit();
            return response()->json([
                "code" => "201",
                "data" => $category_id,
                "message" => "Danh Mục Được Xóa Thành Công"
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

    public function document_for_slug($request, $slug = "")
    {

        $limit = $request->limit ?? 3;
        $sort = $request->sort ?? "asc";
        $query = Document::orderBy("id",  $sort)->where("active", 1);

        if ($slug != "")
            $query->whereHas('category', function ($query2) use ($slug) {
                $query2->where('slug', $slug);
            });

        if ($request->has("search")) {

            // dd($request->search);
            $query->where("name", "LIKE", "%$request->search%");
        }


        return $query->paginate($limit)->withQueryString();
    }
}
