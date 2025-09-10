<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsCategoryTitle extends Model
{
    use HasFactory;
    public $table = 'defect_category_title';
    protected $fillable =['name'];

}
