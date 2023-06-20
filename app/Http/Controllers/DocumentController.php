<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Trait\DocumentService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;


class DocumentController extends Controller
{

    use DocumentService;


    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            Session::put('module_active', 'document');

            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_document =  $this->show_document($request);
        return view('admin.document.show', [

            "documents" => $list_document,
            "title" => " Danh Sách Tài Liệu",

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view(
            "admin.document.add",


            [


                "title" => "Thêm Tài Liệu",
                "categories" => Category::where("active", "1")->get()

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
        return $this->create_document($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("admin.document.update", [
            "title" => "Cập Nhật Tài Liệu",
            "document" => Document::find($id),
            "categories" => Category::where("active", "1")->get()
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
        // dd($request->all());
        return  $this->update_document($request, $id);
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
        return  $this->delete_document($request->input("id"));
    }
}
