<?php

namespace App\Models\Inspector\Accessory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DefectImage extends Model
{
    use HasFactory;
    public $table="accessory_defect_image";
    protected $fillable = ['accessory_defect_id','image','qty'];
    public $timestamps = false;

    
    public function getImageAttribute($value)
    {   
        return ($value)? Storage::disk('accessory')->url($value) : '';
    }
}

