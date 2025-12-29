<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_photograph';
    protected $fillable = ['user_id', 'file_path'];
}
