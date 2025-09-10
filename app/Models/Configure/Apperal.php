<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Apperal extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];
    protected $appends = ['encodeImage'];

    public function getImageAttribute($value)
    {
        return  ($value) ? Storage::disk('styleApperal')->url($value) : '';
    }



}
