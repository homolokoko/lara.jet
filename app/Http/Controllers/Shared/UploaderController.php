<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Library\UploadBase64;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    //

    public function __singleFileUpload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:10240', // 1MB Max
        ]);
        $image = $request->file('image');
        $path = $image->store('student', 'public');

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product', 'public');
                $uploadedImage[] = [
                    'file_path' => $path,
                    'originalName' => $image->getClientOriginalName(),
                    'url' => Storage::disk('public')->url($path),
                    'rotate' => false,
                ];
            }
        }


        return response()->json($uploadedImage);
    }

    public function singleFileUpload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:10240', // 1MB Max
        ]);

        $uploadedImages = [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = \Carbon\Carbon::now()->format('Y-m-d-h-i-s').'.'.$ext;
            $path = Storage::disk('tmp')->putFileAs('',$image,$filename);
            $uploadedImages = [
                'file_path' => $path,
                'originalName' => $image->getClientOriginalName(),
                'url' =>Storage::disk('tmp')->url($path),
                'rotate' => false,
            ];
        }


        return response()->json($uploadedImages);
    }

    public function multipleFilesUpload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:10240', // 1MB Max
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tmp', 'public');
                $uploadedImages[] = [
                    'file_path' => $path,
                    'originalName' => $image->getClientOriginalName(),
                    'url' => Storage::disk('public')->url($path),
                    'rotate' => false,
                ];
            }
        }


        return response()->json(['images' => $uploadedImages]);
    }

    public function upload(Request $request)
    {
        $saveBase64 = new UploadBase64();
        $saveBase64->directory = 'product';
        $saveBase64->base64 = $request->base64;
        $saveBase64->upload();
        return response()->json(['img_path'=>$saveBase64->file_name,'image_url'=>$saveBase64->getImageUrl(),'active'=>'0']);
    }
}
