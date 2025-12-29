<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCareer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_parent_career';
    protected $fillable = ['user_id', 'dad_name', 'dad_career', 'mom_name', 'mom_career'];
}
