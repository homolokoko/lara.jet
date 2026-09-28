<?php

namespace App\Library;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadBase64Image
{
    //
    public static function upload(string $src,string $path)
    {
        $instant = new self();
        $image = $instant->saveTmpFile($src, '/tmp/'.$path.'/');
        if (Storage::disk('public')->exists('/tmp/'.$path.'/' . $image))
            Storage::disk('public')->copy('/tmp/'.$path.'/' . $image, '/'.$path.'/' . $image);

        return '/'.$path.'/' . $image;
    }

    public static function uploadInspectionPhotograph(string $src,string $path)
    {
        $instant = new self();
        $image = $instant->saveInspectionPhotograph($src, 'tmp/inspection/'.$path.'/');
        if (Storage::disk('inspection')->exists('/tmp/inspection/'.$path.'/' . $image))
            Storage::disk('inspection')->copy('/tmp/inspection/'.$path.'/' . $image, '/inspection/'.$path.'/' . $image);

        return $path.'/' . $image;
    }

    private function saveTmpFile($src, $path)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
            $src = substr($src, strpos($src, ',') + 1);
            $type = strtolower($type[1]);
            $data = base64_decode($src);

            if ($data === false)
                dd('Base64 decode failed.');

            $filePath = \Carbon\Carbon::now()->format('y-m-d-h-i-s-u') . '.' . $type;

            if (Storage::disk('public')->put($path .'/'. $filePath, $data))
                return $filePath;
            else
                dd("Failed to save image.");
        }
    }

    private function saveInspectionPhotograph($src, $path)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
            $src = substr($src, strpos($src, ',') + 1);
            $type = strtolower($type[1]);
            $data = base64_decode($src);
            $img = Image::make($data)->resize(483, 366);

            if ($data === false)
                dd('Base64 decode failed.');

            $filePath = \Carbon\Carbon::now()->format('y-m-d-h-i-s-u') . '.png';

            if (Storage::disk('inspection')->put($path . $filePath, $img->encode()))
                return $filePath;
            else
                dd("Failed to save image.");
        }
    }
}
