<?php


namespace App\Library;


use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function upload($file,$disk,$path='/')
    {
        try {
            $file_dir = !$path ? null : '/' . $path;
            $file_ext = $file->getClientOriginalExtension();
            $file_name = \Carbon\Carbon::now()->format('y-m-d-h-i-s-u').rand(0,9990);
            $file_path = $file_name.'.'.$file_ext;
            return $new_file = Storage::disk($disk)->putFileAs($file_dir, $file, $file_path);
        }catch(\Exception $exception){ return $exception->getMessage(); }
    }
}
