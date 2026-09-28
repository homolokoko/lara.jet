<?php

namespace App\Models\Inspector\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shrinkage extends Model
{
    use HasFactory;
    protected $table = 'cutting_header_shrinkage';
    protected $fillable = ['header_id','width','height'];
    public $timestamps = false;

}
