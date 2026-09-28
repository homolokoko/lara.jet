<?php

namespace App\Models\Inspector\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RecapLog extends Model
{
    use HasFactory;

    protected $table = 'cutting_recap_log';
    protected $fillable = [
        'cutting_recap_id',	
        'comment','image','author',	
        'is_resolve',
    ];
    function inspector(){
        return $this->belongsTo(User::class,'inspector_id');
    }
    function getImageAttribute($v){
        return ($v)? Storage::disk('cutting')->url($v) : '' ;
    }
}
