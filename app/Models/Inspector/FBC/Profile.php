<?php

namespace App\Models\Inspector\FBC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'fbc_record_profiles';
    protected $fillable = ['style_id', 'locate_id', 'garment_type'];

    function checkList(){
        return $this->hasMany(CheckList::class,'profile_id');
    }
    function measureItem()
    {
        return $this->hasMany(MeasureItem::class, 'header_id');
    }
    function scopeSpecifyLineWithStyle($q,$style,$locate,$garmentType){
        return $q->where([
            'style_id'=>$style, 'locate_id'=>$locate, 'garment_type'=>$garmentType
        ]);
    }
}
