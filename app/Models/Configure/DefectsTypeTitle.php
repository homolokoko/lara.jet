<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsTypeTitle extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "defects_type_title";
    protected $fillable =['name'];

}
