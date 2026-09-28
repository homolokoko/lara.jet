<?php

namespace App\Models\Inspector\FBC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;
    protected $table = 'fbc_checklist';
    protected $fillable = ['profile_id', 'name', 'is_pass'];
    public $timestamps = false;

    public function problem(){
        return $this->hasOne(CheckListImage::class, 'fbc_checklist_id');
    }
}
