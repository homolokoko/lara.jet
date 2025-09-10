<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContextOfJeans extends Model
{
    use HasFactory;
    protected $table = 'context_of_jeans';
    protected $fillable = ['name'];


}
