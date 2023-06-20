<?php

namespace App\Trait;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_images;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;

trait UploadService
{


    public function upload_image($request_file, $path = "tailieu")
    {

        $path = $request_file
            ->storeAs($path, Str::random(2) . time() . $request_file
                ->getClientOriginalName(), "s3");


        $link_path = Storage::disk('s3')->url($path);

        return   $link_path;
    }


    public function delete_s3($url, $path)
    {

        $url_from_database = $url;
        $url_decode = url(urldecode($url_from_database));
        $short_url = strstr($url_decode, '/tailieu/' . $path);
        Storage::disk('s3')->delete($short_url);
    }
}
