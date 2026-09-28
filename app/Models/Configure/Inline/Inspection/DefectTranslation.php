<?php

namespace App\Models\Configure\Inline\Inspection;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefectTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['inline_inspection_defect_id','locale', 'translated'];
    protected $table = 'inline_inspection_defect_translations';
    // public function getTranslatedAttribute()
    // {
    //     $replace_snake = Str::replace('_','',$this->translated);
    //     return ucfirst($replace_snake);
    // }
}
