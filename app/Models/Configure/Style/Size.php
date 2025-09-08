<?php

namespace App\Models\Configure\Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'style_profile_sizes';
    protected $fillable = ['style_profile_id','sizes_id'];



}
