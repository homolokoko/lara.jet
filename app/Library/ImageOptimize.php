<?php


namespace App\Library;

use Spatie\Image\Image;
use Illuminate\Support\Facades\Storage;

class ImageOptimize
{
    public static function save($data,$disk,$path='')
    {
        try {
            $file_dir = !$path ? null : '/' . $path;
            $file_ext = $data->getClientOriginalExtension();
            $file_name = \Carbon\Carbon::now()->format('y-m-d-h-i-s-u').rand(0,9990);
            $file_path = $file_name.'.'.$file_ext;
            $new_file = Storage::disk($disk)->putFileAs($file_dir, $data, $file_path);
            Image::load(Storage::disk($disk)->path($new_file))->optimized(20)->save();
            return Storage::disk($disk)->url($new_file);
        }catch(\Exception $exception){ dd($exception->getMessage()); }
    }
}
