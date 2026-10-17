<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phonenumber extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'users_phonenumbers';
    protected $fillable = ['user_id','number'];
}
