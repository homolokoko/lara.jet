<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsCategory extends Model
{
    use HasFactory;
    public $table = 'defect_category';
    protected $fillable =['defect_id','defect_category_id'];

    public function category(){
        return $this->belongsTo(DefectsCategoryTitle::class, 'defect_category_id');
    }
}
