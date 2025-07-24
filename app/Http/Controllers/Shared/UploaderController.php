<?php

namespace App\Http\Controllers\Shared;

use App\Library\UploadFile;
use Illuminate\Http\Request;
use App\Library\UploadBase64;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    //

    public function upload64(Request $request)
    {
        $saveBase64 = new UploadBase();
        $saveBase64->directory = 'product';
        $saveBase64->base64 = $request->base64;
        $saveBase64->upload();
        return response()->json(['img_path'=>$saveBase64->file_name,'image_url'=>$saveBase64->getImageUrl(),'active'=>'0']);
    }

    public function uploadFile(Request $request)
    {
//        return $request->all();
        $file = UploadFile::upload($request->file('file'),'tmp');
        return ['file'=>$file,'url'=>Storage::disk('tmp')->url($file)];
    }
}
