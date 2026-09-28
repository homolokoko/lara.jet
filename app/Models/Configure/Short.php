<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    use HasFactory;
    protected $table="short";
    protected $fillable = ['route','parameter','code'];
    public $timestamps = false;
}
