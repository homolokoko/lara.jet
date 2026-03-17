<?php

namespace App\Models\Inspector\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelImage extends Model
{
    use HasFactory;
    public $table="cutting_check_cutPanel_image";
    public $timestamps = false;
    protected $fillable = ['image','stack_position','cutting_check_cutPanel_id','is_wrong'];
}
