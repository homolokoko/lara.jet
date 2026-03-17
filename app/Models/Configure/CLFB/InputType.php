<?php

namespace App\Models\Configure\CLFB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    use HasFactory;
    protected $table='clfb_input_type';
    protected $fillable = ['name','is_checkbox','checkbox_value'];
}
