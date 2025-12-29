<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_phone_number';
    protected $fillable = ['user_id', 'phone_number'];
}
