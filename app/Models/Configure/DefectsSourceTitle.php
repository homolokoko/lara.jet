<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsSourceTitle extends Model
{
    use HasFactory;
    public $table= 'defect_source_title' ;
    protected $fillable =['name'];

}
