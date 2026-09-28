<?php

namespace App\Models\Inspector\FBC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListImage extends Model
{
    use HasFactory;
    protected $table = 'fbc_checklist_images';
    protected $fillable = ['image', 'description', 'fbc_checklist_id'];
    public $timestamps = false;

    function checkPoint(){
        return $this->belongsTo(CheckList::class, 'fbc_checklist_id', 'id');

    }
}
