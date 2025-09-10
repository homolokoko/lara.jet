<?php

namespace App\Models\Inspector\Endline\Measure\ReturnGarment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    public $table = "endline_measure_return_header";
    protected $fillable = [
        'repair_header_id', 'inspector', 'is_pass','qrcode'
    ];
    function chart()
    {
        return $this->hasMany(Chart::class, 'header_id');
    }
    //
}
