<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectProfile extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table="inspect_profile";
    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
