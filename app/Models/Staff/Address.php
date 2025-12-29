<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_address';
    protected $fillable = ['user_id', 'street_id', 'city_id', 'state_id', 'zip_id', 'is_current'];
}
