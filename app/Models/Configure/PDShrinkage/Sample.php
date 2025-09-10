<?php

namespace App\Models\Configure\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_sample';
    protected $fillable = ['name'];
    public $timestamps = false;
}
